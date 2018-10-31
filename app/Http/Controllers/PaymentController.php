<?php

namespace App\Http\Controllers;

use App\Model\Lga;
use App\Model\State;
use Illuminate\Http\Request;
use App\Model\Payment;
use App\Model\PayRecord;
use App\Model\PayClient;
use App\Model\OffPayRecord;
use App\Model\OffPayClient;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use DB;
use Excel;
use Input;
use Carbon\Carbon;
class PaymentController extends Controller
{
    public function index()
    {

        $datas=null;
        if(Auth::user()->isadmin==1)
        {

            $datas = Payment::join('lgas','lgas.id','payments.lga')
                ->join('categories','categories.id','payments.category')
                ->join('wards','wards.id','payments.ward')
                ->join('gsms','gsms.id','payments.gsm_net')
                ->join('states','states.id','payments.state')
                ->select([
                    DB::raw('payments.id as id'),
                    'fname',
                    'lname',
                    'gsm_name',
                    'gsm_no',
                    'state_name',
                    'lga_name',
                    'status',
                    'ward_name',
                    'setellment',
                    'category_name'])->get();
        }

        else
        {

            $state = DB::table('state_users')->where('user_id',Auth::id())->first()->state_id;

            $datas = Payment::join('lgas','lgas.id','payments.lga')
                ->join('categories','categories.id','payments.category')
                ->join('wards','wards.id','payments.ward')
                ->join('gsms','gsms.id','payments.gsm_net')
                ->join('states','states.id','payments.state')

                ->select([
                    DB::raw('payments.id as id'),
                    'fname',
                    'lname',
                    'gsm_name',
                    'gsm_no',
                    'state_name',
                    'lga_name',
                    'status',
                    'setellment',
                    'ward_name',
                    'category_name'])
                ->where('payments.state',$state)

                ->get();


        }


        return view('payment.index')->with('datas',$datas);
    }

    public function getData(Request $request){

        if(Auth::user()->isadmin==1)
        {

            $datas = Payment::join('lgas','lgas.id','payments.lga')
                ->join('categories','categories.id','payments.category')
                ->join('wards','wards.id','payments.ward')
                ->join('gsms','gsms.id','payments.gsm_net')
                ->join('states','states.id','payments.state')
                ->select([
                    DB::raw('payments.id as id'),
                    'fname',
                    'lname',
                    'gsm_name',
                    'gsm_no',
                    'state_name',
                    'lga_name',
                    'ward_name',
                    'category_name',
                    'total']);
            $datatables = Datatables::of($datas)
                ->addColumn('status', function ($datatables){
                    if($datatables->status==1)
                        return "<b>Active</b>";

                    else if($datatables->status==0)
                        return "<b> In Active </b>";

                    else if($datatables->stauts==-1)
                        return "<b>Delisted</b>";
                })
                ->addColumn('action', function ($datatables) {
                    return '<a href="'.route('payment.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
                })->rawColumns(['status','action']);

        }

        else
        {

            $datas = Payment::join('lgas','lgas.id','payments.lga')
                ->join('categories','categories.id','payments.category')
                ->join('wards','wards.id','payments.ward')
                ->join('gsms','gsms.id','payments.gsm_net')
                ->join('states','states.id','payments.state')
                ->join('state_users','state_users.state_id','=','states.id')
                ->select([
                    DB::raw('payments.id as id'),
                    'fname',
                    'lname',
                    'gsm_name',
                    'gsm_no',
                    'state_name',
                    'lga_name',
                    'ward_name',
                    'category_name',
                    'total']);
            $datatables = Datatables::of($datas)
                ->addColumn('status', function ($datatables){
                    if($datatables->status==1)
                        return "<b>Active</b>";

                    else if($datatables->status==0)
                        return "<b> In Active </b>";

                    else if($datatables->stauts==-1)
                        return "<b>Delisted</b>";
                })
                ->addColumn('action', function ($datatables) {
                    return '<a href="'.route('payment.edit',$datatables->id).'" class="btn btn-primary btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>&nbsp&nbsp
            <button class="btn btn-danger btn-icon btn-rounded btn-xs" onclick="deleteit('.$datatables->id.')"><i class="icon-trash"></i></button>';
                })->rawColumns(['status','action']);

        }

        return $datatables->make(true);
    }

    function exportexcel(){
        $payments = Payment::join('lgas','lgas.id','payments.lga')
            ->join('categories','categories.id','payments.category')
            ->join('wards','wards.id','payments.ward')
            ->join('gsms','gsms.id','payments.gsm_net')
            ->join('states','states.id','payments.state')
            ->select([
                'fname',
                'lname',
                'mother_name',
                'dob',
                'gsm_name',
                'gsm_no',
                'state_name',
                'lga_name',
                'ward_name',
                'category_name',
                'setellment',
                'created_at'
            ])->get();

        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['First Name', 'Last Name', 'Mother Name','DOB','GSM NET ','GSM No','State','LGA','WARD','Category','Settlements','created_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('Invoice Report', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Invoice Report');
            $excel->setCreator('Laravel')->setCompany('Payment Excel VCM, LLC');
            $excel->setDescription('Invoice file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }

    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {


        $this->validate($request,[
            'state'=>'required',
            'lga'=>'required',
            'ward'=>'required',
            'gsm_net'=>'required',
            'fname'=>'required|alpha',
            'lname'=>'required|alpha',
            'mother_name'=>'required',
            'dob'=>'required',
            'gsm_no'=>'required|digits:13',
            'category'=>'required',
            'gender'=>'required',
            'pay_amt'=>'required',
            'setellment'=>'required',
//            'relation'=>'required',

        ]);

        $data=new Payment();
        $data->state=$request->state;
        $data->lga=$request->lga;
        $data->ward=$request->ward;
        $data->gsm_net=$request->gsm_net;
        $data->fname=$request->fname;
        $data->lname=$request->lname;
        $data->gender=$request->gender;
        $data->mother_name=$request->mother_name;
        $data->dob=date('Y-m-d', strtotime($request->dob));
        $data->gsm_no=$request->gsm_no;
        $data->category=$request->category;
        $data->pay_amt=$request->pay_amt;
        $data->status=$request->status;
        $data->phone = $request->phone;
        $data->comments = $request->comments;
        $data->setellment=$request->setellment;
        $data->name= $request->name;
        $data->relation= $request->relation;

        // if ($request->hasFile('certificate')) {
        //     $image = $request->file('certificate');
        //     $filename = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/certificates');
        //     $image->move($destinationPath, $filename);
        //     $data->certificate="certificates/".$filename;
        // }
        $data->save();
        return redirect('payment');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $row=Payment::find($id);
        return view('payment.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'state'=>'required',
            'lga'=>'required',
            'ward'=>'required',
            'gsm_net'=>'required',
            'fname'=>'required',
            'lname'=>'required',
            'mother_name'=>'required',
            'dob'=>'required',
            'gsm_no'=>'required',
            'category'=>'required',
            'gender'=>'required',
            'pay_amt'=>'required'
        ]);
        $data=Payment::find($id);
        $data->state=$request->state;
        $data->lga=$request->lga;
        $data->ward=$request->ward;
        $data->gsm_net=$request->gsm_net;
        $data->fname=$request->fname;
        $data->lname=$request->lname;
        $data->gender=$request->gender;
        $data->mother_name=$request->mother_name;
        $data->dob=date('Y-m-d', strtotime($request->dob));
        $data->gsm_no=$request->gsm_no;
        $data->category=$request->category;
        $data->pay_amt=$request->pay_amt;
        //$data->other=$request->other;
        // $data->total=$request->pay_amt+$request->other;


        $data->status=$request->status;
        $data->phone = $request->phone;
        $data->comments = $request->comments;
        $data->setellment=$request->setellment;
        $data->name= $request->name;
        $data->relation= $request->relation;
        // $data->status=0;
        // if ($request->hasFile('certificate')) {
        //     $image = $request->file('certificate');
        //     $filename = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/certificates');
        //     $image->move($destinationPath, $filename);
        //     $data->certificate="certificates/".$filename;
        // }
        $data->save();
        return redirect('payment');
    }

    public function payrecord()
    {
        return view('payment.payment');
        $data->other=$request->other;
    }

    public function payrecordsave(Request $request){
        /* $this->validate($request,[
             'create_name'=>'required|alpha',
             'certificate'=>'required'
         ]);*/

        $paydata=new PayRecord();
        $paydata->create_name=$request->create_name;
        $paydata->description=$request->description;
        $paydata->isconfirmed =0;
        if ($request->hasFile('certificate')) {
            $image = $request->file('certificate');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/certificates');
            $image->move($destinationPath, $filename);
            $paydata->certificate="certificates/".$filename;
        }
        $paydata->save();
        $id=$paydata->id;
        $cust_id=$request->cust_id;
        $additional= $request->additional;

        foreach ($cust_id as $key => $row) {



            $ids = explode("_",$cust_id[$key]);

            $client=new PayClient();
            $client->cust_id=$ids[1];
            $client->pay_id=$id;
            $client->additional = $request->additional[$ids[0]];
            $client->total= $request->total[$ids[0]];
            $client->save();
        }
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        \Illuminate\Support\Facades\DB::table('paid_lga')->insert(["lga_id"=>$request->lga,"month"=>$month,"year"=>$year,"pay_record_id"=>$id]);

        return redirect('howitworks');

    }

    public function GetPayList(){
        $lga_id=Input::get('lga_id');

	 $total =  $data=Payment::where('lga',$lga_id)->where('status',1)->where('category','!=',10)->count();

        session()->put('total_vcm',$total);



        $data=Payment::where('lga',$lga_id)->where('status',1)->where('category','!=',10)->get();
        return view('payment.paylist',compact('data'));

    }

    public function destroy($id)
    {
        $data=Payment::find($id);
        $data->delete();
    }

    public function all_payments(Request $request)
    {

        if(Auth::user()->isadmin==1) {



        }

        else
        {



        }


        $data=\Illuminate\Support\Facades\DB::table('pay_records')->get();

        $states = State::all();


        return view("payment.all")->with('payments',$data)->with('states',$states);

    }

    public function getDetail($id)
    {


        $data = \Illuminate\Support\Facades\DB::table('pay_records')
            ->select('payments.fname as fname',
                'pay_records.create_name as create_name', 'payments.id as id',
                'payments.lname as lname',
                'payments.dob as dob',
                'payments.mother_name as mother_name',
                'payments.gsm_no as gsm_no',
                'payments.phone as phone',
                'payments.pay_amt as pay_amt',
                'payments.lga as lga_id',
                'payments.created_at as created_at',
                'payments.setellment as setellement',
                'payments.status as status',
                'payments.category as category_id',
                'payments.name as name',
                'payments.relation as relation',
                'payments.comments as comments',
                'pay_records.certificate as certificate',
                'pay_records.description as description',
                'pay_records.created_at as created_at',
                'pay_records.create_name as create_name',
                'states.state_name as state_name',
                'payments.ward as ward_id',
                'pay_clients.additional as additional',
                'pay_clients.total as total',
                'pay_clients.id as record_id'
            )
            ->join('pay_clients', 'pay_clients.pay_id', '=', 'pay_records.id')
            ->join('payments', 'payments.id', '=', 'pay_clients.cust_id')
            ->join('states', 'states.id', '=', 'payments.state')
            ->where('pay_clients.id',$id)
            ->orderby('pay_clients.id',"DESC")->first();



        return view('payment.detail')
            ->with('payment',$data);


    }


    public function get_payment_clients($id)
    {

        $data= \Illuminate\Support\Facades\DB::table('payments')
            ->select("payments.fname as fname","payments.lname as lname","payments.gsm_no as phone","pay_clients.id as record_id")
            ->join('pay_clients','pay_clients.cust_id','=','payments.id')->where('pay_clients.pay_id',$id)->get();


        return view('payment.pay_clients')->with('clients',$data);
    }

    public function export_pay_clients($id)
    {

        // ->where('pay_clients.pay_id',$id)->get();

        $datas = \Illuminate\Support\Facades\DB::table('pay_clients')

            ->select(
                'payments.lname as lname',
                'payments.fname as fname',
                'payments.phone as phone',
                'payments.gsm_no as gsm_no',
                'pay_clients.total as amount',
                'lgas.lga_name as lga_name',
                'states.state_name as state_name',
                'categories.category_name as category_name',
                'pay_clients.created_at as date'
            )
            ->join('payments','payments.id','=','pay_clients.cust_id')
            ->join('categories','payments.category','=','categories.id')
            ->join('lgas','lgas.id','=','payments.lga')
            ->join('states','states.id','=','payments.state')
            ->where('pay_clients.pay_id',$id)
            ->get();


        $paymentsArray=array();

        $paymentsArray[] = ['Beneficiary Name', 'Mobile No','Description','Amount','Debit Account'];

        foreach($datas as $data)
        {

            $ar['name'] = $data->fname.' '.$data->lname;
            $ar['mobile']= $data->gsm_no;
            $ar['description']=$data->state_name.' '.$data->lga_name.' '.$data->category_name.' '.$data->date;
            $ar['amount'] = $data->amount;
            $ar['debit_amount']='';

            array_push($paymentsArray,$ar);

        }

        Excel::create('Invoice Report', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Invoice Report');
            $excel->setCreator('Laravel')->setCompany('Payment Excel VCM, LLC');
            $excel->setDescription('Invoice file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');


    }

    public function export_months(Request $request)
    {

        $months=['Jan','Feb','March','April','May','June','July','August','September','October','November','December'];

        $state =$request->state_id;
        $month = $request->month;

        $year  = Carbon::now()->year;


        $datas = \Illuminate\Support\Facades\DB::table('pay_clients')

            ->select(
                'payments.lname as lname',
                'payments.fname as fname',
                'payments.phone as phone',
                'payments.gsm_no as gsm_no',
                'pay_clients.total as amount',
                'lgas.lga_name as lga_name',
                'states.state_name as state_name',
                'categories.category_name as category_name',
                'pay_clients.created_at as date'
            )
            ->join('payments','payments.id','=','pay_clients.cust_id')
            ->join('categories','payments.category','=','categories.id')
            ->join('lgas','lgas.id','=','payments.lga')
            ->join('states','states.id','=','payments.state')
            ->where('payments.state',$state)
            ->whereYear('pay_clients.created_at',$year)
            ->whereMonth('pay_clients.created_at',$month)
            ->get();


        $paymentsArray=array();

        $paymentsArray[] = ['Beneficiary Name', 'Mobile No','Description','Amount','Debit Account'];

        foreach($datas as $data)
        {

            $ar['name'] = $data->fname.' '.$data->lname;
            $ar['mobile']= $data->gsm_no;
            $ar['description']=$data->state_name.' '.$data->lga_name.' '.$data->category_name.' '.$months[$month-1].' '.$year;
            $ar['amount'] = $data->amount;
            $ar['debit_amount']='';

            array_push($paymentsArray,$ar);

        }

        // Define the Excel spreadsheet headers


//        // Convert each member of the returned collection into an array,
//        // and append it to the payments array.
//        foreach ($payments as $payment) {
//            $paymentsArray[] = json_decode(json_encode($payment),true);
//        }

        // Generate and return the spreadsheet

        $state_name=State::find($request->state_id)->state_name;
        $month_name = $months[$month-1];

        $filename=$state_name.' '.$month_name.'- Payment Report';

        Excel::create($filename, function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Invoice Report');
            $excel->setCreator('Laravel')->setCompany('Payment Excel VCM, LLC');
            $excel->setDescription('Invoice file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');



    }

    public function confirm(Request $request)
    {
        $payment=PayRecord::find($request->id);

        $payment->isconfirmed="1";

        $payment->save();

        return redirect()->back();


    }

    public function history(Request $request)
    {

        if($request->state!=null && $request->lga!=null) {


            $datas = null;
            if (Auth::user()->isadmin == 1) {

                $datas = Payment::join('lgas', 'lgas.id', 'payments.lga')
                    ->join('categories', 'categories.id', 'payments.category')
                    ->join('wards', 'wards.id', 'payments.ward')
                    ->join('gsms', 'gsms.id', 'payments.gsm_net')
                    ->join('states', 'states.id', 'payments.state')
                    ->select([
                        DB::raw('payments.id as id'),
                        'fname',
                        'lname',
                        'gsm_name',
                        'gsm_no',
                        'state_name',
                        'lga_name',
                        'status',
                        'ward_name',
                        'setellment',
                        'category_name'])
                    ->where('payments.state',$request->state)
                    ->where('payments.lga',$request->lga)
                    ->get();


            } else {

                $datas = Payment::join('lgas', 'lgas.id', 'payments.lga')
                    ->join('categories', 'categories.id', 'payments.category')
                    ->join('wards', 'wards.id', 'payments.ward')
                    ->join('gsms', 'gsms.id', 'payments.gsm_net')
                    ->join('states', 'states.id', 'payments.state')
                    ->join('state_users', 'state_users.state_id', '=', 'states.id')
                    ->select([
                        DB::raw('payments.id as id'),
                        'fname',
                        'lname',
                        'gsm_name',
                        'gsm_no',
                        'state_name',
                        'lga_name',
                        'status',
                        'ward_name',
                        'category_name'])
                    ->where('payments.state',$request->state)
                    ->where('payments.lga',$request->lga)
                    ->get();


            }

        }
        else
        {
            $datas=array();

        }


        $states = State::all();
        $lgas = Lga::all();

        return view('payment.history')
            ->with('datas',$datas)
            ->with('states',$states)
            ->with('lgas',$lgas);

    }

    public function paid_clients($id)
    {

        $datas = \Illuminate\Support\Facades\DB::table('pay_clients')
            ->select(
                'payments.lname as lname',
                'payments.fname as fname',
                'payments.gsm_no as gsm_no',
                'pay_clients.total as total',
                'pay_clients.created_at as date',
                'payments.id as id',
                'pay_clients.status as status'
            )
            ->join('payments','payments.id','=','pay_clients.cust_id')
            ->where('pay_clients.pay_id',$id)->get();


        return view('payment.paid_clients')
            ->with('clients',$datas)->with('payment_id',$id);
    }


    public function history_export()
    {

        $paymentsArray[] = ['First Name', 'Last Name','Phone','State','LGA','Ward','Setellment','Category','Status','Date Paid','Date Confirmed'];

        $datas=DB::table('pay_clients')->join('payments','payments.id','=','pay_clients.cust_id')

            -> select('payments.fname as fname',
                'payments.lname',
                'payments.gsm_no',
                'states.state_name as state_name',
                'lgas.lga_name as lga_name',
                'wards.ward_name as ward_name',
                'payments.setellment as setellment',
                'categories.category_name as category_name',
                'pay_clients.status as status',
                'pay_clients.created_at as created_at',
                'pay_clients.confirm_date as confirm_date'
            )
            ->join('lgas','lgas.id','=','payments.lga')
            ->join('wards','wards.id','=','payments.ward')
            ->join('categories','categories.id','=','payments.category')
            ->join('states','states.id','=','payments.state')
            ->get();


        foreach($datas as $data)
        {

            $ar['fname']=$data->fname;
            $ar['lname']=$data->lname;
            $ar['gsm_no']=$data->gsm_no;
            $ar['state_name']=$data->state_name;
            $ar['lga_name']=$data->lga_name;
            $ar['ward_name']=$data->ward_name;
            $ar['setellment']=$data->setellment;
            $ar['category_name']=$data->category_name;

            if($data->status==1)
                $ar['status']="Confirmed";

            else if($data->status==-1)
                $ar["status"]="Not Confirmed";

            else if($data->status==0)
                $ar["status"]="Paid";

            $ar["created_at"]=$data->created_at;
            $ar["confirm_date"]=$data->confirm_date;

            array_push($paymentsArray,$ar);

        }

        $filename="Payment history";

        Excel::create($filename, function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Invoice Report');
            $excel->setCreator('Laravel')->setCompany('Payment Excel VCM, LLC');
            $excel->setDescription('Invoice file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');



    }

    public function update_payment_status(Request $request,$id)
    {


        $statuses=$request->status;

        foreach($statuses as $key=>$value)
        {

            $date=date('d-m-y');
            DB::table('pay_clients')->where("cust_id",$key)->where("pay_id",$id)->update(["status"=>$value,"confirm_date"=>$date]);


        }





        return redirect()->back();

    }


    public function all_payments_delete($id)
    {


        \Illuminate\Support\Facades\DB::table('pay_records')->where('id',$id)->delete();
        \Illuminate\Support\Facades\DB::table('paid_lga')->where('pay_record_id',$id)->delete();
        \Illuminate\Support\Facades\DB::table('pay_clients')->where('pay_id',$id)->delete();

        return redirect()->back();


    }

    // Divyang
    public function offpayment()
    {

        $datas=null;
        if(Auth::user()->isadmin==1)
        {

            $datas = Payment::join('lgas','lgas.id','payments.lga')
                ->join('categories','categories.id','payments.category')
                ->join('wards','wards.id','payments.ward')
                ->join('gsms','gsms.id','payments.gsm_net')
                ->join('states','states.id','payments.state')
                ->select([
                    DB::raw('payments.id as id'),
                    'fname',
                    'lname',
                    'gsm_name',
                    'gsm_no',
                    'state_name',
                    'lga_name',
                    'status',
                    'ward_name',
                    'setellment',
                    'category_name'])->get();
        }

        else
        {

            $state = DB::table('state_users')->where('user_id',Auth::id())->first()->state_id;

            $datas = Payment::join('lgas','lgas.id','payments.lga')
                ->join('categories','categories.id','payments.category')
                ->join('wards','wards.id','payments.ward')
                ->join('gsms','gsms.id','payments.gsm_net')
                ->join('states','states.id','payments.state')

                ->select([
                    DB::raw('payments.id as id'),
                    'fname',
                    'lname',
                    'gsm_name',
                    'gsm_no',
                    'state_name',
                    'lga_name',
                    'status',
                    'setellment',
                    'ward_name',
                    'category_name'])
                ->where('payments.state',$state)

                ->get();


        }


        return view('offpayment.index')->with('datas',$datas);
    }

    public function offpayrecord()
    {
        return view('offpayment.payment');
        $data->other=$request->other;
    }

    public function offGetPayList(){
        $lga_id=Input::get('lga_id');
        $category=Input::get('category');
        

        $total =  $data=Payment::where('lga',$lga_id)->where('status',1)->where('category',$category)->count();

        session()->put('total_vcm',$total);



        $data=Payment::where('lga',$lga_id)->where('status',1)->where('category',$category)->get();
        return view('offpayment.paylist',compact('data'));

    }
    public function offpayrecordsave(Request $request){
        /* $this->validate($request,[
             'create_name'=>'required|alpha',
             'certificate'=>'required'
         ]);*/

        $paydata=new OffPayRecord();
        $paydata->create_name=$request->create_name;
        $paydata->description=$request->description;
        $paydata->isconfirmed =0;
        if ($request->hasFile('certificate')) {
            $image = $request->file('certificate');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/certificates');
            $image->move($destinationPath, $filename);
            $paydata->certificate="certificates/".$filename;
        }
        $paydata->save();
        $id=$paydata->id;
        $cust_id=$request->cust_id;
        $additional= $request->additional;

        foreach ($cust_id as $key => $row) {

            $ids = explode("_",$cust_id[$key]);

            $client=new OffPayClient();
            $client->cust_id=$ids[1];
            $client->pay_id=$id;
            $client->additional = $request->additional[$ids[0]];
            $client->total= $request->total[$ids[0]];
            $client->save();
        }
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        \Illuminate\Support\Facades\DB::table('off_paid_lga')->insert(["lga_id"=>$request->lga,"month"=>$month,"year"=>$year,"pay_record_id"=>$id]);

        return redirect('howitworks');

    }
    public function off_all_payments(Request $request)
    {

        if(Auth::user()->isadmin==1) {



        }

        else
        {



        }


        $data=\Illuminate\Support\Facades\DB::table('off_pay_records')->get();

        $states = State::all();


        return view("offpayment.all")->with('payments',$data)->with('states',$states);

    }
    public function off_export_months(Request $request)
    {
        $months=['Jan','Feb','March','April','May','June','July','August','September','October','November','December'];

        $state =$request->state_id;
        $month = $request->month;

        $year  = Carbon::now()->year;


        $datas = \Illuminate\Support\Facades\DB::table('off_pay_clients')

            ->select(
                'payments.lname as lname',
                'payments.fname as fname',
                'payments.phone as phone',
                'payments.gsm_no as gsm_no',
                'off_pay_clients.total as amount',
                'lgas.lga_name as lga_name',
                'states.state_name as state_name',
                'categories.category_name as category_name',
                'off_pay_clients.created_at as date'
            )
            ->join('payments','payments.id','=','off_pay_clients.cust_id')
            ->join('categories','payments.category','=','categories.id')
            ->join('lgas','lgas.id','=','payments.lga')
            ->join('states','states.id','=','payments.state')
            ->where('payments.state',$state)
            ->whereYear('off_pay_clients.created_at',$year)
            ->whereMonth('off_pay_clients.created_at',$month)
            ->get();


        $paymentsArray=array();

        $paymentsArray[] = ['Beneficiary Name', 'Mobile No','Description','Amount','Debit Account'];

        foreach($datas as $data)
        {

            $ar['name'] = $data->fname.' '.$data->lname;
            $ar['mobile']= $data->gsm_no;
            $ar['description']=$data->state_name.' '.$data->lga_name.' '.$data->category_name.' '.$months[$month-1].' '.$year;
            $ar['amount'] = $data->amount;
            $ar['debit_amount']='';

            array_push($paymentsArray,$ar);

        }

        // Define the Excel spreadsheet headers


//        // Convert each member of the returned collection into an array,
//        // and append it to the payments array.
//        foreach ($payments as $payment) {
//            $paymentsArray[] = json_decode(json_encode($payment),true);
//        }

        // Generate and return the spreadsheet

        $state_name=State::find($request->state_id)->state_name;
        $month_name = $months[$month-1];

        $filename=$state_name.' '.$month_name.'- Payment Report';

        Excel::create($filename, function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Invoice Report');
            $excel->setCreator('Laravel')->setCompany('Payment Excel VCM, LLC');
            $excel->setDescription('Invoice file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');



    }
    public function off_paid_clients($id)
    {

        $datas = \Illuminate\Support\Facades\DB::table('off_pay_clients')
            ->select(
                'payments.lname as lname',
                'payments.fname as fname',
                'payments.gsm_no as gsm_no',
                'off_pay_clients.total as total',
                'off_pay_clients.created_at as date',
                'payments.id as id',
                'off_pay_clients.status as status'
            )
            ->join('payments','payments.id','=','off_pay_clients.cust_id')
            ->where('off_pay_clients.pay_id',$id)->get();


        return view('offpayment.paid_clients')
            ->with('clients',$datas)->with('payment_id',$id);
    }
    public function off_update_payment_status(Request $request,$id)
    {

        $statuses=$request->status;

        foreach($statuses as $key=>$value)
        {

            $date=date('d-m-y');
            DB::table('off_pay_clients')->where("cust_id",$key)->where("pay_id",$id)->update(["status"=>$value,"confirm_date"=>$date]);


        }





        return redirect()->back();

    }
    public function off_get_payment_clients($id)
    {

        $data= \Illuminate\Support\Facades\DB::table('payments')
            ->select("payments.fname as fname","payments.lname as lname","payments.gsm_no as phone","off_pay_clients.id as record_id")
            ->join('off_pay_clients','off_pay_clients.cust_id','=','payments.id')->where('off_pay_clients.pay_id',$id)->get();


        return view('offpayment.pay_clients')->with('clients',$data);
    }
    public function offgetDetail($id)
    {

        $data = \Illuminate\Support\Facades\DB::table('off_pay_records')
            ->select('payments.fname as fname',
                'off_pay_records.create_name as create_name', 'payments.id as id',
                'payments.lname as lname',
                'payments.dob as dob',
                'payments.mother_name as mother_name',
                'payments.gsm_no as gsm_no',
                'payments.phone as phone',
                'payments.pay_amt as pay_amt',
                'payments.lga as lga_id',
                'payments.created_at as created_at',
                'payments.setellment as setellement',
                'payments.status as status',
                'payments.category as category_id',
                'payments.name as name',
                'payments.relation as relation',
                'payments.comments as comments',
                'off_pay_records.certificate as certificate',
                'off_pay_records.description as description',
                'off_pay_records.created_at as created_at',
                'off_pay_records.create_name as create_name',
                'states.state_name as state_name',
                'payments.ward as ward_id',
                'off_pay_clients.additional as additional',
                'off_pay_clients.total as total',
                'off_pay_clients.id as record_id'
            )
            ->join('off_pay_clients', 'off_pay_clients.pay_id', '=', 'off_pay_records.id')
            ->join('payments', 'payments.id', '=', 'off_pay_clients.cust_id')
            ->join('states', 'states.id', '=', 'payments.state')
            ->where('off_pay_clients.id',$id)
            ->orderby('off_pay_clients.id',"DESC")->first();
            
        return view('offpayment.detail')
            ->with('payment',$data);


    }
    public function off_export_pay_clients($id)
    {
        // ->where('pay_clients.pay_id',$id)->get();

        $datas = \Illuminate\Support\Facades\DB::table('off_pay_clients')

            ->select(
                'payments.lname as lname',
                'payments.fname as fname',
                'payments.phone as phone',
                'payments.gsm_no as gsm_no',
                'off_pay_clients.total as amount',
                'lgas.lga_name as lga_name',
                'states.state_name as state_name',
                'categories.category_name as category_name',
                'off_pay_clients.created_at as date'
            )
            ->join('payments','payments.id','=','off_pay_clients.cust_id')
            ->join('categories','payments.category','=','categories.id')
            ->join('lgas','lgas.id','=','payments.lga')
            ->join('states','states.id','=','payments.state')
            ->where('off_pay_clients.pay_id',$id)
            ->get();


        $paymentsArray=array();

        $paymentsArray[] = ['Beneficiary Name', 'Mobile No','Description','Amount','Debit Account'];

        foreach($datas as $data)
        {

            $ar['name'] = $data->fname.' '.$data->lname;
            $ar['mobile']= $data->gsm_no;
            $ar['description']=$data->state_name.' '.$data->lga_name.' '.$data->category_name.' '.$data->date;
            $ar['amount'] = $data->amount;
            $ar['debit_amount']='';

            array_push($paymentsArray,$ar);

        }

        Excel::create('Invoice Report', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Invoice Report');
            $excel->setCreator('Laravel')->setCompany('Payment Excel VCM, LLC');
            $excel->setDescription('Invoice file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');


    }
    public function off_all_payments_delete($id)
    {

        \Illuminate\Support\Facades\DB::table('off_pay_records')->where('id',$id)->delete();

        return redirect()->back();


    }
    // end

}
