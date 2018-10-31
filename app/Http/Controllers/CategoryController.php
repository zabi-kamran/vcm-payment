<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function index()
    {
        return view('master.category.index');
    }

    public function getData(Request $request){
          $datas = Category::select([
            'id',
            'category_name']);
          $datatables = Datatables::of($datas)
          ->addColumn('action', function ($datatables) {
            return '<a href="'.route('categorymaster.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
        });
        return $datatables->make(true);
    }
  
    public function create()
    {
        return view('master.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name'=>'required'
        ]);
        $data=new Category();
        $data->category_name=$request->category_name;
        $data->save();
        return redirect('categorymaster');

    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $row=Category::find($id);
        return view('master.category.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'category_name'=>'required'
        ]);
        $data=Category::find($id);
        $data->category_name=$request->category_name;
        $data->save();
        return redirect('categorymaster');
    }

    public function destroy($id)
    {
         $data=Category::find($id);
         $data->delete();
    }
}
