@extends('layout.app')
@section('title','Add Ward Master')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add Ward Master</h4>

                        <div class="heading-elements">
                           <a href="{{ route('wardmaster.index') }}" class="btn bg-brown btn-labeled heading-btn"><b><i class="icon-arrow-left15"></i></b> Back</a>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
                    <!-- Basic table -->
                    <div class="panel panel-flat">
                       <form action="{{ route('wardmaster.store') }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}
                                <div class="panel panel-flat">
                                    <div class="panel-body">
                                          <div class="form-group">
                                             <div class="col-lg-6">
                                                <label>LGA Name:</label>
                                              {!! Form::select('lga_id',[''=>'Select LGA Name'] + CommonClass::getLga(), old('lga_id'), ['class'=>'form-control required','required']) !!}
                                            </div>
                                            <div class="col-lg-6">
                                                 <label>Ward Name:</label>
                                                <input type="text" name="ward_name" class="form-control" placeholder="Enter Ward Name" required="">
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