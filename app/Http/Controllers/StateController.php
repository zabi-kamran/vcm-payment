<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\State;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
class StateController extends Controller
{
    public function index()
    {
        return view('master.state.index');
    }

    public function getData(Request $request){
         //DB::statement(DB::raw('set @rownum=0'));
          $datas = State::select([
            // DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'state_name']);
          $datatables = Datatables::of($datas)
          ->addColumn('action', function ($datatables) {
            return '<a href="'.route('statemaster.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
        });
      
        return $datatables->make(true);
    }
  
    public function create()
    {
        return view('master.state.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'state_name'=>'required'
        ]);
        $data=new State();
        $data->state_name=$request->state_name;
        $data->save();
        return redirect('statemaster');

    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $row=State::find($id);
        return view('master.state.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'state_name'=>'required'
        ]);
        $data=State::find($id);
        $data->state_name=$request->state_name;
        $data->save();
        return redirect('statemaster');
    }

    public function destroy($id)
    {
         $data=State::find($id);
         $data->delete();
    }
}
