<?php

namespace App\Http\Controllers;

use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{



    public function save(Request $request)
    {

        $data=array();


        for($a=0;$a<9;$a++)
        {
            $index = $a+1;
            $category='category'.$index;
            $method_ver='method_ver'.$index;

            $d["category"] =$request->$category;
            $d["method"]= $request->$method_ver;

            $indicator='indicator'.$index;
            $indicator_value='indicator_value'.$index;

            $len = sizeof($request->$indicator);

            $indicators=$request->$indicator;
            $indicator_values =$request->$indicator_value;


            $cc=array();
            for($b=0;$b<$len;$b++)
            {

                $cc[$b]["title"]=$indicators[$b];
                $cc[$b]["value"]=$indicator_values[$b];
            }

            $d["indicator"]=$cc;

            $data[$a]=$d;


        }

        $data_json=json_encode($data);


        $report = new Report();
        $report->data=$data_json;
        $report->issaved=1;
        $report->issent=0;
        $report->sent_at=Carbon::now();
        $report->name=$request->report_name.'-'.$request->year;
        $report->user_id=Auth::id();
        $report->save();

	return redirect()->to('/weekly/reports/view');
    }


    public function view()
    {
        $reports=null;

        if(Auth::user()->isadmin==1)
        {
            $reports = Report::all();
        }
        else
        {

            $reports = Report::where('user_id',Auth::id())->get();
        }

        return view('reports.view')->with('reports',$reports);


    }

    public function edit($id,Request $request)
    {

        $report = Report::find($id);

        return view('reports.edit')->with('report', $report);

    }

    public function update($id,Request $request)
    {

        $data=array();


        for($a=0;$a<9;$a++)
        {
            $index = $a+1;
            $category='category'.$index;
            $method_ver='method_ver'.$index;

            $d["category"] =$request->$category;
            $d["method"]= $request->$method_ver;

            $indicator='indicator'.$index;
            $indicator_value='indicator_value'.$index;

            $len = sizeof($request->$indicator);

            $indicators=$request->$indicator;
            $indicator_values =$request->$indicator_value;


            $cc=array();
            for($b=0;$b<$len;$b++)
            {

                $cc[$b]["title"]=$indicators[$b];
                $cc[$b]["value"]=$indicator_values[$b];
            }

            $d["indicator"]=$cc;

            $data[$a]=$d;


        }

        $data_json=json_encode($data);


        $report = Report::find($id);
        $report->data=$data_json;
        $report->issaved=1;
        $report->issent=0;
        $report->sent_at=Carbon::now();
        $report->name=$request->report_name;
        $report->user_id=Auth::id();
        $report->save();


        return redirect()->back();

    }

    public function send($id)
    {

        $report = Report::find($id);

        if(Auth::id()==$report->user_id)
        {

            $report->issent=1;

            $report->save();

        }


        return redirect()->route('reports.weekly.view');
    }
    
     public function filter(Request $request)
    {

        $week=$request->week;

        $data=array();

        $reports = Report::all();

        foreach($reports as $report)
        {

            $date = $report->sent_at;
            if($date)
            {

                $correct_date = explode(" ",$date);


                $ddate =$correct_date[0];
                $duedt = explode("-", $ddate);
                $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
                $week_db  = (int)date('W', $date);

                if($week==$week_db)
                {

                    array_push($data,$report);

                }


            }



        }

       return  view('reports.view')->with('reports',$data);

    }

}
