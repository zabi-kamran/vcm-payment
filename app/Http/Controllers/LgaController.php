<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Lga;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
class LgaController extends Controller
{
    public function index()
    {
        return view('master.lga.index');
    }

    public function getData(Request $request){
         //DB::statement(DB::raw('set @rownum=0'));

        $datas = DB::table('states')->join('lgas','lgas.state_id','=','states.id')
          ->select([
            'lgas.id as id',
            'lga_name',
            'state_name'])->get();

          $datatables = Datatables::of($datas)
          ->addColumn('action', function ($datatables) {
            return '<a href="'.route('lgamaster.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
        });
        return $datatables->make(true);
    }
  
    public function create()
    {
        return view('master.lga.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'state_id'=>'required',
            'lga_name'=>'required',
        ]);
        $data=new Lga();
        $data->lga_name=$request->lga_name;
        $data->state_id=$request->state_id;
        $data->save();
        return redirect('lgamaster');

    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $row=Lga::find($id);
        return view('master.lga.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'state_id'=>'required',
            'lga_name'=>'required'
        ]);
        $data=Lga::find($id);
        $data->lga_name=$request->lga_name;
        $data->state_id=$request->state_id;
        $data->save();
        return redirect('lgamaster');
    }

    public function destroy($id)
    {
         $data=Lga::find($id);
         $data->delete();
    }
}
