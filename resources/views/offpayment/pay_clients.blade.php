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
                          <div class="table-responsive">
                        <table class="table datatable-basic" id="datatable">
                            <thead>
                                <tr>

                                    <th> ID </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Phone </th>
                                    <th> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($clients as $client)

                            <tr>
                            <td>{{ $client->record_id }} </td>
                            <td> {{ $client->fname }} </td>
                            <td> {{ $client->lname }} </td>
                            <td> {{ $client->phone  }} </td>
                            <td> <a class="btn btn-primary" href="../../offpayment/detail/{{ $client->record_id }}"> Details </a> </td>



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

<script>
$(document).ready(function(){


    $('.datatable-basic').DataTable();
});

</script>

@endpush
@endsection