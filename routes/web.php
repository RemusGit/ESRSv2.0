<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsTabController;
use App\Http\Controllers\RequestOfficerController;
use App\Http\Controllers\RequestClientController;

//Route::get('/', function () { return view('welcome'); });


Route::get('/' ,[AccountsTabController::class , 'login'])->name('login');

Route::get('/register_account' , [AccountsTabController::class , 'registerAccount']);


Route::get('/client_dashboard' , [AccountsTabController::class , 'clientDashboard'])->middleware('auth');

Route::get('/officer_dashboard' , [AccountsTabController::class , 'officerDashboard'])->middleware('auth');
Route::post('/officer_dashboard' , [AccountsTabController::class , 'officerDashboard'])->name('filter_request');

//Route::get('authenticate_user/{account_empid}' , [AccountsTabController::class , 'authUser']);

Route::get('/login' , [AccountsTabController::class , 'login'])->name('login'); //required by laravel when user is not authenticate

Route::get('/logout' , [AccountsTabController::class , 'logout']);

//Route::post('/filter_reference' , [RequestOfficerController::class , 'filterReference'])->name('filter_reference');


//OFFICER OPEN REQUEST ROUTE
Route::get('/officer_open_request' , [RequestOfficerController::class , 'officerOpen'])->middleware('auth');
Route::post('/officer_open_request' , [RequestOfficerController::class , 'officerOpen']);

//OFFICER INPROGRESS REQUEST ROUTE
Route::get('/officer_inprogress_request' , [RequestOfficerController::class , 'officerInprogress'])->middleware('auth');
Route::post('/officer_inprogress_request' , [RequestOfficerController::class , 'officerInprogress']);

//OFFICER ACKNOWLEDGE REQUEST ROUTE
Route::get('/officer_acknowledge_request' , [RequestOfficerController::class , 'officerAcknowledge'])->middleware('auth');
Route::post('/officer_acknowledge_request' , [RequestOfficerController::class , 'officerAcknowledge']);

//OFFICER COMPLETED REQUEST ROUTE
Route::get('/officer_completed_request' , [RequestOfficerController::class , 'officerCompleted'])->middleware('auth');
Route::post('/officer_completed_request' , [RequestOfficerController::class , 'officerCompleted']);

//OFFICER CANCELLED REQUEST ROUTE
Route::get('/officer_cancelled_request' , [RequestOfficerController::class , 'officerCancelled'])->middleware('auth');
Route::post('/officer_cancelled_request' , [RequestOfficerController::class , 'officerCancelled']);


//Route::get('/officer_requests' , [RequestOfficerController::class , 'officerRequests']);
//Route::post('/officer_requests' , [RequestOfficerController::class , 'officerRequests'])->name('officer_filter_request');


//CLIENT OPEN REQUEST ROUTE
Route::get('/client_open_request' , [RequestClientController::class , 'clientOpen'])->middleware('auth');
Route::post('/client_open_request' , [RequestClientController::class , 'clientOpen']);

//CLIENT IN PROGRESS REQUEST ROUTE
Route::get('/client_inprogress_request' , [RequestClientController::class , 'clientInprogress'])->middleware('auth');
Route::post('/client_inprogress_request' , [RequestClientController::class , 'clientInprogress']);

//CLIENT ACKNOWLEDGE REQUEST ROUTE
Route::get('/client_acknowledge_request' , [RequestClientController::class , 'clientAcknowledge'])->middleware('auth');
Route::post('/client_acknowledge_request' , [RequestClientController::class , 'clientAcknowledge']);

//CLIENT COMPLETED REQUEST ROUTE
Route::get('/client_completed_request' , [RequestClientController::class , 'clientCompleted'])->middleware('auth');
Route::post('/client_completed_request' , [RequestClientController::class , 'clientCompleted']);

//CLIENT CANCELLED REQUEST ROUTE
Route::get('/client_cancelled_request' , [RequestClientController::class , 'clientCancelled'])->middleware('auth');
Route::post('/client_cancelled_request' , [RequestClientController::class , 'clientCancelled']);

/*
Route::get('/officer_get_data/{getStatus}' , [RequestOfficerController::class , 'getofficerGetData']);
Route::get('/officer_get_data' , [RequestOfficerController::class , 'getofficerGetData']);
Route::post('/officer_get_data' , [RequestOfficerController::class , 'getofficerGetData'])->name('officer_get_data');
*/


Route::post('/client_cancel_request' , [RequestClientController::class , 'clientCancelRequest'])->name('clientCancelRequest');

//---------------------------------------------------------- AJAX REQUESTS
//client-page
Route::post('/get_updates_from_editrequest_tab' , [RequestClientController::class , 'ajaxShowUpdate'])->name('getUpdates');
Route::post('/get_action_from_actiontaken_tab' , [RequestClientController::class , 'ajaxShowAction'])->name('getAction');
Route::post('/view_attachment' , [RequestClientController::class , 'viewAttachment'])->name('viewAttachment');
Route::post('/acknowledge_request' , [RequestClientController::class , 'acknowledgeRequest']);
Route::post('/undo_request_client' , [RequestClientController::class , 'undoRequestClient']);
Route::get('/web_upload_download/{fileName}' , [RequestClientController::class , 'webUploadDownload']);
//Route::get('/test_pdf' , [RequestClientController::class , 'testPDF']);

// FPDF
Route::get('/vmc_card_form/{getRefID}' , [RequestClientController::class , 'vmcCardForm']);
Route::get('/condemn_form/{getRefID}' , [RequestClientController::class , 'viewCondemnForm']);


Route::get('/load_section' , [RequestClientController::class , 'loadSection'])->name('loadSection');
Route::get('/load_designation' , [RequestClientController::class , 'loadDesignation'])->name('loadDesignation'); //same as position
Route::get('/load_employment_status' , [RequestClientController::class , 'loadEmpStatus'])->name('loadEmpStatus');
Route::get('/load_connection_type' , [RequestClientController::class , 'loadConnection'])->name('loadConnection');
Route::get('/load_vmc_system' , [RequestClientController::class , 'loadVmcSystem'])->name('loadVmcSystem');

Route::get('/load_location' , [RequestClientController::class , 'loadLocation'])->name('loadLocation');
Route::get('/load_floor/{buildingID}' , [RequestClientController::class , 'loadFloor']);

Route::get('/load_city' , [RequestClientController::class , 'loadCity'])->name('loadCity');
Route::get('/load_barangay/{getCityCode}' , [RequestClientController::class , 'loadBarangay']);

//IMISS REQUESTS
Route::post('/add_biometrics_enrollment' , [RequestClientController::class , 'addBioEnroll']);
Route::post('/add_homis_encode_error' , [RequestClientController::class , 'addHomisEncodeError']);
Route::post('/add_zoom_link' , [RequestClientController::class , 'addZoomMeeting']);
Route::post('/add_others_imiss' , [RequestClientController::class , 'addOthersImiss']);
Route::post('/add_web_uploads' , [RequestClientController::class , 'addWebUploads']);
Route::post('/add_network_install' , [RequestClientController::class , 'addNetworkInstall']);
Route::post('add_repait_it_equipment' , [RequestClientController::class , 'addRepairItEquipment']);
Route::post('/add_system_enhance' , [RequestClientController::class , 'addSystemEnhance']);
Route::post('/add_technical_assistance' , [RequestClientController::class , 'addTechAssist']);
Route::post('/add_training_orientation' , [RequestClientController::class , 'addTrainingOrientation']);
Route::post('/add_user_account_management' , [RequestClientController::class , 'addUserAccMngt']);
Route::post('/add_vmc_id_card' , [RequestClientController::class , 'addVmcIdCard']);

//EFMS REQUESTS
Route::post('/add_all_efms_request' , [RequestClientController::class , 'addAllEFMS']);
Route::post('/add_efms_tc' , [RequestClientController::class , 'addEfmsTC']);


//officer-page
Route::post('/distribute_request_get_staff' , [RequestOfficerController::class , 'ajaxDistributeRequest'])->name('ajaxDistributeRequest');
Route::post('/assign_staff' , [RequestOfficerController::class , 'assignStaff'])->name('assignStaff');
//Route::post('/take_request' , [RequestOfficerController::class , 'takeRequest']);
Route::post('/done_request' , [RequestOfficerController::class , 'doneRequest']);
Route::post('/undo_request' , [RequestOfficerController::class , 'undoRequest']);
Route::post('/officer_condemn_request' , [RequestOfficerController::class , 'condemnRequest']);
Route::get('/load_all_category' , [RequestOfficerController::class , 'loadAllCategory']);

Route::get('/officer_my_report' , [RequestOfficerController::class , 'officerMyReport'])->middleware('auth');
Route::post('/officer_my_report' , [RequestOfficerController::class , 'officerMyReport'])->name('officerMyReport');
Route::get('/officer_my_report_pdf/{reqDateFrom}/{reqDateTo}/{reqStatus}' , [RequestOfficerController::class , 'myReportPDF']);

Route::get('/officer_log_report' , [RequestOfficerController::class , 'officerLogReport'])->middleware('auth');
Route::post('/officer_log_report' , [RequestOfficerController::class , 'officerLogReport'])->name('officerLogReport');
Route::get('/officer_log_report_pdf/{reqDateFrom}/{reqDateTo}/{reqStatus}/{reqAgent}' , [RequestOfficerController::class , 'logReportPDF']);

Route::get('/location_floor_settings' , [RequestOfficerController::class , 'locationFloorSettings'])->middleware('auth');
Route::get('/request_duration_settings' , [RequestOfficerController::class , 'requestDurationSettings'])->middleware('auth');

Route::post('/reopen_request' , [RequestOfficerController::class , 'reopenRequest']);
Route::post('/officer_cancel_request' , [RequestOfficerController::class , 'officerCancelRequest']);
Route::post('/officer_add_action' , [RequestOfficerController::class , 'addNewAction']);
Route::post('/officer_update_category' , [RequestClientController::class , 'officerUpdateCategory']);
Route::post('/officer_add_location' , [RequestOfficerController::class , 'officerAddLocation'])->name('officerAddLocation');
Route::post('/officer_delete_location' , [RequestOfficerController::class , 'officerDeleteLocation'])->name('officerDeleteLocation');
Route::post('/officer_update_location' , [RequestOfficerController::class , 'officerUpdateLoc'])->name('officerUpdateLoc');
Route::post('/officer_add_duration' , [RequestOfficerController::class , 'officerAddDuration'])->name('officerAddDuration');

Route::post('/test_notify' , [RequestOfficerController::class , 'testNotify']);

Route::post('/ajax_officer_open' , [RequestOfficerController::class , 'ajaxOfficerRefreshTable'])->name('ajaxOfficerRefreshTable');
Route::post('/ajax_client_list' , [RequestClientController::class , 'ajaxClientList'])->name('ajaxClientList');
Route::post('/ajax_load_tag_agent' , [RequestOfficerController::class , 'ajaxLoadTagAgents'])->name('ajaxLoadTagAgents');
Route::post('/ajax_tag_agent_confirm' , [RequestOfficerController::class , 'ajaxTagAgentConfirm'])->name('ajaxTagAgentConfirm');

//WEBSOCKET AUTH
Route::middleware('auth')->post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});

//TEMPORARY USER LIST
Route::post('authenticate_user' , [AccountsTabController::class , 'authUser'])->name('authUser');