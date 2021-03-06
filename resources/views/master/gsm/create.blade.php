@extends('layout.app')
@section('title','Add GSM Net Master')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add GSM Net Master</h4>

                        <div class="heading-elements">
                           <a href="{{ route('gsmmaster.index') }}" class="btn bg-brown btn-labeled heading-btn"><b><i class="icon-arrow-left15"></i></b> Back</a>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
                    <!-- Basic table -->
                    <div class="panel panel-flat">
                       <form action="{{ route('gsmmaster.store') }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">GSM Net Name:</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="gsm_name" class="form-control" placeholder="Enter GSM Net Name" required="">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
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