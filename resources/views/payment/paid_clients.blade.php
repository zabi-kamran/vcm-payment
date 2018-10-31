@extends('layout.app')
@section('title','Payments')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">

                <!-- /page header -->
                <!-- Content area -->
                <div class="content">

                <div style="margin:12px;">
                <button type="button" class="btn btn-primary" onclick="all_confirmed()"> All Confirmed </button>
                <button type="button" class="btn btn-success" onclick="all_unconfirmed()"> All UnConfirmed</button>

                </div>
                    <!-- Basic table -->
                    <form method="POST" action="{{ route('paid.clients.status.update',$payment_id) }}">\

                    {{ csrf_field() }}

                    <div class="panel panel-flat">
                    <div class="row" style="padding:15px;">


                    </div>



                          <div class="table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                            <tr>

                            <th> Status  </th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Total Amount </th>
                            <th> Date </th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($clients as $client)
                            <tr>

                            <td>

                            <label>
                            Confirmed
                            <input type="radio" class="confirm" name="status[{{ $client->id }}]" value="1" @if($client->status==1)  checked="checked"  @endif>

                            </label>


                            <label>
                            Not Confirmed <input class="notconfirm" type="radio" name="status[{{ $client->id }}]" value="-1"  @if($client->status==-1) checked="checked"  @endif/>
                            </label>


                        </td>


                            <td> {{ $client->fname }} </td>
                            <td> {{ $client->lname }} </td>
                            <td> {{ $client->total }} </td>
                            <td> {{ $client->date  }}</td>


                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>






                    </div>
                     <input type="submit" value="Update Status" class="btn btn-success pull-right"/>
                     </form>

                    <!-- /basic table -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->
@push('footerscript')
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>

<script>

    function all_confirmed()
    {

        $(".notconfirm").removeAttr("checked");
        $(".confirm").prop("checked", true);

    }

    function all_unconfirmed()
    {

   $(".confirm").removeAttr("checked");
    $(".notconfirm").prop("checked", true);

    }

</script>

@endpush
@endsection