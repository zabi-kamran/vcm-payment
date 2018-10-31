<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ward;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
class WardController extends Controller
{
    public function index()
    {
        $datas = Ward::join('lgas','lgas.id','wards.lga_id')
            ->select([
                // DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                DB::raw('wards.id as id'),
                'ward_name',
                'lga_name'])->get();

        return view('master.ward.index')->with('wards',$datas);
    }

    public function getData(Request $request){
         //DB::statement(DB::raw('set @rownum=0'));
          $datas = Ward::join('lgas','lgas.id','wards.lga_id')
          ->select([
            // DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('wards.id as id'),
            'ward_name',
            'lga_name']);

          $datatables = Datatables::of($datas)
          ->addColumn('action', function ($datatables) {
            return '<a href="'.route('wardmaster.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
        });
      
        return $datatables->make(true);
    }
  
    public function create()
    {
        return view('master.ward.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'lga_id'=>'required',
            'ward_name'=>'required'
        ]);
        $data=new Ward();
        $data->lga_id=$request->lga_id;
        $data->ward_name=$request->ward_name;
        $data->save();
        return redirect('wardmaster');

    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $row=Ward::find($id);
        return view('master.ward.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'lga_id'=>'required',
            'ward_name'=>'required'
        ]);
        $data=Ward::find($id);
        $data->lga_id=$request->lga_id;
        $data->ward_name=$request->ward_name;
        $data->save();
        return redirect('wardmaster');
    }

    public function destroy($id)
    {
         $data=Ward::find($id);
         $data->delete();
    }
}
