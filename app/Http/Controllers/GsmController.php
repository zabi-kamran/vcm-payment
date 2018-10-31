<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gsm;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
class GsmController extends Controller
{
    public function index()
    {
        return view('master.gsm.index');
    }

    public function getData(Request $request){
         //DB::statement(DB::raw('set @rownum=0'));
          $datas = Gsm::select([
            // DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'gsm_name']);
          $datatables = Datatables::of($datas)
          ->addColumn('action', function ($datatables) {
            return '<a href="'.route('gsmmaster.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
        });
      
        return $datatables->make(true);
    }
  
    public function create()
    {
        return view('master.gsm.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'gsm_name'=>'required'
        ]);
        $data=new Gsm();
        $data->gsm_name=$request->gsm_name;
        $data->save();
        return redirect('gsmmaster');

    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $row=Gsm::find($id);
        return view('master.gsm.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'gsm_name'=>'required'
        ]);
        $data=Gsm::find($id);
        $data->gsm_name=$request->gsm_name;
        $data->save();
        return redirect('gsmmaster');
    }

    public function destroy($id)
    {
         $data=Gsm::find($id);
         $data->delete();
    }
}
