@extends('layout.app')
@section('title','How it Works')
@section('content')
 <!-- Main content -->
            <div class="content-wrapper">
               <div class="page-header" style="padding:30px;">

               <h1>
                Welcome to VCM payment system
               </h1>

                <p>
                This application will help you to manage your VCM/VWS network and process monthly payments. There are three main sections in the application.
                </p>

                <table class="table table-responsive">
                <thead >
                <tr>
                <th> Function </th>
                <th> Link</th>
                <th>Use When</th>


                </tr>
                </thead>

                <tbody>
                <tr>
                <td><b>Add new VCM/VWS</b> </td>
                <td>

                <a class="btn btn-primary" href="payment/create"> Add new Record </a>
                </td>

                <td> Use this function when new VCM/VWS join your network in the state  </td>

                </tr>

                <tr>
                <td><b> Edit information about existing VCM/VWS </b></td>
                <td>
                <a class="btn btn-danger" href="https://vcmpay.azurewebsites.net/payment"> Payment Management  </a>
                </td>

                <td> Use this when you have existing VCM/VWS and you want to edit information for example phone number or add information about Mother name  </td>

                </tr>


                <tr>
                <td><b> Process monthly VCM/VWS payments </b> </td>
                <td>

                <a class="btn btn-success" href="https://vcmpay.azurewebsites.net/payment/payrecord"> Process Payment </a>
                </td>
                <td> Use this every month to process payments and submit for processing to Country Office Finance Section (Abuja) </td>

                </tr>

                <tr>
                <td><b> Search for Payment  </b> </td>
                <td> <a class="btn" style="background-color:grey;color:white;" href="https://vcmpay.azurewebsites.net/payments/all"> Search Payment   </a></td>
                <td> Use this when you want to see all payments that were processed and also when you want to confirm VCM/VWS that were actually paid by payment agents (e-transact)</td>

                </tr>



                </tbody>

                </table>
                <br>


                <h3>

The last part is for weekly communication updates prepared by Data Consultants to


                </h3>



                <table class="table table-responsive">

                <thead>
                <tr>
                <th> Function </th>
                <th> Link </th>
                <th> Use When </th>

                </tr>
                </thead>

                <tbody>

                <tr>
                <td> <b>Create report </b> </td>
                <td> <a  class="btn" style="background-color:purple;color:white;" href="https://vcmpay.azurewebsites.net/weekly/reports/create"> Create Report </a> </td>
                <td> Use every week to submit your data to Abuja  </td>

                </tr>

                <tr>
                <td><b> View Reports</b>  </td>
                <td> <a class="btn" style="background-color:purple;color:white;"  href="https://vcmpay.azurewebsites.net/weekly/reports/view"> View Reports </a> </td>
                <td>Use when you want to finalize draft report and view previous reports </td>

                </tr>

                </tbody>


                </table>
              </div>
            </div>

@endsection
