@extends('layout.app')
@section('title','Make Payment')
@push('headerscript')
<style>
fieldset{
        width: 75%;
    margin: 0 auto;
}
</style>
@endpush
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Make Payment</span></h4>

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

                        <form class="steps-validation" id="form" action="{{ url('payment/payrecordsave') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h6>LGA</h6>
                            <fieldset>
                               <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State Name <span class="text-danger">*</span></label>
                                            {!! Form::select('state',[''=>'Select State Name'] + CommonClass::geStates(), old('state'), ['class'=>'form-control required','required','id'=>'state','onchange'=>'stateby()']) !!}
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>LGA<span class="text-danger">*</span></label>
                                             {!! Form::select('lga',[''=>'Select LGA'], old('lga'), ['class'=>'form-control required','required','id'=>'lga','onchange'=>'lgaby()']) !!}
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">
                                {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Ward <span class="text-danger">*</span></label>--}}
                                            {{--{!! Form::select('ward',[''=>'Select Ward Name'], old('ward'), ['class'=>'form-control required','required','id'=>'ward','onchange'=>'byward()']) !!}--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div> --}}
                               
                               
                            </fieldset>

                            <h6>Payment</h6>
                            <fieldset>
                                
                               <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div id="result"></div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                     <div class="col-sm-6">
                                        <label>Your Name</label>
                                        <select class="form-control"  name="create_name" required>
                                        <option value="January"> January </option>
                                        <option value="February"> February  </option>
                                        <option value="March"> March  </option>
                                        <option value="April"> April  </option>
                                        <option value="May"> May  </option>
                                        <option value="June"> June  </option>
                                        <option value="July"> July  </option>
                                        <option value="August"> August  </option>
                                        <option value="September"> September  </option>
                                        <option value="October"> October  </option>
                                        <option value="November"> November  </option>
                                        <option value="December"> December  </option>

                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Upload Certification</label>
                                        <input type="file" name="certificate" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                                <br>
                                <div class="row">
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea  name="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                 </div>
                            <br>
                            </fieldset>
                            <h6>Confirmation</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <p class="text-center">All inforamtion will be save in database, please review all the things and submit.</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- /wizard with validation -->
                    
                </div>
                <!-- /content area -->

            </div>
            
            <!-- /main content -->
@push('footerscript')
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
            url: '{{ url('Helpers/CommonClass/lgsist') }}/'+state_id+"?makepayment=1",
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
        {{--var lga_id=$("#lga").val();--}}
        {{--$.ajax({--}}
            {{--url: '{{ url('Helpers/CommonClass/wardlist') }}/'+lga_id,--}}
            {{--type: 'get',--}}
            {{--dataType: "json",--}}
            {{--success:function(data){--}}
                {{--$('select[name="ward"]').empty();--}}
                {{--$('select[name="ward"]').append('<option value="" >Select Ward</option>');--}}
                {{--$.each(data, function(key, value) {--}}
                    {{--$('select[name="ward"]').append('<option value="'+ key +'">'+ value +'</option>');--}}
                {{--});--}}
            {{--}--}}
        {{--});--}}

        byward();

    }
    function byward(){
        var lga_id=$("#lga").val();

        $.ajax({
            url: '{{ url('payment/GetPayList') }}',
            type: 'get',
            data:{'lga_id':lga_id},
            success:function(data){
		

               $("#result").html(data);

		  $("#total_vcm").empty();
                

               $("#total_vcm").html("Total Active VCM ="+($("#get_total").html()));


            }
        });
   }
</script>
<!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/wizards/steps.min.js') }}"></script>
   {{--  <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/selects/select2.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/extensions/cookie.js') }}"></script>

    <script type="text/javascript" src="{{ asset('theme/assets/js/pages/wizard_steps.js') }}"></script>

    <script type="text/javascript">
        $(document).on('click','#submit',function() {
            confirm("Are you sure you want to proceed?");
        });
    </script>

@endpush
@endsection