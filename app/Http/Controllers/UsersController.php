<?php

namespace App\Http\Controllers;
use App\Model\Category;
use App\Model\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=DB::table('users')->select('users.name as name','users.id as id','users.email as email','state_users.state_id as state_id','states.state_name as state_name')->join('state_users','state_users.user_id','=','users.id')
            ->join('states','states.id','=','state_users.state_id')->get();
        return view('user.index')->with('users',$users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=State::all();
        $categories = Category::all();
        return view('user.create')->with('states',$states)->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->isadmin = 0;
        $user->save();

        $user_id=$user->id;


        DB::table('state_users')->insert(["user_id"=>$user_id,"state_id"=>$request->state_id]);



        $cat_ids = $request->cat_id;

        foreach($cat_ids as $cat_id)
        {

        DB::table('user_categories')->insert(["user_id"=>$user_id,"cat_id"=>$cat_id]);

        }


        return redirect()->to('users');

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    echo "Thank you ";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->join('state_users','state_users.user_id','=','users.id')->where('users.id',$id)->first();
        $state = State::all();


       return view('user.edit')->with('user',$user)->with('states',$state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        DB::table('state_users')->where('user_id',$id)->update(["state_id"=>$request->state_id]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::destroy($id);



    }
}
