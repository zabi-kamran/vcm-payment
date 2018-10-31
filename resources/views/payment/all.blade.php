@extends('layout.app')
@section('title','Payments')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">

                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
                    <!-- Basic table -->
                    <div class="panel panel-flat">
                    <div class="row" style="padding:15px;">

                    <form method="POST" action="all/export">
                    {{ csrf_field()  }}

                    <div class="col-sm-4">
                    <div class="form-group">

                     <label> <b>Select State</b> </label>

                      <select class="form-control" name="state_id">
                        @foreach($states as $state)

                        <option value="{{ $state->id }}"> {{ $state->state_name }} </option>

                        @endforeach

                      </select>

                    </div>

                    </div>

                    <div class="col-sm-4">
                    <div class="form-group">
                    <label> <b>Select Month</b> </label>
                    <select class="form-control" name="month">

                    <option value="1"> January </option>
                    <option value="2"> February </option>
                    <option value="3"> March </option>
                    <option value="4"> April </option>
                    <option value="5"> May </option>
                    <option value="6"> June </option>
                    <option value="7"> July </option>
                    <option value="8"> August </option>
                    <option value="9"> September </option>
                    <option value="10"> October </option>
                    <option value="11"> Novemeber </option>
                    <option value="12"> December </option>

                    </select>
                    </div>
                    </div>



                    <div class="col-sm-3">
                    <div class="form-group">
                    <label> <b> Click to Export </b></label>
                    <input type="submit" class="btn btn-success form-control" value="Go">
                    </div>
                    </div>

                    </form>
                    </div>
                          <div class="table-responsive">
                        <table class="table datatable-basic" id="datatable">
                            <thead>
                                <tr>

                                    <th> ID </th>
                                    <th> Payment Name </th>
                                    <th> LGA </th>
                                    <th> State </th>
                                    <th> No of People Paid </th>
                                    <th> Total Amount Paid </th>
                                    <th> Date </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                    <th> Details </th>
                                    <th> Excel </th>
                                    <th> Delete</th>

                                </tr>
                            </thead>

                            <tbody>

                            @foreach($payments as $payment)

                            <tr>
                            <td> {{ $payment->id }} </td>
                            <td> {{ $payment->create_name }} </td>
                            <td>
                            <?php

                            $data=\Illuminate\Support\Facades\DB::table('paid_lga')->where('pay_record_id',$payment->id)->first();

                            if($data)
                            {

                            $lga_name=\App\Model\Lga::find($data->lga_id)->lga_name;

                            echo $lga_name;

                            }
                            else
                            {
                            echo 'N/A';
                            }

                            ?>
                            </td>

                             @if($data)
                           <td> {{ \App\Model\State::find(\App\Model\Lga::find($data->lga_id)->state_id)->state_name  }} </td>

                           @else
                           <td> N/A </td>
                           @endif

                            <td> {{ \Illuminate\Support\Facades\DB::table('pay_clients')->where('pay_id',$payment->id)->count()  }} </td>
                            <td>{{ \Illuminate\Support\Facades\DB::table('pay_clients')->where('pay_id',$payment->id)->sum('total')  }}</td>
                            <td>{{ $payment->created_at  }}</td>
                            <td>
                             @if($payment->isconfirmed==0 || $payment->isconfirmed==null)
                            <form method="POST" action="confirm">
                            {{ csrf_field() }}
                            <input type="hidden" value="1" name="isconfirmed"/>
                            <input type="hidden" value="{{ $payment->id }}" name="id"/>
                            <a href="{{ route('paid.clients',$payment->id) }}" class="btn btn-danger"> Confirm </a>

                            </form>
                            @else
                            <button disabled class="btn btn-default"> Confirmed  </button>
                             @endif

                             </td>
                            <td><a class="btn btn-primary" href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.$payment->certificate }}" download> Download</a>  </td>
                            <td> <a class="btn btn-warning" href="pay_clients/{{ $payment->id }}"> Clients</a> </td>
                            <td><a class="btn btn-success" href="pay_clients/export/{{ $payment->id }}"> Excel </a></td>
                            <td><a class="btn btn-default" href="all/delete/{{ $payment->id  }}"> Delete </a>  </td>

                            </tr>

                            @endforeach
                            </tbody>
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
<script type="text/javascript">
    function ExportCsv(){
        window.location.href = "{{ url('payment/exportexcel') }}";
    }
</script>
<script>
    $(function() {
    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {

        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
    });
    // Basic datatable
    $('.datatable-basic').DataTable();
});


@endpush
@endsection