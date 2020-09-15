<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('uac\login');
});

Route::get('/monitoring/connector', 'MonitoringController@Connector')->name('monitor_connector');
Route::get('/monitoring/energy_streamer', 'MonitoringController@EnergyStreamer')->name('monitor_energy_streamer');
Route::get('/monitoring/energy_streamer/detail/{transaction_pk}', 'MonitoringController@EnergyStreamerDetail');
Route::get('/monitoring/energy_graph_live/{transaction_pk}', 'MonitoringController@DisplayStreamer');


Route::get('/tester', 'TesterController@index');


Route::get('/login', 'UACController@DisplayLoginPage')->name('login');
Route::post('/PerformLogin', 'UACController@PerformLogin');
Route::get('/logout', 'UACController@Logout')->name('logout');
Route::get('/my_profile', 'UACController@MyProfile')->name('my_profile');
Route::post('/UpdateMyProfile', 'UACController@UpdateMyProfile');
Route::get('/my_password', 'UACController@MyPassword')->name('my_password');
Route::post('/ChangeMyPassword', 'UACController@ChangeMyPassword');
Route::get('/uac/view', 'UACController@ViewAllAdmin')->name('view_all_admin');
Route::get('/uac/DownloadCSV', 'UACController@DownloadCSV');
Route::get('/uac/add', 'UACController@AddAdmin')->name('add_new_admin');
Route::post('/uac/SaveNewAdminUser', 'UACController@SaveNewAdminUser');
Route::get('/uac/detail/{id}', 'UACController@ViewAdminDetail');
Route::post('/uac/UpdateOtherAdminProfile', 'UACController@UpdateOtherAdminProfile');
Route::get('/uac/delete/{id}', 'UACController@DeleteAdminAccount');
Route::get('/uac/reset/{id}', 'UACController@ResetPasswordAdmin');


/*
*
*	DASHBOARD
*
*/
Route::get('/dashboard/view', 'DashboardController@ViewDashboard')->name('dashboard');
Route::get('/dashboard/DownloadLatestUsageCSV', 'DashboardController@DownloadLatestUsageCSV');




/*
*
*	CHARGING STATION
*
*/
Route::get('/cs/view', 'CSController@View')->name('view_all_cs');
Route::get('/cs/DownloadCSV', 'CSController@DownloadCSV');
Route::get('/cs/add', 'CSController@Add')->name('create_new_evcs');
Route::post('/cs/save_new_cs', 'CSController@SaveNewCS');
Route::get('/cs/detail/{id}', 'CSController@Detail');
Route::post('/cs/update_existing_cs', 'CSController@UpdateExistingCS');
Route::get('/cs/delete/{id}', 'CSController@DeleteExistingCS');
Route::get('/cs/ForwardToDetailFromConnectorPK/{connector_pk}', 'CSController@ForwardToDetailFromConnectorPK');




/*
*
*	CUSTOMER
*
*/
Route::get('/customer/view', 'CustomerController@View')->name('view_all_customer');
Route::get('/customer/DownloadCSV', 'CustomerController@DownloadCSV');
Route::get('/customer/add', 'CustomerController@Add')->name('create_new_customer');
Route::post('/customer/save_new_customer', 'CustomerController@SaveNewCustomer');
Route::get('/customer/detail/{id}', 'CustomerController@Detail');
Route::post('/customer/update_existing_customer', 'CustomerController@UpdateExistingCustomer');
Route::get('/customer/delete/{id}', 'CustomerController@DeleteExistingCustomer');
Route::get('/account_verification/{verification_id}', 'CustomerController@VerifyAccount');
Route::get('customer/detail/{id}/BlockIDTag/{id_tag}', 'CustomerController@BlockIDTag');
Route::get('customer/detail/{id}/OpenIDTag/{id_tag}', 'CustomerController@OpenIDTag');




/*
*
*	ALERT
*
*/
Route::get('/alert/view', 'AlertController@View')->name('view_all_alert');
Route::get('/alert/DownloadCSV', 'AlertController@DownloadCSV');




/*
*
*	ACTIVITY
*
*/
Route::get('/activity/view', 'ActivityController@View')->name('view_all_activity');
Route::get('/activity/DownloadCSV', 'ActivityController@DownloadCSV')->name('activity_download_csv');




/*
*
*	TRANSACTION
*
*/
Route::get('/transaction/view', 'TransactionController@View')->name('view_all_transaction');
Route::get('/transaction/DownloadCSV', 'TransactionController@DownloadCSV')->name('transaction_download_csv');
Route::get('/transaction/detail/{transaction_pk}', 'TransactionController@Detail');




/*
*
*	REPORT
*
*/
Route::get('/report/evcs_statistic', 'EVCSStatistics@index')->name('evcs_statistic');

Route::get('/report/evcs_yearly', 'Reporting@Forward_EVCSYearly')->name('report_evcs_yearly');
Route::get('/report/evcs_yearly/{year}', 'Reporting@EVCSYearly');
Route::get('/report/evcs_yearly/export/monthly_data/{year}', 'Reporting@EVCSYearly_Export_MonthlyData');
Route::get('/report/evcs_yearly/export/monthly_data_per_evcs/{year}', 'Reporting@EVCSYearly_Export_MonthlyData_PerEVCS');
Route::get('/report/evcs_yearly/export/monthly_data_per_tag/{year}', 'Reporting@EVCSYearly_Export_MonthlyData_PerTag');

Route::get('/report/evcs_monthly', 'Reporting@Forward_EVCSMonthly')->name('report_evcs_monthly');
Route::get('/report/evcs_monthly/{year}/{month}', 'Reporting@EVCSMonthly');



/*
Route::get('/cms/fashion/add', 'CMSController@DisplayAddFashionForm');
Route::post('/cms/fashion/save_new_fashion_portfolio','CMSController@SaveNewFashionPortfolio');
Route::get('/cms/fashion/detail/{id}', 'CMSController@DisplayFashionDetailForm');
*/












