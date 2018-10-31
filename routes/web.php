<?php
Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('howitworks',function(){
        return view('howitworks.index');
    });

    Route::get('/home', 'HomeController@index');
    Route::get('payment/getData', 'PaymentController@getData');
    Route::get('payment/payrecord', 'PaymentController@payrecord')->name('payment.payrecord');
    Route::post('payment/payrecordsave', 'PaymentController@payrecordsave');
    Route::get('payment/GetPayList', 'PaymentController@GetPayList');
    Route::get('payment/exportexcel', 'PaymentController@exportexcel');
    Route::resource("payment", "PaymentController");
    Route::get('payment/detail/{id}','PaymentController@getDetail');

    Route::get('payments/pay_clients/{payment_id}','PaymentController@get_payment_clients');
    Route::get('payments/pay_clients/export/{payment_id}','PaymentController@export_pay_clients');
    Route::post('payments/all/export','PaymentController@export_months');

    Route::get('payments/all/clients/{payment_id}','PaymentController@paid_clients')->name('paid.clients');
    Route::post('payments/all/clients/{payment_id}','PaymentController@update_payment_status')->name('paid.clients.status.update');
    Route::get('payments/all/delete/{id}','PaymentController@all_payments_delete');

    Route::post('payments/confirm','PaymentController@confirm');


    // Divyang

    // Route::get("offpayment", "PaymentController@offpayment");
    Route::get('offpayment/payrecord', 'PaymentController@offpayrecord')->name('offpayment.payrecord');
    Route::get('offpayment/offGetPayList', 'PaymentController@offGetPayList');
    Route::post('offpayment/offpayrecordsave', 'PaymentController@offpayrecordsave');
    Route::get('offpayments/all','PaymentController@off_all_payments')->name('offpayment.search');
    Route::post('offpayments/all/export','PaymentController@off_export_months');
    Route::get('offpayments/all/clients/{payment_id}','PaymentController@off_paid_clients')->name('offpaid.clients');
    Route::post('offpayments/all/clients/{payment_id}','PaymentController@off_update_payment_status')->name('offpaid.clients.status.update');
    Route::get('offpayments/off_pay_clients/{payment_id}','PaymentController@off_get_payment_clients');
    Route::get('offpayment/detail/{id}','PaymentController@offgetDetail');
    Route::get('offpayments/pay_clients/export/{payment_id}','PaymentController@off_export_pay_clients');
    Route::get('offpayments/all/delete/{id}','PaymentController@off_all_payments_delete');
    // End

    Route::get('weekly/reports/create',function(){

        return view('reports.create');
    })->name('reports.weekly.create');

    Route::post('weekly/reports/save','ReportsController@save')->name('reports.weekly.save');
    Route::get('weekly/reports/view','ReportsController@view')->name('reports.weekly.view');
    Route::get('weekly/reports/edit/{id}','ReportsController@edit')->name('reports.weekly.edit');
    Route::post('weekly/reports/update/{id}','ReportsController@update')->name('reports.weekly.update');
    Route::get('weekly/reports/send/{id}','ReportsController@send')->name('reports.weekly.send');
    Route::post('weekly/reports/filters','ReportsController@filter')->name('reports.weekly.filter');

    /********************** Carrotsol.com  **************************/
    Route::resource('users','UsersController');
    Route::get('payments/all','PaymentController@all_payments')->name('payment.search');
    /*****************************************************************/
    Route::get('Helpers/CommonClass/lgsist/{id}', function ($state_id) {
        return CommonClass::LGAList($state_id);
    });
});
    Auth::routes();

    Route::group(['middleware' => 'auth','middleware'=>'admin'], function () {

    Route::get('statemaster/getData', 'StateController@getData');
    Route::resource("statemaster", "StateController");

    Route::get('lgamaster/getData', 'LgaController@getData');
    Route::resource("lgamaster", "LgaController");

    Route::get('wardmaster/getData', 'WardController@getData');
    Route::resource("wardmaster", "WardController");

    Route::get('categorymaster/getData', 'CategoryController@getData');
    Route::resource("categorymaster", "CategoryController");

    Route::get('gsmmaster/getData', 'GsmController@getData');
    Route::resource("gsmmaster", "GsmController");

    Route::any('payments/history','PaymentController@history')->name('payment.history');

    Route::get('payments/history/export','PaymentController@history_export');

});
    Route::get('Helpers/CommonClass/wardlist/{id}', function ($lga_id) {
        return CommonClass::WardList($lga_id);
    });
Route::get('test',function(){
    echo "Thank you ";
});