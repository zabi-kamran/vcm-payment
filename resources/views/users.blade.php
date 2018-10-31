@extends('layout.app')
@section('title','Home')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{ url('home') }}"><i class="icon-home2 position-left"></i> Add Users</a></li>
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


                    <form>

                    <!-- Basic table -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Add Users and Assign Roles</h5><br>
                            <div class="heading-elements">
                              <br><Br>

                            </div>
							<div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name"/>
                             </div>

                        <div class="form-group">
                        <label for="email">Email</label>
                          <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email"/>
                           </div>

                           <div class="form-group">
                           <label for="password">Password</label>
                          <input type="text" id="password" name="email" class="form-control" placeholder="Enter Password"/>
                          </div>

                           <div class="form-group">

                          <label><input type="radio" name="isadmin" value="1"/> Admin </label>
                           <label><input type="radio" name="isadmin" value="0" onselect="show_data()"/> State User </label>

                          </div>



                    <button type="submit" class="btn btn-primary">Add User</button>

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