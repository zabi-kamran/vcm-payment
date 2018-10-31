@extends('layout.app')
@section('title','Add New Record')
@push('headerscript')
@endpush

@section('content')



    <div style="padding:15px;">

    <div class="row">

    <div class="col-sm-11">

    <fieldset>
    <legend> <h3> Client info </h3></legend>

    <div class="table-responsive-sm">
    <table class="table">
    <thead>
        <tr>

    <th> Client First Name  </th>
    <td>{{ $payment->fname  }}  </td>

    <th> Client Last Name  </th>
    <td> {{ $payment->lname }} </td>
    </tr>

    <tr>
    <th> DOB </th>
    <td> {{ $payment->dob }} </td>

    <th>Mother Name </th>
    <td> {{ $payment->mother_name }}</td>
    </tr>

    <tr>
    <th> GSM no </th>
    <td> {{ $payment->gsm_no }} </td>

    <th>Phone </th>
    <td> {{ $payment->phone }}</td>
    </tr>


     <tr>
    <th>Monthly Pay Amount </th>
    <td> {{ $payment->pay_amt }} </td>

    <th>State </th>
    <td> {{ $payment->state_name }}</td>
    </tr>


    <tr>
    <th>LGA</th>
    <td> {{ \App\Model\Lga::find($payment->lga_id)->lga_name }} </td>

    <th>Ward </th>
    <td> {{ \App\Model\Ward::find($payment->ward_id)->ward_name }}</td>
    </tr>


     <tr>
    <th>Category</th>
    <td> {{ \App\Model\Category::find($payment->category_id)->category_name }} </td>

    <th>Created at </th>
    <td> {{ $payment->created_at }}</td>
    </tr>

      <tr>
    <th>Setellement</th>
    <td> {{ $payment->setellement }} </td>

    <th>Status </th>
    @if($payment->status==0)

    <td> <i class="badge badge-danger">In Active</i></td>

    @else
    <td><i class="badge badge-success"> Active </i> </td>

    @endif

    </tr>


    </table>
    </div>
    </fieldset>




    </div>
    </div>

    <div class="row" style="padding:15px;">


   <fieldset>

   <legend><h2> Next of Kin </h2></legend>
    <div class="col-sm-11">

        <div class="table-responsive-sm">
        <table class="table">
        <tr>
        <th>Next of Kin -Name </th>
        <td>  {{ $payment->name }} </td>


        <th> Relation </th>
        <td> {{ $payment->relation  }} </td>
        </tr>
        </table>
        </div>

        <div>
        <h4> Comments </h4>
        <p> {{ $payment->comments  }} </p>

        </div>

    </div>

    </fieldset>




    <div class="row">
    <div class="col-sm-11">

    <fieldset>
    <legend> <h2> Payment Detail </h2> </legend>

    <table class="table">

    <tr>
    <th> Payment Name </th>
    <td> {{ $payment->create_name }} </td>


    <th>Certificate</th>
   <td> <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.$payment->certificate  }}" download>
    <button class="btn btn-success"> Download </button>
    </a>
    </td>
    </tr>


    <tr>
    <th>Additional  </th>
    <td> {{ $payment->additional }} </td>

    <th> Total </th>
    <td> {{  $payment->total }} </td>
    </tr>
    </table>

    <div>
    <h4> Description </h4>
    <p> {{ $payment->description  }} </p>
    </div>



    </fieldset>


    </div>


    </div>
    </div>
    </div>


@endsection