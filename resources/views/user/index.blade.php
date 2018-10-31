@extends('layout.app')
@section('title','Users')
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>State</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>

                           @foreach($users as $user)

                            <tr>

                            <td> {{ $user->name }}</td>
                            <td> {{ $user->email }}</td>
                            <td> {{ $user->state_name  }}</td>

                            @if(\Illuminate\Support\Facades\Gate::allows('delete-user', \Illuminate\Support\Facades\Auth::user()))
                            <td> <button type="button" class="btn btn-danger" onclick="delete_user('{{ $user->id }}')"> Delete </button>


                            @else
                            <td><button type="button" class="btn btn-danger" disabled> Delete </button>
                              @endif
                            <a href="users/{{ $user->id }}/edit" class="btn btn-primary"> Edit </a> </td>

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
    $(function() {
    // Setting datatable defaults

    // Basic datatable
    $('.datatable-basic').DataTable();
});


function delete_user(id)
{


var check = confirm('Are you sure , you want to delete user');

    if(check)
    {


        $.ajax(
            {
                url: 'users/'+id+'?_token={{ csrf_token() }}',
                type: "DELETE",
                success:function(data, textStatus, jqXHR)
                {

                   location.reload();

                },
                error: function(jqXHR, textStatus, errorThrown){

                    console.log("Ajax Failed Error In Saving:" + textStatus);


                }
            });

    }


}

</script>

@endpush
@endsection