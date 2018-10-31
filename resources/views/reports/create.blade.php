@extends('layout.app')
@section('title','Reports')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">

                <!-- /page header -->

                <form method="POST" action="{{ route('reports.weekly.save') }}">
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

                        <!---- First --->
                        <tr>
                        <td><input type="hidden" name="category1" value="AFP surveillance & reporting by VCM network"/><b>AFP surveillance & reporting by VCM network</b></td>
                        <td><input type="hidden" name="indicator1[]" value="Number of AFP cases detected by members of VCM network"/>Number of AFP cases detected by members of VCM network</td>
                        <td><input type="number" name="indicator_value1[]" class="form-control"/></td>

                        <td>

                        <select class="form-control" name="method_ver1">
                        <option value="VCM Register (backside)">VCM Register (backside)  </option>
                        <option value="VCM AFP Tracker">VCM AFP Tracker </option>

                        </select>

                        </td>

                        </tr>



                         <tr>
                        <td> </td>
                        <td><input type="hidden" name="indicator1[]" value="Number of AFP cases reported to DSNO and has EPID number"/>
                        Number of AFP cases reported to DSNO and has EPID number</td>
                        <td><input type="number" name="indicator_value1[]" class="form-control"/></td>
                        <td></td>
                        </tr>

                        <!--- First Ends ---->



                        <!---- Second ------>

                    <tr>
                <td><input type="hidden" name="category2" value="House to house mobilization activities"/><b>House to house mobilization activities</b></td>
                <td><input type="hidden" name="indicator2[]" value="Number of households mobilized to increase vaccination coverage, RI and ANC during the week"/>
                Number of households mobilized to increase vaccination coverage, RI and ANC during the week.</td>
                <td><input name="indicator_value2[]" type="number" class="form-control"/></td>

                <td><select class="form-control"  name="method_ver2">
                <option value="VCM Register"> VCM Register </option>

                </select></td>

                </tr>


                 <tr>
                <td> </td>
                <td><input type="hidden" name="indicator2[]" value="No caregivers sensitized on RI, Sanitation, Hygiene and Exclusive bread feeding" />
                No caregivers sensitized on RI, Sanitation, Hygiene and Exclusive bread feeding.</td>
                <td><input  name="indicator_value2[]" type="number" class="form-control"/></td>
                <td></td>
                </tr>


                <tr>
                <td> </td>
                <td><input type="hidden" name="indicator2[]" value="Number of polio survivors engaged in IPDs/IBR to raise awareness"/>
                Number of polio survivors engaged in IPDs/IBR to raise awareness</td>
                <td><input name="indicator_value2[]" type="number" class="form-control"/></td>
                <td></td>
                </tr>


                 <tr>
                <td> </td>
                <td><input type="hidden" name="indicator2[]" value="Number supportive supervisions conducted"/>Number supportive supervisions conducted.</td>
                <td><input name="indicator_value2[]" type="number" class="form-control"/></td>
                <td></td>
                </tr>



                        <!---- Second Ends -->



                        <!----- Third ------>


                         <tr>
                        <td><input type="hidden" name="category3" value="IDPs"/><b>IDPs</b></td>
                        <td>
                        <input type="hidden" name="indicator3[]" value="Number of newly arrived under 5 children registered in VCM registers"/>
                        Number of newly arrived under 5 children registered in VCM registers</td>
                        <td><input name="indicator_value3[]" type="number" class="form-control"/></td>

                        <td><select class="form-control" name="method_ver3">
                        <option value="Dedicated VCM Register at camp entrance"> Dedicated VCM Register at camp entrance  </option>
                        <option value="Activity Reports">Activity Reports</option>
                        <option value="VCM Registers">VCM Registers</option>

                        </select></td>

                        </tr>



                      <tr>
                    <td> </td>
                    <td> <input type="hidden" name="indicator3[]" value="Number of VCM registered under 5 children moved-out of the IDP camp"/>
                    Number of VCM registered under 5 children moved-out of the IDP camp</td>
                    <td><input  name="indicator_value3[]" type="number" class="form-control"/></td>
                    <td></td>
                    </tr>


                     <tr>
                    <td> </td>
                    <td>
                    <input type="hidden" name="indicator3[]" value="Any social mobilization activities conducted in the IDP camp"/>
                    Any social mobilization activities conducted in the IDP camp</td>
                    <td><input type="number"  name="indicator_value3[]"  class="form-control"/></td>
                    <td></td>
                    </tr>



                    <tr>
                    <td> </td>
                    <td>
                    <input type="hidden" name="indicator3[]" value="Total no of VCM registered U5 children in the IDPs camps"/>
                    Total no of VCM registered U5 children in the IDPs camps</td>
                    <td><input type="number"  name="indicator_value3[]"  class="form-control"/></td>
                    <td></td>
                    </tr>



                        <!---- Third Ends --->




                        <!------- Forth ------->




                    <tr>
                    <td><input type="hidden" name="category4" value="Compound meetings and community dialogue"/><b>Compound meetings and community dialogue</b></td>
                    <td>
                    <input type="hidden" name="indicator4[]" value="Number of compound meetings conducted"/>
                    Number of compound meetings conducted</td>
                    <td><input type="number" name="indicator_value4[]" class="form-control"/></td>

                    <td>
                    <select class="form-control" name="method_ver4">
                    <option value="VCM Register">VCM Register</option>
                    <option value="Activity Reports"> Activity Reports </option>
                    </select>
                    </td>


                    </tr>



                     <tr>
                    <td> </td>
                    <td><input type="hidden" name="indicator4[]" value="Total number of participants in the compound meetings"/>
                    Total number of participants in the compound meetings</td>
                    <td><input name="indicator_value4[]"  type="number" class="form-control"/></td>
                    <td></td>
                    </tr>


                    <tr>
                    <td> </td>
                    <td><input type="hidden" name="indicator4[]" value="Number of community dialogues conducted"/>Number of community dialogues conducted</td>
                    <td><input type="number" name="indicator_value4[]"  class="form-control"/></td>
                    <td></td>
                    </tr>


                     <tr>
                    <td> </td>
                    <td><input type="hidden" name="indicator4[]" value="Total Number of participants in the community dialogs"/>
                    Total Number of participants in the community dialogs</td>
                    <td><input type="number" name="indicator_value4[]"  class="form-control"/></td>
                    <td></td>
                    </tr>

                        <!------- Forth Ends here -->




                <!--------- Fifth ----------->


            <tr>
            <td><input type="hidden" name="category5"  value="RFP meetings / mosque announcements"/>
           <b> RFP meetings / mosque announcements </b></td>
            <td><input type="hidden" name="indicator5[]" value="Number of RFPs who intervened with NC families"/>Number of RFPs who intervened with NC families</td>
            <td><input type="number" name="indicator_value5[]" class="form-control"/></td>

            <td><select class="form-control" name="method_ver5">
            <option value="LGF report">LGF report</option>
            <option value="RFP plans">RFP plans</option>

            </select></td>

            </tr>



        <tr>
        <td> </td>
        <td>
        <input type="hidden" name="indicator5[]" value="Number of NC children resolved as a result of RFP intervention"/>
        Number of NC children resolved as a result of RFP intervention</td>
        <td><input type="number" name="indicator_value5[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td>
         <input type="hidden" name="indicator5[]" value="Number of Jumma’t mosques announcing pro-vaccination messages"/>
        Number of Jumma’t mosques announcing pro-vaccination messages</td>
        <td><input type="number"  name="indicator_value5[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td> <input type="hidden" name="indicator5[]" value="Number of Jumma’t mosques monitored"/>Number of Jumma’t mosques monitored</td>
        <td><input type="number" name="indicator_value5[]"  class="form-control"/></td>
        <td></td>
        </tr>




        <tr>
        <td> </td>
        <td> <input type="hidden" name="indicator5[]" value="Number of pro-vaccination church sermons"/>
        Number of pro-vaccination church sermons</td>
        <td><input  name="indicator_value5[]" type="number" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator5[]" value="Number of churches monitored"/>Number of churches monitored</td>
        <td><input type="number" name="indicator_value5[]" class="form-control"/></td>
        <td></td>
        </tr>


                <!-------- Fifth Ends here --->




            <!------- Sixth ------------>

            <tr>
            <td><input type="hidden" name="category6" value="Media engagement"/><b>Media engagement</b> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of advocacy/sensitization meetings conducted with media organizations/groups"/>
            Number of advocacy/sensitization meetings conducted with media organizations/groups</td>
            <td><input type="number"  name="indicator_value6[]"  class="form-control"/></td>

            <td><select class="form-control" name="method_ver6">
            <option value="Media Focal Points">Media Focal Points</option>
            <option value="Slots Schedules, Media Outlets, Listeners etc">Slots Schedules, Media Outlets, Listeners etc</option>
            <option value="Records of Discussion & CD Plates">Records of Discussion & CD Plates</option>
            <option value="Weekly Tracking Tool">Weekly Tracking Tool</option>

            </select></td>

            </tr>


            <tr>
            <td> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of pro-vaccination Radio jingles / radio discussion aired (Polio, Measles )"/>
            Number of pro-vaccination Radio jingles / radio discussion aired (Polio, Measles )</td>
            <td><input type="number" name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>


            <tr>
            <td> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of print media articles published"/>
            Number of print media articles published</td>
            <td><input type="number"  name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>


            <tr>
            <td> </td>
            <td> <input type="hidden" name="indicator6[]" value="Number of TV/radio talk shows/round table discussions aired"/>
            Number of TV/radio talk shows/round table discussions aired</td>
            <td><input type="number"  name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>


             <tr>
            <td> </td>
            <td><input type="hidden" name="indicator6[]" value="Number of radio stations airing edutainment-based radio drama by BBC Media Action"/>
            Number of radio stations airing edutainment-based radio drama by BBC Media Action</td>
            <td><input type="number" name="indicator_value6[]" class="form-control"/></td>
            <td></td>
            </tr>



            <!------ Sixth Ends here ----->





            <!---- Sevent --------------->

        <tr>
        <td><input type="hidden" name="category7" value="IBR Activities"/><b>IBR Activities</b></td>
        <td><input type="hidden" name="indicator7[]" value=""/>Number of naming ceremonies attended by members of VCM-Net during the week</td>
        <td><input type="number" name="indicator_value7[]"  class="form-control"/></td>

        <td><select class="form-control" name="method_ver7">
        <option value="VCM Register"> VCM Register </option>
        <option value="Ona">Ona</option>
        <option value="VWS Register">VWS Register</option>

        </select></td>

        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of U5 children seen in naming ceremonies"/>
        Number of U5 children seen in naming ceremonies</td>
        <td><input type="number" name="indicator_value7[]"  class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of U5 children immunized with OPV"/>
        Number of U5 children immunized with OPV</td>
        <td><input type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>




          <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="during naming ceremonies"/> during naming ceremonies</td>
        <td><input type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of vails received"/>Number of vails received</td>
        <td><input type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


         <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of vails returned"/>Number of vails returned/td>
        <td><input type="number"  name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Total number of Doses"/>Total number of Doses</td>
        <td><input type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>



         <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value=" Number of NC households revisited"/> Number of NC households revisited</td>
        <td><input type="number"  name="indicator_value7[]"  class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of NC children resolved<"/>Number of NC children resolved</td>
        <td><input type="number" name="indicator_value7[]"  class="form-control"/></td>
        <td></td>
        </tr>


         <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of children outstanding"/>Number of children outstanding</td>
        <td><input type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>


        <tr>
        <td> </td>
        <td><input type="hidden" name="indicator7[]" value="Number of pregnant women tracked and referred to health facilities for ANC services"/>
        Number of pregnant women tracked and referred to health facilities for ANC services</td>
        <td><input type="number" name="indicator_value7[]" class="form-control"/></td>
        <td></td>
        </tr>




            <!---- Sevent Ends here ----->






            <!---- Eight ---------->


               <tr>
                <td><input type="hidden" name="category8" value="New-born and Defaulter tracking"/>
               <b> New-born and Defaulter tracking </b></td>
                <td><input type="hidden" name="indicator8[]" value="Number of new born tracked during the week"/>
                Number of new born tracked during the week</td>
                <td><input type="number"  name="indicator_value8[]" class="form-control"/></td>

                <td><select class="form-control" name="method_ver8">
                <option value="Ona">Ona</option>
                <option value="VCM Register">VCM Register</option>

                </select></td>

                </tr>



                <tr>
                <td> </td>
                <td><input type="hidden" name="indicator8[]" value="Number of new borns given zero doze by or with support of VCM network"/>
                Number of new borns given zero doze by or with support of VCM network</td>
                <td><input type="number"  name="indicator_value8[]" class="form-control"/></td>
                <td></td>
                </tr>



                <tr>
                <td> </td>
                <td><input type="hidden" name="indicator8[]"  value="Number of defaulters tracked and reconnected with health facilities"/>
                Number of defaulters tracked and reconnected with health facilities</td>
                <td><input type="number" name="indicator_value8[]" class="form-control"/></td>
                <td></td>
                </tr>



            <!---- Eight Ends here -->



            <!-------- Ninth ----------->


            <tr>
            <td><input type="hidden" name="category9" value="Capacity development"/><b>Capacity development </b></td>
            <td><input type="hidden" name="indicator9[]" value="Number of VCMs who received refresher training"/>
            Number of VCMs who received refresher training</td>
            <td><input type="number" name="indicator_value9[]" class="form-control"/></td>

            <td><select class="form-control" name="method_ver9">
            <option value="Training attendance sheet">Training attendance sheet</option>
            <option value="On the job sensitization ">On the job sensitization </option>

            </select></td>

            </tr>


             <tr>
            <td> </td>
            <td><input type="hidden" name="indicator9[]" value="Number of RFPs oriented/trained, refresher training"/>
            Number of RFPs oriented/trained, refresher training</td>
            <td><input type="number"  name="indicator_value9[]" class="form-control"/></td>
            <td></td>
            </tr>


            <!-------- Ninth Ends here --->


                        </table>
                    </div>



                    </div>
                    <!-- /basic table -->
                    <select name="report_name">
                    <option value="1 week"> 1 week </option>
                    <option value="2 week">2 week </option>
                    <option value="3 week">3 week </option>
                    <option value="4 week">4 week </option>
                    <option value="5 week">5 week </option>
                    <option value="6 week">6 week </option>
                    <option value="7 week">7 week </option>
                    <option value="8 week">8 week </option>
                    <option value="9 week">9 week </option>
                    <option value="10 week">10 week </option>
                    <option value="11 week">11 week </option>
                    <option value="12 week">12 week </option>
                    <option value="13 week">13 week </option>
                    <option value="14 week">14 week </option>
                    <option value="15 week">15 week </option>
                    <option value="16 week">16 week </option>
                    <option value="17 week">17 week </option>
                    <option value="18 week">18 week </option>
                    <option value="19 week">19 week </option>
                    <option value="20 week">20 week </option>
                    <option value="21 week">21 week </option>
                    <option value="22 week">22 week </option>
                    <option value="23 week">23 week </option>
                    <option value="24 week">24 week </option>
                    <option value="25 week">25 week </option>
                    <option value="26 week">26 week </option>
                    <option value="27 week">27 week </option>
                    <option value="28 week">28 week </option>
                    <option value="29 week">29 week </option>
                    <option value="30 week">30 week </option>
                    <option value="31 week">31 week </option>
                    <option value="32 week">32 week </option>
                    <option value="33 week">33 week </option>
                    <option value="34 week">34 week </option>
                    <option value="35 week">35 week </option>
                    <option value="36 week">36 week </option>
                    <option value="37 week">37 week </option>
                    <option value="38 week">38 week </option>
                    <option value="39 week">39 week </option>
                    <option value="40 week">40 week </option>
                    <option value="41 week">41 week </option>
                    <option value="42 week">42 week </option>
                    <option value="43 week">43 week </option>
                    <option value="44 week">44 week </option>
                    <option value="45 week">45 week </option>
                    <option value="46 week">46 week </option>
                    <option value="47 week">47 week </option>
                    <option value="48 week">48 week </option>
                    <option value="49 week">49 week </option>
                    <option value="50 week">50 week </option>
                    <option value="51 week">51 week </option>
                    <option value="52 week">52 week </option>


                    </select>

                    <select name="year">
                    <option value="2018"> 2018 </option>
                    <option value="2019"> 2019 </option>
                    <option value="2020"> 2020 </option>
                    <option value="2021"> 2021 </option>
                    <option value="2022"> 2022 </option>
                    <option value="2023"> 2023 </option>
                    <option value="2024"> 2024 </option>
                    <option value="2025"> 2025 </option>

                    </select>
                    <br>
                    <br>
                    <input type="submit" value="Save as draft" class="btn btn-success"/>


                </div>
                </form>
                <!-- /content area -->

            </div>
            <!-- /main content -->



@push('footerscript')


@endpush
@endsection