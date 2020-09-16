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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/k',function (Request $request) {
    return 'Hello world';
});
Route::get('/authorize/{partnerRole}','OptInNotificationController@getAuthorized');
Route::post('/notification/mo/{partnerRole}','NotificationController@createMONotification');
Route::post('/notification/mt/dn/{partnerRole}','MTNotificationController@createMTNotification');
Route::post('/notification/user-optin/{partnerRole}','OptInNotificationController@createOptInNotification');
Route::post('/notification/user-optout/{partnerRole}','OptOutNotificationController@createOptOutNotification');
Route::post('/notification/user-renewed/{partnerRole}','RenewalNotificationController@createRenewalNotification');
Route::post('/notification/first-charge/{partnerRole}','OptInNotificationController@notifyFirstCharge');
