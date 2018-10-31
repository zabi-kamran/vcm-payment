@extends('layout.app')
@section('title','Add New Record')
@push('headerscript')
@endpush
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add New Record</span></h4>

                        <div class="heading-elements">
                           <a href="{{ route('payment.index') }}" class="btn bg-brown btn-labeled heading-btn"><b><i class="icon-arrow-left15"></i></b> Back</a>
                        </div>
                    </div>
                </div>
            </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
                    <!-- Basic table -->
                  <!-- Wizard with validation -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Fill the Form</h6>
                            <div class="heading-elements">
                              
                            </div>
                        </div>

                        <form action="{{ route('payment.store') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="panel panel-flat">
                                    <div class="panel-body">
                                     <h2>New Record </h2>
                                                            <hr>
                               <div class="row">
                                 <div class="form-group">
                                <div class="col-md-4">
                                            <label>State Name <span class="text-danger">*</span></label>
                                            {!! Form::select('state',[''=>'Select State Name'] + CommonClass::geStates(), old('state'), ['class'=>'form-control required','required','id'=>'state','onchange'=>'stateby()']) !!}
                                           <div class="text-danger">{{ $errors->first('state') }}</div>
                                        </div>
                                    <div class="col-md-4">
                                            <label>LGA<span class="text-danger">*</span></label>
                                             {!! Form::select('lga',[''=>'Select LGA'], old('lga'), ['class'=>'form-control required','required','id'=>'lga','onchange'=>'lgaby()']) !!}
                                             <div class="text-danger">{{ $errors->first('lga') }}</div>
                                        </div>
                                <div class="col-md-4">
                                            <label>Ward <span class="text-danger">*</span></label>
                                            {!! Form::select('ward',[''=>'Select Ward Name'], old('ward'), ['class'=>'form-control required','required','id'=>'ward']) !!}
                                            <div class="text-danger">{{ $errors->first('ward') }}</div>
                                    </div>
                                </div> 
                            </div>
                               <div class="row">
                                 <div class="form-group">
                                        <div class="col-md-4">
                                            <label>First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="fname" placeholder="First name" class="form-control" required value="{{ old('fname') }}">
                                            <div class="text-danger">{{ $errors->first('fname') }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="lname" placeholder="Last name" class="form-control" value="{{ old('lname') }}" required="">
                                            <div class="text-danger">{{ $errors->first('lname') }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mother Name <span class="text-danger">*</span></label>
                                            <input type="text" name="mother_name" placeholder="Mother name" class="form-control" value="{{ old('mother_name') }}" required="">
                                            <div class="text-danger">{{ $errors->first('mother_name') }}</div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                     <div class="form-group">
                                    <div class="col-md-3">
                                           <div class="form-group">
                                        <label class="display-block text-semibold">Gender <span class="text-danger">*</span></label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" class="styled" checked="checked" value="0">
                                            Male
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="gender" class="styled" value="1">
                                            Female
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                         <label>DOB  <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control required" name="dob" placeholder="Enter Birth Date date"  value="{{ old('dob') }}" required="">
                                        <span class="help-block">dd/mm/yyyy</span>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                    <label> Status </label>
                                    <select class="form-control" name="status">
                                    <option value="1"> Active </option>
                                    <option value="0"> Inactive </option>
                                     <option value="-1"> Delisted </option>

                                    </select>
                                     <div class="text-danger">{{ $errors->first('status') }}</div>
                                    </div>
                                     <div class="col-md-3">
                                  <label>Settlement <span class="text-danger">*</span></label>
                                  <input type="text" name="setellment" id="pay_amt" value="{{ old('setellment') }}" class="form-control required">
                                  <div class="text-danger">{{ $errors->first('setellment') }}</div>
                              </div>





                            </div>
                        </div>
                        <h2> Payment </h2>
                        <hr>

                             <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label>GSM Net <span class="text-danger">*</span></label>
                                            {!! Form::select('gsm_net',[''=>'Select GSM Net'] + CommonClass::getGsmNet(), old('gsm_net'), ['class'=>'form-control required','required']) !!}
                                            <div class="text-danger">{{ $errors->first('gsm_net') }}</div>
                                        </div>
                                     <div class="col-md-4">
                                            <label>GSM No <span class="text-danger">*</span></label>
                                            <input type="text" name="gsm_no" class="form-control required" placeholder="GSM No" value="{{ old('gsm_no') }}" required="">
                                            <div class="text-danger">{{ $errors->first('gsm_no') }}</div>
                                        </div>
                                    <div class="col-md-4">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select name="category" class="form-control">
                                            <?php  $cat=CommonClass::getCategory(); ?>

                                            @foreach( $cat as $c)
                                            <option value="{{ $c->id }}"> {{ $c->category_name }}</option>

                                            @endforeach

                                            </select>

                                            <div class="text-danger">{{ $errors->first('category') }}</div>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="form-group">
                                    <div class="col-md-4">
                                            <label>Monthly payment amount <span class="text-danger">*</span></label>
                                            <input type="text" name="pay_amt" onkeyup="PayAmt()" id="pay_amt" value="{{ old('pay_amt') }}" class="form-control required">
                                            <div class="text-danger">{{ $errors->first('pay_amt') }}</div>
                                        </div>




                                </div>



                                <h2> Next of kin </h2>
                                <hr>
                                <div class="row">
                                <div class="col-md-4">
                                   <label> Next of kin - Name  </label>
                                   <input tyle="text" class="form-control"  value="{{ old('name') }}" name="name" placeholder="Enter Name">
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="col-md-4">
                                <label>  Next of kin - Relation </label>
                                <select class="form-control" name="relation">

                                 <option value="Parent"> Parent (Father, Mother) </option>
                                 <option value="Child"> Child (Son, Sister) </option>
                                  <option value="Sibling">Sibling (Brother, Sister)</option>
                                  <option value="Spouse"> Spouse (Husband, Wife) </option>
                                  <option value="Other"> Other</option>

                                </select>


                                </div>
                                <div class="col-md-4">
                                <label> Next of kin- Phone </label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"/>
                                 <div class="text-danger">{{ $errors->first('phone') }}</div>

                                </div>

                                </div>
                                <h1>Comments</h1>
                                <hr>
                                <div class="row">
                                <div class="col-md-12">
                                <label> Comments </label>
                                <textarea class="form-control" name="comments" value="{{ old('comments') }}"></textarea>
                                 <div class="text-danger">{{ $errors->first('comments') }}</div>

                                </div>

                                </div>


                            </div>
                            <br>
                           <div class="row">
                               <div class="form-group">
                                    <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                               </div>
                           </div>
                        </form>
                    </div>

                </div>
                <!-- /content area -->

            </div>
            
            <!-- /main content -->
@push('footerscript')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    function PayAmt(){
        calculate();
    }
    function Others(){
        calculate();
    }
    function calculate(){
        var pay_amt=$("#pay_amt").val();
        var others=$("#others").val();
        var total=+pay_amt + +others;
        $("#total").val(total);
    }
    function stateby(){
        var state_id=$("#state").val();
        $.ajax({
            url: '{{ url('Helpers/CommonClass/lgsist') }}/'+state_id,
            type: 'get',
            dataType: "json",
            success:function(data){
                $('select[name="lga"]').empty();
                $('select[name="lga"]').append('<option value="" >Select LGA</option>');
                $.each(data, function(key, value) {
                    $('select[name="lga"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    } 
    function lgaby(){
        var lga_id=$("#lga").val();
        $.ajax({
            url: '{{ url('Helpers/CommonClass/wardlist') }}/'+lga_id,
            type: 'get',
            dataType: "json",
            success:function(data){
                $('select[name="ward"]').empty();
                $('select[name="ward"]').append('<option value="" >Select Ward</option>');
                $.each(data, function(key, value) {
                    $('select[name="ward"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });
    }

     $(document).ready(function(){


        $("#dob").datepicker({
                               dateFormat: "dd/mm/yy"
                             });

        });
</script>

@endpush
@endsection