@extends('layout.app')
@section('title','Edit Report')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">

                <!-- /page header -->

                <form method="POST" action="{{ route('reports.weekly.update',$report->id) }}">
                {{ csrf_field()  }}


                <!-- Content area -->
                <div class="content">
                    <!-- Basic table -->
                    <div class="panel panel-flat">

                          <div class="table-responsive">
                        <table class="table datatable-basic" id="datatable">

                        <tr>

                        <th> Category </th>
                        <th> Indicator </th>
                        <th> Value </th>
                        <th> method of verification </th>

                        </tr>
                            <?php  $data=json_decode($report->data);  ?>
                        <!---- First --->
                        <tr>
                        <td><input type="hidden" name="category1" value="AFP surveillance & reporting by VCM network"/><b>AFP surveillance & reporting by VCM network</b></td>
                        <td><input type="hidden" name="indicator1[]" value="Number of AFP cases detected by members of VCM network"/>Number of AFP cases detected by members of VCM network</td>
                        <td><input type="number" name="indicator_value1[]" value="{{ $data[0]->indicator[0]->value  }}" class="form-control"/></td>


                        <td>

                        <select class="form-control" name="method_ver1">


                        <option value="VCM Register (backside)" @if($data[0]->method=="VCM Register (backside)") selected @endif>VCM Register (backside)  </option>


                        <option value="VCM AFP Tracker" @if($data[0]->method=="VCM AFP Tracker") selected @endif>VCM AFP Tracker </option>

                        </select>

                        </td>

                        </tr>



                         <tr>
                        <td> </td>
                        <td><input type="hidden" name="indicator1[]" value="Number of AFP cases reported to DSNO and has EPID number"/>
                        Number of AFP cases reported to DSNO and has EPID number</td>
                        <td><input value="{{ $data[0]->indicator[0]->value  }}" type="number" name="indicator_value1[]"  class="form-control"/></td>
                        <td></td>
                        </tr>

                        <!--- First Ends ---->



                        <!---- Second ------>

                    <tr>
                <td><input type="hidden" name="category2" value="House to house mobilization activities"/><b>House to house mobilization activities</b></td>
                <td><input type="hidden" name="indicator2[]" value="Number of households mobilized to increase vaccination coverage, RI and ANC during the week"/>
                Number of households mobilized to increase vaccination coverage, RI and ANC during the week.</td>
                <td><input name="indicator_value2[]" type="number" value="{{ $data[1]->indicator[0]->value  }}" class="form-control"/></td>

                <td><select class="form-control"  name="method_ver2">
                <option value="VCM Register" @if($data[1]->method=="VCM Register") selected @endif> VCM Register </option>

                </select></td>

                </tr>


                 <tr>
                <td> </td>
                <td><input type="hidden" name="indicator2[]" value="No caregivers sensitized on RI, Sanitation, Hygiene and Exclusive bread feeding" />
                No caregivers sensitized on RI, Sanitation, Hygiene and Exclusive bread feeding.</td>
                <td><input value="{{ $data[1]->indicator[1]->value  }}"  name="indicator_value2[]" type="number" class="form-control"/></td>
                <td></td>
                </tr>


                <tr>
                <td> </td>
                <td><input type="hidden" name="indicator2[]" value="Number of polio survivors engaged in IPDs/IBR to raise awareness"/>
                Number of polio survivors engaged in IPDs/IBR to raise awareness</td>
                <td><input value="{{ $data[1]->indicator[2]->value  }}" name="indicator_value2[]" type="number" class="form-control"/></td>
                <td></td>
                </tr>


                 <tr>
                <td> </td>
                <td><input type="hidden" name="indicator2[]" value="Number supportive supervisions conducted"/>Number supportive supervisions conducted.</td>
                <td><input value="{{ $data[1]->indicator[3]->value  }}" name="indicator_value2[]" type="number" class="form-control"/></td>
                <td></td>
                </tr>



                        <!---- Second Ends -->



                        <!----- Third ------>


                         <tr>
                        <td><input type="hidden" name="category3" value="IDPs"/><b>IDPs</b></td>
                        <td>
                        <input type="hidden" name="indicator3[]" value="Number of newly arrived under 5 children registered in VCM registers"/>
                        Number of newly arrived under 5 children registered in VCM registers</td>
                        <td><input value="{{ $data[2]->indicator[0]->value  }}" name="indicator_value3[]" type="number" class="form-control"/></td>

                        <td><select class="form-control" name="method_ver3">
                        <option value="Dedicated VCM Register at camp entrance" @if($data[2]->method=="Dedicated VCM Register at camp entrance") selected @endif> Dedicated VCM Register at camp entrance  </option>
                        <option value="Activity Reports" @if($data[2]->method=="Activity Reports") selected @endif>Activity Reports</option>
                        <option value="VCM Registers" @if($data[2]->method=="VCM Registers") selected @endif>VCM Registers</option>

                        </select></td>

                        </tr>



                      <tr>
                    <td> </td>
                    <td> <input type="hidden" name="indicator3[]" value="Number of VCM registered under 5 children moved-out of the IDP camp"/>
                    Number of VCM registered under 5 children moved-out of the IDP camp</td>
                    <td><input  value="{{ $data[2]->indicator[1]->value  }}" name="indicator_value3[]" type="number" class="form-control"/></td>
                    <td></td>
                    </tr>


                     <tr>
                    <td> </td>
                    <td>
                    <input type="hidden" name="indicator3[]" value="Any social mobilization activities conducted in the IDP camp"/>
                    Any social mobilization activities conducted in the IDP camp</td>
                    <td><input  value="{{ $data[2]->indicator[2]->value  }}" type="number"  name="indicator_value3[]"  class="form-control"/></td>
                    <td></td>
                    </tr>



                    <tr>
                    <td> </td>
                    <td>
                    <input type="hidden" name="indicator3[]" value="Total no of VCM registered U5 children in the IDPs camps"/>
                    Total no of VCM registered U5 children in the IDPs camps</td>
                    <td><input  value="{{ $data[2]->indicator[3]->value  }}" type="number"  name="indicator_value3[]"  class="form-control"/></td>
                    <td></td>
                    </tr>



                        <!---- Third Ends --->




                        <!------- Forth ------->




                    <tr>
                    <td><input type="hidden" name="category4" value="Compound meetings and community dialogue"/><b>Compound meetings and community dialogue</b></td>
                    <td>
                    <input type="hidden" name="indicator4[]" value="Number of compound meetings conducted"/>
                    Number of compound meetings conducted</td>
                    <td><input  value="{{ $data[3]->indicator[0]->value  }}"  type="number" name="indicator_value4[]" class="form-control"/></td>

                    <td>
                    <select class="form-control" name="method_ver4">
                    <option value="VCM Register" @if($data[3]->method=="VCM Register") selected @endif >VCM Register</option>
                    <option value="Activity Reports" @if($data[3]->method=="Activity Reports") selected @endif> Activity Reports </option>
                    </select>
                    </td>


                    </tr>



                     <tr>
                    <td> </td>
                    <td><input type="hidden" name="indicator4[]" value="Total number of participants in the compound meetings"/>
                    Total number of participants in the compound meetings</td>
                    <td><input value="{{ $data[3]->indicator[1]->value  }}"  name="indicator_value4[]"  type="number" class="form-control"/></td>
                    <td></td>
                    </tr>


                    <tr>
                    <td> </td>
                    <td><input type="hidden" name="indicator4[]" value="Number of community dialogues conducted"/>Number of community dialogues conducted</td>
                    <td><input value="{{ $data[3]->indicator[2]->value  }}"  type="number" name="indicator_value4[]"  class="form-control"/></td>
                    <td></td>
                    </tr>


                     <tr>
                    <td> </td>
                    <td><input type="hidden" name="indicator4[]" value="Total Number of participants in the community dialogs"/>
                    Total Number of participants in the community dialogs</td>
                    <td><input value="{{ $data[3]->indicator[3]->value  }}"  type="number" name="indicator_value4[]"  class="form-control"/></td>
                    <td></td>
                    </tr>

                        <!------- Forth Ends here -->




                <!--------- Fifth ----------->


            <tr>
            <td><input type="hidden" name="category5"  value="RFP meetings / mosque announcements"/>
            <b>RFP meetings / mosque announcements</b> </td>
            <td><input type="hidden" name="indicator5[]" value="Number of RFPs who intervened with NC families"/>Number of RFPs who intervened with NC families</td>
            <td><input value="{{ $data[4]->indicator[0]->value  }}" type="number" name="indicator_value5[]" class="form-control"/></td>

            <td><select class="form-control" name="method_ver5">
            <option value="LGF report" @if($data[4]->method=="LGF report") selected @endif>LGF report</option>
            <option value="RFP plans" @if($data[4]->method=="RFP plans") selected @endif>RFP plans</option>

            </select></td>

            </tr>



        <tr>
        <td> </td>
        <td>
        <input type="hidden" name="indicator5[]" value="Number of NC children resolved as a result of RFP intervention"/>
        Number of NC children resolved as a result of RFP intervention</td>
        <td><input  value="{{ $data[4]->indicator[1]->value  }}" type="number" name="indicator_value5[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td>
         <input type="hidden" name="indicator5[]" value="Number of Jumma’t mosques announcing pro-vaccination messages"/>
        Number of Jumma’t mosques announcing pro-vaccination messages</td>
        <td><input  value="{{ $data[4]->indicator[2]->value  }}" type="number"  name="indicator_value5[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td> <input type="hidden" name="indicator5[]" value="Number of Jumma’t mosques monitored"/>Number of Jumma’t mosques monitored</td>
        <td><input  value="{{ $data[4]->indicator[3]->value  }}" type="number" name="indicator_value5[]"  class="form-control"/></td>
        <td></td>
        </tr>




        <tr>
        <td> </td>
        <td> <input type="hidden" name="indicator5[]" value="Number of pro-vaccination church sermons"/>
        Number of pro-vaccination church sermons</td>
        <td><input  value="{{ $data[4]->indicator[4]->value  }}" name="indicator_value5[]" type="number" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator5[]" value="Number of churches monitored"/>Number of churches monitored</td>
        <td><input  value="{{ $data[4]->indicator[5]->value  }}" type="number" name="indicator_value5[]" class="form-control"/></td>
        <td></td>
        </tr>


                <!-------- Fifth Ends here --->




            <!------- Sixth ------------>

            <tr>
            <td><input type="hidden" name="category6" value="Media engagement"/><b>Media engagement </b></td>
            <td><input type="hidden" name="indicator6[]" value="Number of advocacy/sensitization meetings conducted with media organizations/groups"/>
            Number of advocacy/sensitization meetings conducted with media organizations/groups</td>
            <td><input  value="{{ $data[5]->indicator[0]->value  }}" type="number"  name="indicator_value6[]"  class="form-control"/></td>

            <td><select class="form-control" name="method_ver6">
            <option value="Media Focal Points" @if($data[5]->method=="Media Focal Points") selected @endif>Media Focal Points</option>
            <option value="Slots Schedules, Media Outlets, Listeners etc" @if($data[5]->method=="Slots Schedules, Media Outlets, Listeners etc") selected @endif>Slots Schedules, Media Outlets, Listeners etc</option>
            <option value="Records of Discussion & CD Plates" @if($data[5]->method=="Records of Discussion & CD Plates") selected @endif>Records of Discussion & CD Plates</option>
            <option value="Weekly Tracking Tool" @if($data[5]->method=="Weekly Tracking Tool") selected @endif>Weekly Tracking Tool</option>

            </select></td>

            </tr>


            <tr>
            <td> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of pro-vaccination Radio jingles / radio discussion aired (Polio, Measles )"/>
            Number of pro-vaccination Radio jingles / radio discussion aired (Polio, Measles )</td>
            <td><input value="{{ $data[5]->indicator[1]->value  }}" type="number" name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>


            <tr>
            <td> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of print media articles published"/>
            Number of print media articles published</td>
            <td><input value="{{ $data[5]->indicator[2]->value  }}" type="number"  name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>


            <tr>
            <td> </td>
            <td> <input type="hidden" name="indicator6[]" value="Number of TV/radio talk shows/round table discussions aired"/>
            Number of TV/radio talk shows/round table discussions aired</td>
            <td><input value="{{ $data[5]->indicator[3]->value  }}" type="number"  name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>


             <tr>
            <td> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of radio stations airing edutainment-based radio drama by BBC Media Action"/>
            Number of radio stations airing edutainment-based radio drama by BBC Media Action</td>
            <td><input value="{{ $data[5]->indicator[4]->value  }}" type="number" name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>



            <!------ Sixth Ends here ----->





            <!---- Sevent --------------->

        <tr>
        <td><input type="hidden" name="category7" value="IBR Activities"/><b>IBR Activities</b></td>
        <td><input type="hidden" name="indicator7[]" value=""/>Number of naming ceremonies attended by members of VCM-Net during the week</td>
        <td><input value="{{ $data[6]->indicator[0]->value  }}" type="number" name="indicator_value7[]"  class="form-control"/></td>

        <td><select class="form-control" name="method_ver7">
        <option value="VCM Register"> VCM Register </option>
        <option value="Ona" @if($data[6]->method=="Ona") selected @endif>Ona</option>
        <option value="VWS Register" @if($data[6]->method=="VWS Register") selected @endif>VWS Register</option>

        </select></td>

        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of U5 children seen in naming ceremonies"/>
        Number of U5 children seen in naming ceremonies</td>
        <td><input value="{{ $data[6]->indicator[1]->value  }}" type="number" name="indicator_value7[]"  class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of U5 children immunized with OPV"/>
        Number of U5 children immunized with OPV</td>
        <td><input value="{{ $data[6]->indicator[2]->value  }}" type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>




          <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="during naming ceremonies"/> during naming ceremonies</td>
        <td><input value="{{ $data[6]->indicator[3]->value  }}" type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of vails received"/>Number of vails received</td>
        <td><input  value="{{ $data[6]->indicator[4]->value  }}" type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


         <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of vails returned"/>Number of vails returned/td>
        <td><input  value="{{ $data[6]->indicator[5]->value  }}" type="number"  name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Total number of Doses"/>Total number of Doses</td>
        <td><input value="{{ $data[6]->indicator[6]->value  }}" type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>



         <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value=" Number of NC households revisited"/> Number of NC households revisited</td>
        <td><input value="{{ $data[6]->indicator[7]->value  }}" type="number"  name="indicator_value7[]"  class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of NC children resolved<"/>Number of NC children resolved</td>
        <td><input value="{{ $data[6]->indicator[8]->value  }}" type="number" name="indicator_value7[]"  class="form-control"/></td>
        <td></td>
        </tr>


         <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of children outstanding"/>Number of children outstanding</td>
        <td><input value="{{ $data[6]->indicator[9]->value  }}" type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of pregnant women tracked and referred to health facilities for ANC services"/>
        Number of pregnant women tracked and referred to health facilities for ANC services</td>
        <td><input value="{{ $data[6]->indicator[10]->value  }}" type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>




            <!---- Sevent Ends here ----->






            <!---- Eight ---------->


               <tr>
                <td><input type="hidden" name="category8" value="New-born and Defaulter tracking"/>
                <b>New-born and Defaulter tracking </b></td>
                <td><input type="hidden" name="indicator8[]" value="Number of new born tracked during the week"/>
                Number of new born tracked during the week</td>
                <td><input value="{{ $data[7]->indicator[0]->value  }}" type="number"  name="indicator_value8[]" class="form-control"/></td>

                <td><select class="form-control" name="method_ver8">
                <option value="Ona" @if($data[7]->method=="Ona") selected @endif>Ona</option>
                <option value="VCM Register" @if($data[7]->method=="VCM Register") selected @endif>VCM Register</option>

                </select></td>

                </tr>



                <tr>
                <td> </td>
                <td><input type="hidden" name="indicator8[]" value="Number of new borns given zero doze by or with support of VCM network"/>
                Number of new borns given zero doze by or with support of VCM network</td>
                <td><input value="{{ $data[7]->indicator[1]->value  }}" type="number"  name="indicator_value8[]" class="form-control"/></td>
                <td></td>
                </tr>



                <tr>
                <td> </td>
                <td><input type="hidden" name="indicator8[]"  value="Number of defaulters tracked and reconnected with health facilities"/>
                Number of defaulters tracked and reconnected with health facilities</td>
                <td><input value="{{ $data[7]->indicator[2]->value  }}" type="number" name="indicator_value8[]" class="form-control"/></td>
                <td></td>
                </tr>



            <!---- Eight Ends here -->



            <!-------- Ninth ----------->


            <tr>
            <td><input type="hidden" name="category9" value="Capacity development"/><b>Capacity development</b></td>
            <td><input type="hidden" name="indicator9[]" value="Number of VCMs who received refresher training"/>
            Number of VCMs who received refresher training</td>
            <td><input value="{{ $data[8]->indicator[0]->value  }}" type="number" name="indicator_value9[]" class="form-control"/></td>

            <td><select class="form-control" name="method_ver9">
            <option value="Training attendance sheet" @if($data[8]->method=="Training attendance sheet") selected @endif>Training attendance sheet</option>
            <option value="On the job sensitization " @if($data[8]->method=="On the job sensitization ") selected @endif>On the job sensitization </option>

            </select></td>

            </tr>


             <tr>
            <td> </td>
            <td><input type="hidden" name="indicator9[]" value="Number of RFPs oriented/trained, refresher training"/>
            Number of RFPs oriented/trained, refresher training</td>
            <td><input value="{{ $data[8]->indicator[1]->value  }}" type="number"  name="indicator_value9[]" class="form-control"/></td>
            <td></td>
            </tr>


            <!-------- Ninth Ends here --->


                        </table>
                    </div>



                    </div>
                    <!-- /basic table -->

                    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)

                    <input type="text" readonly value="{{ $report->name  }}" name="report_name" placeholder="Enter Report name"/>
                    <br>
                    <br>
                    <input type="submit" value="Save" class="btn btn-success"/>
                   <a href="{{ route('reports.weekly.send',$report->id)  }}" class="btn btn-primary"> Send final report</a>

                    @endif
                </div>
                </form>
                <!-- /content area -->

            </div>
            <!-- /main content -->



@push('footerscript')


@endpush
@endsection