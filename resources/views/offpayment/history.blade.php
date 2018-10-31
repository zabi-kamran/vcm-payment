@extends('layout.app')
@section('title','Payments')


@section('content')
 <!-- Main content -->



            <div class="content-wrapper">
                   <div class="page-header">
                    <div class="page-header-content">

                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payments</h4>

                        <div class="heading-elements">
                            <a href="{{ route('payment.create') }}" class="btn bg-blue btn-labeled heading-btn">
                            <b><i class="icon-plus3"></i></b> Add New Records</a>&nbsp;&nbsp;&nbsp;
                            <a href="{{ url('payment/payrecord') }}" class="btn bg-green btn-labeled heading-btn"><b><i class="icon-plus3"></i></b> Make New Payment</a>

            <a href='history/export' class="btn bg-green btn-labeled heading-btn"><b><i class="icon-download"></i></b>Export</a>



                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <div class="row">

                        <form method="POST">

                        {{ csrf_field() }}
                        <div class="col-sm-4">


                       <select class="form-control" name="state" required>

                       @foreach($states as $state)

                       <option value="{{ $state->id }}"> {{ $state->state_name }} </option>
                       @endforeach
                       </select>
                        </div>
                         <div class="col-sm-4">


                        <select class="form-control" name="lga" required>

                        @foreach($lgas as $lga)

                        <option value="{{ $lga->id }}">  {{ $lga->lga_name }} </option>


                        @endforeach

                        </select>
                        </div>
                         <div class="col-sm-4">


                       <input type="submit" class="btn btn-success" value="Filter"/>
                        </div>
                </form>
                    </div>
                    <!-- Basic table -->
                    <div class="panel panel-flat" style="margin-top:20px;">
                        <div class="table-responsive">
                        <table class="table datatable-basic" id="datatable">
                            <thead>
                                <tr>
                                <th> ID </th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>GSM No</th>
                                    <th>State</th>
                                    <th>LGA</th>
                                    <th> Ward </th>
                                    <th> Setellement </th>
                                    <th>Category</th>

                                    <th>Status </th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>


                                </tr>
                            </thead>

                            <tbody>

                            @foreach($datas as $payment)


                            <tr>
                            <td> {{ $payment->id }} </td>
                            <td> {{ $payment->fname }} </td>
                            <td> {{ $payment->lname }} </td>

                            <td> {{ $payment->gsm_no }} </td>

                            <td> {{ $payment->state_name  }} </td>
                            <td> {{ $payment->lga_name  }} </td>
                            <td> {{ $payment->ward_name  }} </td>
                            <td> {{ $payment->setellment }} </td>
                            <td> {{$payment->category_name }} </td>


                            @if($payment->status==0)
                            <td style="background-color: #F08080;color:white;"> InActive </td>

                            @else
                            <td style="background-color: green;color:white;">Active </td>
                            @endif

                            <?php

                            $client_payments = \Illuminate\Support\Facades\DB::table('pay_clients')
                            ->where('cust_id',$payment->id)
                            ->orderBy('created_at','desc')
                            ->take(6)
                            ->get()->toArray();


                            $len = sizeof($client_payments);

                            for($a=0;$a<6;$a++)
                            {

                               if(isset($client_payments[$a]))
                               {

                               if($client_payments[$a]->status==1)
                                {

                                echo '<td> <div style="width:30px;height: 30px;background-color: green;">  </div>  </td>';
                                }

                                else
                                {

                                echo '<td> <div style="width:30px;height: 30px;background-color: yellow;"> </div> </td>';
                                }



                               }
                               else
                               {

                        echo '<td> </td>';

                               }

                            }

                ?>




                            </tr>


                            @endforeach

                            </tbody>

                            <tfoot>
                             <tr>
                            <th> ID </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>GSM No</th>
                            <th>State</th>
                            <th>LGA</th>
                            <th> Ward </th>
                             <th> Setellement </th>
                            <th>Category</th>

                            <th>Status </th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>

                        </tr>
                            </tfoot>


                        </table>


                    </div>

                    </div>

                    <!-- /basic table -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->
@push('footerscript')
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>

<script>
    $(function() {


    var table=$('#datatable').DataTable();


    table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );


});

</script>
<script>
     // Alert combination
    function deleteit(id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                url: "payment"+'/'+id,
                type: 'delete',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_token":"{{ csrf_token() }}"
                },
            });
            $('.datatable-basic').DataTable().draw(false);
            swal("Deleted!", "User has been deleted!", "success");
            }
            else {
                swal({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });
    }
</script>
@endpush
@endsection