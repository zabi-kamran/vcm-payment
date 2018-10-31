@extends('layout.app')
@section('title','Reports')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
                   <div class="page-header">


                <div class="content">
             <div class="panel panel-flat">

              <form method="POST" action="{{ route('reports.weekly.filter') }}">

              {{ csrf_field()  }}
             <div class="row" style="padding: 15px;">

             @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)

            <div class="col-sm-6">
            <select class="form-control" name="week">

            <option value="1 week"> 1 week </option>
            <option value="2">2 week </option>
            <option value="3">3 week </option>
            <option value="4">4 week </option>
            <option value="5">5 week </option>
            <option value="6">6 week </option>
            <option value="7">7 week </option>
            <option value="8">8 week </option>
            <option value="9">9 week </option>
            <option value="10">10 week </option>
            <option value="11">11 week </option>
            <option value="12">12 week </option>
            <option value="13">13 week </option>
            <option value="14">14 week </option>
            <option value="15">15 week </option>
            <option value="16">16 week </option>
            <option value="17">17 week </option>
            <option value="18">18 week </option>
            <option value="19">19 week </option>
            <option value="20">20 week </option>
            <option value="21">21 week </option>
            <option value="22">22 week </option>
            <option value="23">23 week </option>
            <option value="24">24 week </option>
            <option value="25">25 week </option>
            <option value="26">26 week </option>
            <option value="27">27 week </option>
            <option value="28">28 week </option>
            <option value="29">29 week </option>
            <option value="30">30 week </option>
            <option value="31">31 week </option>
            <option value="32">32 week </option>
            <option value="33">33 week </option>
            <option value="34">34 week </option>
            <option value="35">35 week </option>
            <option value="36">36 week </option>
            <option value="37">37 week </option>
            <option value="38">38 week </option>
            <option value="39">39 week </option>
            <option value="40">40 week </option>
            <option value="41">41 week </option>
            <option value="42">42 week </option>
            <option value="43">43 week </option>
            <option value="44">44 week </option>
            <option value="45">45 week </option>
            <option value="46">46 week </option>
            <option value="47">47 week </option>
            <option value="48">48 week </option>
            <option value="49">49 week </option>
            <option value="50">50 week </option>
            <option value="51">51 week </option>
            <option value="52">52 week </option>

            </select>
            </div>

            <div class="col-sm-6">
            <input type="submit" class="btn btn-success"/>

            </div>

            @endif

             </div>
             </form>

                  <div class="table-responsive">
                <table class="table table-responsive">

                <thead>
                <tr>
                <th> ID </th>
                <th> Report Name </th>
                <th> Status </th>
                <th> Created at </th>
                <th> Action </th>

                </tr>

                </thead>

                <tbody>

                @foreach($reports as $report)
                <tr>
                <td> {{ $report->id }} </td>
                <td> {{ $report->name  }} </td>
                <td>

                @if($report->issaved==1 && $report->issent==0)

                 Draft

                @else
                Sent
                @endif




                </td>
                <td> {{ $report->created_at  }} </td>

                @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)

                @if($report->issent==0)
                <td><a class="btn btn-primary" href="{{ route('reports.weekly.edit',$report->id)  }}"> Edit </a></td>

               @else
                 <td> Report is Sent </td>


                @endif

                @else

                 <td><a class="btn btn-primary" href="{{ route('reports.weekly.edit',$report->id)  }}"> View </a></td>

                @endif




                </tr>
                @endforeach


                </tbody>


                </table>

                </div>
                </div>
                </div>
                </div>

                <!-- /content area -->

            </div>
            <!-- /main content -->



@push('footerscript')


@endpush
@endsection