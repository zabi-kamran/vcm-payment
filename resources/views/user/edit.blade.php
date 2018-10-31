@extends('layout.app')
@section('title','Home')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{ url('home') }}"><i class="icon-home2 position-left"></i> Edit State Users</a></li>
                        </ul>

                        <ul class="breadcrumb-elements">
                        </ul>
                    </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <!-- Basic tables title -->
                    <h6 class="content-group text-semibold">


                    </h6>
                    <!-- /basic tables title -->


                    <form method="POST" action="{{ route('users.update',$user->user_id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT"/>
                    <!-- Basic table -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title"><i class="icon-user"> </i> &nbsp Add State Users</h5><br>
                            <div class="heading-elements">
                              <br><Br>

                            </div>
							<div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name  }}" placeholder="Enter Name"/>
                             </div>

                        <div class="form-group">
                        <label for="email">Email</label>
                          <input type="text" id="email" name="email" class="form-control" value="{{ $user->email  }}" placeholder="Enter Email"/>
                           </div>

                           <div class="form-group">
                           <label for="password">Password</label>
                          <input type="text" id="password" name="password"  class="form-control" placeholder="Enter Password"/>
                          </div>

                           <div class="form-group">

                           <label> Select State </label>
                            <select class="form-control" name="state_id">

                             @foreach($states as $state)

                            <option value="{{ $state->id }}" @if($user->state_id==$state->id) selected  @endif> {{ $state->state_name }} </option>

                             @endforeach
                            </select>



                          </div>




                    <button type="submit" class="btn btn-primary">Update User</button>

                        </div>
                        </div>

                        </form>

                    </div>
                    <!-- /basic table -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->
@endsection