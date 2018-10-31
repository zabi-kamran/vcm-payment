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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Record</span></h4>

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

                        {!! Form::model($row, ['method' => 'PATCH','class'=>'steps-validation','role'=>'form','route' => ['payment.update',$row->id]]) !!}
                            <div class="panel panel-flat">
                                    <div class="panel-body">
                                    <h2> Edit Record </h2>
                                    <hr>
                               <div class="row">
                                 <div class="form-group">
                                <div class="col-md-4">
                                            <label>State Name <span class="text-danger">*</span></label>
                                            {!! Form::select('state',[''=>'Select State Name'] + CommonClass::geStates(), old('state',$row->state), ['class'=>'form-control required','required','id'=>'state','onchange'=>'stateby()']) !!}
                                           <div class="text-danger">{{ $errors->first('state') }}</div>
                                        </div>
                                    <div class="col-md-4">
                                            <label>LGA<span class="text-danger">*</span></label>
                                             {!! Form::select('lga',[''=>'Select LGA'], old('lga',$row->lga), ['class'=>'form-control required','required','id'=>'lga','onchange'=>'lgaby()']) !!}
                                             <div class="text-danger">{{ $errors->first('lga') }}</div>
                                        </div>
                                <div class="col-md-4">
                                            <label>Ward <span class="text-danger">*</span></label>
                                            {!! Form::select('ward',[''=>'Select Ward Name'], old('ward',$row->ward), ['class'=>'form-control required','required','id'=>'ward']) !!}
                                            <div class="text-danger">{{ $errors->first('ward') }}</div>
                                    </div>
                                </div>
                            </div>
                               <div class="row">
                                 <div class="form-group">
                                        <div class="col-md-4">
                                            <label>First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="fname" placeholder="First name" class="form-control" required value="{{ old('fname',$row->fname) }}">
                                            <div class="text-danger">{{ $errors->first('fname') }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="lname" placeholder="Last name" class="form-control" value="{{ old('lname',$row->lname) }}" required="">
                                            <div class="text-danger">{{ $errors->first('lname') }}</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mother Name <span class="text-danger">*</span></label>
                                            <input type="text" name="mother_name" placeholder="Mother name" class="form-control" value="{{ old('mother_name',$row->mother_name) }}" required="">
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
                                            <input type="radio" name="gender" class="styled" checked="checked" value="0" {{ (old('gender',$row->gender) == 0) ? 'checked' : '' }}>
                                            Male
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="gender" class="styled" value="1" {{ (old('gender',$row->gender) == 1) ? 'checked' : '' }}>
                                            Female
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                         <label>DOB  <span class="text-danger">*</span></label>
                                        <input id="dob" class="form-control" name="dob" placeholder="Enter Birth Date date"  value="{{ $row->dob }}" required="">
                                        <span class="help-block">dd/mm/yyyy</span>
                                        </div>
                                </div>

                                <div class="col-md-3">
                            <label> Status </label>
                            <select class="form-control" name="status">
                            <option value="1" @if($row->status=='1') selected @endif> Active </option>
                            <option value="0" @if($row->status=='0') selected @endif> Inactive </option>
                             <option value="-1" @if($row->status=='-1') selected @endif> Delisted </option>

                            </select>
                             <div class="text-danger">{{ $errors->first('status') }}</div>
                            </div>

                             <div class="col-md-3">
                              <label>Settlement <span class="text-danger">*</span></label>
                              <input type="text" name="setellment" id="pay_amt" value="{{ $row->setellment }}" class="form-control required">
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
                                            {!! Form::select('gsm_net',[''=>'Select GSM Net'] + CommonClass::getGsmNet(), old('gsm_net',$row->gsm_net), ['class'=>'form-control required','required']) !!}



                                            <div class="text-danger">{{ $errors->first('gsm_net') }}</div>

                                        </div>
                                     <div class="col-md-4">
                                            <label>GSM No <span class="text-danger">*</span></label>
                                            <input type="text" name="gsm_no" class="form-control required" placeholder="GSM No" value="{{ old('gsm_no',$row->gsm_no) }}" required="">
                                            <div class="text-danger">{{ $errors->first('gsm_no') }}</div>

                                        </div>
                                    <div class="col-md-4">

                                    <?php  $categories = \App\Helpers\CommonClass::getCategory();  ?>
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select class="form-control" name="category">

                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($row->category==$category->id)  selected @endif> {{ $category->category_name }} </option>


                                               @endforeach
                                            </select>

                                            <div class="text-danger">{{ $errors->first('category') }}</div>

                                    </div>
                                </div>

                            </div>
                                <div class="row">
                                    <div class="form-group">
                                    <div class="col-md-4">
                                            <label>Pay Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="pay_amt" onkeyup="PayAmt()" id="pay_amt" value="{{ old('pay_amt',$row->pay_amt) }}" class="form-control required">
                                            <div class="text-danger">{{ $errors->first('pay_amt') }}</div>
                                        </div>


                                </div>
                            </div>

                                <h2> Next of kin </h2>
                                <hr>
                              <div class="row" style="padding-top:10px;">
                                                            <div class="col-md-4">
                                                               <label> Next of kin - Name  </label>
                                                               <input tyle="text" class="form-control"  value="{{ $row->name }}" name="name" placeholder="Enter Name">

                                                            </div>
                                                            <div class="col-md-4">
                                                            <label>  Next of kin - Relation </label>
                                                            <select class="form-control" name="relation">

                                                             <option value="Parent" @if($row->relation=='Parent') selected  @endif> Parent (Father, Mother) </option>
                                                             <option value="Child" @if($row->relation=='Child') selected  @endif> Child (Son, Sister) </option>
                                                              <option value="Sibling" @if($row->relation=='Sibling') selected  @endif>Sibling (Brother, Sister)</option>
                                                              <option value="Spouse" @if($row->relation=='Spouse') selected  @endif> Spouse (Husband, Wife) </option>
                                                              <option value="Other"  @if($row->relation=='Other') selected  @endif> Other</option>

                                                            </select>


                                                            </div>
                                                            <div class="col-md-4">
                                                            <label> Next of kin- Phone </label>
                                                            <input type="text" name="phone" class="form-control" value="{{ $row->phone }}"/>
                                                             <div class="text-danger">{{ $errors->first('phone') }}</div>

                                                            </div>

                                                            </div>

                                                            <div class="row">
                                                            <div class="col-md-12">
                                                            <label> Comments </label>
                                                            <textarea class="form-control" name="comments" >{{ $row->comments  }}</textarea>
                                                             <div class="text-danger">{{ $errors->first('comments') }}</div>

                                                            </div>

                                                            </div>
                                                    <input type="hidden" id="ward_id" value="{{ $row->ward  }}"/>

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
        $(document).ready(function(){
            stateby({{ $row->lga }});
        });
    function stateby(selectvalues){
        var state_id=$("#state").val();
        $.ajax({
            url: '{{ url('Helpers/CommonClass/lgsist') }}/'+state_id,
            type: 'get',
            dataType: "json",
            success:function(data){
                $('select[name="lga"]').empty();
                $('select[name="lga"]').append('<option value="" >Select LGA</option>');
                $.each(data, function(key, value) {
                if (selectvalues == key){
                        $('select[name="lga"]').append('<option value="'+ key +'" selected>'+ value +'</option>');
                        lgaby(key);
                    }else{
                    $('select[name="lga"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    });

            }
        });
    }
    function lgaby(selectvalues){
        var lga_id=$("#lga").val();

        //alert(lga_id);
        $.ajax({
            url: '{{ url('Helpers/CommonClass/wardlist') }}/'+lga_id,
            type: 'get',
            dataType: "json",
            success:function(data){
                $('select[name="ward"]').empty();
                $('select[name="ward"]').append('<option value="" >Select Ward</option>');
                $.each(data, function(key, value) {

                    var ward = $("#ward_id").val();

                    if (ward == key){
                        $('select[name="ward"]').append('<option value="'+ key +'" selected>'+ value +'</option>');
                    }else{
                    $('select[name="ward"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
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