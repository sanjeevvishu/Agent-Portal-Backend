<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['api']], function () {
    Route::prefix('v1')->namespace('Api\v1')->group(function () {
        
        // if(isset($_SERVER["HTTP_ORIGIN"])){
        //     header('Access-Control-Allow-Origin: *');
        //     header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        //     header('Access-Control-Allow-Headers: Origin, X-Requested-With,Authorization,  Content-Type, Accept');
        // } 
        
        
       

        Route::group(['middleware' => ['auth:api']], function () {
            
            Route::post('auth/updatePassword', [App\Http\Controllers\Api\v1\ForgotPasswordController::class,'updatePassword']);

            Route::post('orgzit', [App\Http\Controllers\Api\v1\OrgzitController::class, 'index']);
            Route::post('orgzit/sales', [App\Http\Controllers\Api\v1\OrgzitController::class, 'salesList']);
            Route::post('orgzit/appointments', [App\Http\Controllers\Api\v1\OrgzitController::class, 'appointmentsList']);
            Route::post('orgzit/appointmentsmini', [App\Http\Controllers\Api\v1\OrgzitController::class, 'appointmentsMiniList']);
            Route::post('orgzit/notifications', [App\Http\Controllers\Api\v1\OrgzitController::class, 'dashboardNotificationsList']);
            Route::post('orgzit/properties', [App\Http\Controllers\Api\v1\OrgzitController::class, 'getTotalPropertiesList']);
            
            Route::post('orgzit/meeting', [App\Http\Controllers\Api\v1\OrgzitController::class, 'meetingList']);
            Route::post('orgzit/meetinglist', [App\Http\Controllers\Api\v1\OrgzitController::class, 'allMeetingList']);
            
            Route::post('orgzit/payplans', [App\Http\Controllers\Api\v1\OrgzitController::class, 'paymentPlanList']);
            Route::post('orgzit/create_appointment', [App\Http\Controllers\Api\v1\OrgzitController::class, 'createAppointment']);
            Route::post('orgzit/projects', [App\Http\Controllers\Api\v1\OrgzitController::class, 'getActiveProjects']);
            Route::post('orgzit/welcomeinfo', [App\Http\Controllers\Api\v1\OrgzitController::class, 'getAgentWelcomePageDetails']);


            /* Get User Profiles Details in Agent Dashboard */
            Route::post('orgzit/profile_details', [App\Http\Controllers\Api\v1\OrgzitController::class, 'getAgentProfileDetails']);

            
            /* Vagon */
            Route::post('vagon/getStream', [App\Http\Controllers\Api\v1\VagonController::class, 'getStream']);
            Route::post('vagon/deleteStream', [App\Http\Controllers\Api\v1\VagonController::class, 'deleteStream']);
            
            Route::post('vagon/checkAuth', [App\Http\Controllers\Api\v1\VagonController::class, 'checkAuth']);
            Route::post('vagon/storeLogs', [App\Http\Controllers\Api\v1\VagonController::class, 'storeLogs']);

        });
       
         /* exchangeRates */
        Route::get('exchangeRates/latest', [App\Http\Controllers\Api\v1\ExchangeRatesController::class,'latest']);
        
        /* auth */
        Route::post('auth', [App\Http\Controllers\Api\v1\AuthController::class,'store']);
        Route::post('auth/forgetPassword', [App\Http\Controllers\Api\v1\ForgotPasswordController::class,'submitForgetPasswordForm']);
        Route::post('auth/resetPassword', [App\Http\Controllers\Api\v1\ForgotPasswordController::class,'submitResetPasswordForm']);
       
        /* HELP & SUPPORT */
        Route::post('orgzit/help_support_email', [App\Http\Controllers\Api\v1\OrgzitController::class, 'helpSupportEmail']);

        /* Vagon */
        Route::get('vagon/createUser', [App\Http\Controllers\Api\v1\VagonController::class, 'createUser']);
        Route::get('vagon/startStream', [App\Http\Controllers\Api\v1\VagonController::class, 'startStream']);
        Route::get('vagon/assigningStreamSessionToUser', [App\Http\Controllers\Api\v1\VagonController::class, 'assigningStreamSessionToUser']);

        
        /* Orgzit Homepage Contact*/
        Route::post('orgzit/requestEnrollment', [App\Http\Controllers\Api\v1\OrgzitController::class, 'requestEnrollment']);
        /* Orgzit Project Inventry */
        Route::post('orgzit/unitEnquireRequest', [App\Http\Controllers\Api\v1\OrgzitController::class, 'unitEnquireRequest']);
        /* Orgzit Project List & Details */
        Route::post('orgzit/projectEnquireRequest', [App\Http\Controllers\Api\v1\OrgzitController::class, 'projectEnquireRequest']);
        
        /* CuSocial */
        Route::get('cusocial/latestHome', [App\Http\Controllers\Api\v1\CuSocialController::class,'latestHome']);
        Route::get('cusocial/latestByCategory/{category}', [App\Http\Controllers\Api\v1\CuSocialController::class,'latestByCategory']);
        Route::get('cusocial/byCategory/{category}', [App\Http\Controllers\Api\v1\CuSocialController::class,'byCategory']);
        Route::get('cusocial/show/{cusocial}', [App\Http\Controllers\Api\v1\CuSocialController::class,'show']);

         /* CuEvent */
         Route::get('cuevent/latestHome', [App\Http\Controllers\Api\v1\CuEventController::class,'latestHome']);
         Route::get('cuevent/show/{cuevent}', [App\Http\Controllers\Api\v1\CuEventController::class,'show']);
 
        
        /* projects */
        Route::get('projects/featuredHome', [App\Http\Controllers\Api\v1\ProjectsController::class,'featuredHome']);
        Route::get('projects/list', [App\Http\Controllers\Api\v1\ProjectsController::class,'list']);
        Route::get('projects/show/{project}', [App\Http\Controllers\Api\v1\ProjectsController::class,'show']);
        Route::get('projects/units/{project}', [App\Http\Controllers\Api\v1\ProjectsController::class,'units']);
        Route::get('projects/interiorInventory/{project}/{apartment_id}', [App\Http\Controllers\Api\v1\ProjectsController::class,'interiorInventory']);
        
        //Route::get('projects/unitShow/{project}/{unit}', [App\Http\Controllers\Api\v1\ProjectsController::class,'unitShow']);
        Route::post('projects/media/{project}', [App\Http\Controllers\Api\v1\ProjectsController::class,'media']);

        Route::get('cuverse/projects', [App\Http\Controllers\Api\v1\CuVerseController::class,'projects']);
        Route::get('cuverse/project/{project}', [App\Http\Controllers\Api\v1\CuVerseController::class,'project']);
        Route::get('cuverse/categories/{project}', [App\Http\Controllers\Api\v1\CuVerseController::class,'categories']);
        Route::get('cuverse/categories/{project}', [App\Http\Controllers\Api\v1\CuVerseController::class,'categories']);
        Route::get('cuverse/mediaFiles/{project}', [App\Http\Controllers\Api\v1\CuVerseController::class,'mediaFiles']);
        Route::get('cuverse/download/{id}', [App\Http\Controllers\Api\v1\CuVerseController::class,'download']);

        

    });
});


// Route::prefix('admin')->middleware(['auth'])->name('admin.')->group( function () {
	
//     Route::post('media/{project}', [App\Http\Controllers\Admin\ProjectMediaController::class,'store'])->name('projects.galleryMedia');
// });
