<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@landing');
Route::get('/pengumuman', 'PagesController@pengumuman');
Route::get('/pengumuman/{id}', 'PagesController@pengumumanDetail');
Route::get('/admin', 'AdminController@index');
Route::get('/admin/login', 'AdminController@login');


Route::middleware(['session'])->group(function(){
    Route::get('/dashboard', 'PagesController@index')->middleware('konseli');;

    Route::get('/profile', 'PagesController@profile');
    Route::get('/gantipassword', 'PagesController@gantiPassword');

// Konselor routes
    Route::get('/daftarkonseli', 'PagesController@daftarkonseli');
    Route::get('/arsip', 'PagesController@arsip')->middleware('konseli');
    Route::get('/caseconference', 'PagesController@caseconference');

// Konseli routes
    Route::get('/daftarsesi', 'PagesController@daftarSesi')->middleware('konseli');
    Route::get('/ruangkonseling', 'PagesController@ruangkonseling')->middleware('konseli');
    Route::get('/gantijadwal', 'PagesController@gantiJadwal')->middleware('konseli');;
    Route::get('/pin', 'PagesController@pin')->middleware('konseli');;
    Route::get('/gantipin', 'PagesController@changePin')->middleware('konseli');;

// Setups routes
    Route::get('/setup/caseconference', 'PagesController@conferenceSetup');
    Route::get('/setup/referral', 'PagesController@referralSetup');
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/konselor', 'AdminController@konselor');
    Route::get('/admin/report', 'AdminController@report');
    Route::get('/admin/setting', 'AdminController@setting');
    Route::get('/admin/informasi', 'AdminController@informasi');
    Route::get('/admin/konselor/tambah', 'AdminController@tambahKonselor');
    Route::get('/admin/konselor/edit/{id}', 'AdminController@editKonselor');
    Route::post('/admin/post', 'AdminController@doLogin');
});

// Admin routes


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Route::post('/services/konselor/tambahKonselor', 'UserController@tambahKonselor');
Route::post('/services/konselor/editKonselor', 'UserController@editKonselor');

Route::post('services/auth/login', 'UserController@login');
Route::post('services/auth/pin', 'UserController@pin')->middleware('customthrottle:2,2');
Route::post('services/auth/gantipin', 'UserController@gantiPin');
Route::post('services/auth/login/admin', 'UserController@adminLogin');
Route::post('services/auth/register', 'UserController@register');
Route::post('services/auth/siasat', 'UserController@siasatLogin');
Route::post('services/auth/changepassword', 'UserController@changePassword');


Route::get('services/jadwalkonselor', 'JadwalKonselorController@index');


Route::get('services/konseling/statistic', 'KonselingController@statistic');
Route::get('services/expired', 'KonselingController@checkExpired');
Route::get('services/konseling', 'KonselingController@index');
Route::get('services/konseling/count','KonselingController@count');
Route::post('services/konseling/end', 'KonselingController@end');
Route::get('services/konseling/{id}', 'KonselingController@show');
Route::post('services/konseling', 'KonselingController@create');

Route::get('/services/konseli/{id}', 'KonseliController@show');

Route::get('services/conference', 'CaseConferenceController@index');
Route::get('services/conference/{id}', 'CaseConferenceController@show');
Route::post('services/conference/createagreement', 'CaseConferenceController@createAgreement');
Route::post('services/conference', 'CaseConferenceController@store');
Route::post('services/conference/declineagreement', 'CaseConferenceController@declideAgreement');

Route::post('services/rangkumankonseling', 'RangkumanKonselingController@store');

Route::get('services/chatconference', 'ChatConferenceController@index');
Route::get('services/chatconference/chat', 'ChatConferenceController@chat');
Route::get('services/chatconference/{id}', 'ChatConferenceController@show');
Route::post('services/chatconference', 'ChatConferenceController@store')->middleware('sanitizer');
Route::put('services/chatconference', 'ChatConferenceController@update');

Route::get('services/detailconference/tes', 'DetailConferenceController@tes');
Route::get('services/detailconference', 'DetailConferenceController@index');
Route::get('services/detailconference/{id}', 'DetailConferenceController@show');
Route::post('services/detailconference', 'DetailConferenceController@store');

Route::get('services/referral', 'ReferalController@index');
Route::get('services/referral/{id}', 'ReferalController@show');
Route::post('services/referral', 'ReferalController@store');
Route::post('services/referral/createagreement', 'ReferalController@createAgreement');
Route::post('services/referral/declineagreement', 'ReferalController@declideAgreement');
Route::post('services/referral/begin', 'ReferalController@beginReferral');

Route::get('services/rekamkonseling', 'RekamKonselingController@show');
Route::post('services/rekamkonseling', 'RekamKonselingController@update');

Route::post('services/user/edit', 'UserController@editProfile');
Route::post('services/user/changephoto', 'UserController@changePhoto');

Route::get('/logout', 'UserController@logout');


Route::get('services/notification', 'NotificationController@index');
Route::get('services/notification/{id}', 'NotificationController@show');
Route::get('services/notification/count/{id}', 'NotificationController@count');
Route::post('services/notification', 'NotificationController@store');
Route::put('services/notification/{id}', 'NotificationController@update');
Route::post('services/notification/read/{id}', 'NotificationController@read');
Route::get('/notification/readall', 'NotificationController@readAll');
Route::get('/notification/{id}', 'NotificationController@read');


Route::post('/services/setting', 'SettingController@store');

Route::put('/services/pengumuman', 'PengumumanController@update');
Route::post('/services/pengumuman', 'PengumumanController@store');
Route::delete('/services/pengumuman/{id}', 'PengumumanController@destroy');

Route::put('/services/quote', 'QuoteController@update');
Route::post('/services/quote', 'QuoteController@store');
Route::delete('/services/quote/{id}', 'QuoteController@destroy');

Route::get('/services/tes', 'PagesController@tes');
