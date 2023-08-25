<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SystemSettingController;


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
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

// Route::prefix('testPerm')->group(['middleware'=>['permission:']]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('applicant.home');

Route::get('/user-dashboard', [App\Http\Controllers\ApplicantController::class, 'index'])->name('default.applicant.dashboard');

Route::post('/send-test-email', [SystemSettingController::class, 'sendTestEmail'])->name('send-configuration-test-email');

// route to fetch logo image
Route::get('custom-fetch-logo-storage/{filename}', [SystemSettingController::class, 'fetchLogo'])->name('fetchLogo');

// route to fetch favicon image
Route::get('custom-fetch-favicon-storage/{filename}', [SystemSettingController::class, 'fetchFavicon'])->name('fetchFavicon');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('profile', 'ProfileController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('notifications', 'NotificationController');
});

// user bursary
Route::prefix('user-bursary')->middleware(['auth'])->group(function () {
    Route::get('history/{id}', [App\Http\Controllers\BursaryController::class, 'history'])->name('user.bursary.history');
    Route::get('apply', [App\Http\Controllers\BursaryController::class, 'create'])->name('user.bursary.create.form');
    Route::post('save', [App\Http\Controllers\BursaryController::class, 'store'])->name('user.bursary.store');
    // select dependent
    Route::get('/fetch-constituencies/{county}', [App\Http\Controllers\BursaryController::class, 'fetchConstituencies']);
    Route::get('/fetch-wards/{constituency}', [App\Http\Controllers\BursaryController::class, 'fetchWards']);
    Route::get('/fetch-locations/{ward}', [App\Http\Controllers\BursaryController::class, 'fetchLocations']);
    Route::get('/fetch-sub-locations/{location}', [App\Http\Controllers\BursaryController::class, 'fetchSubLocations']);
    Route::get('/fetch-polling-stations/{subLocation}', [App\Http\Controllers\BursaryController::class, 'fetchPollingStations']);
});


// bursary application, approved applications and rejected applications( for admin and staffs only)
Route::middleware(['auth'])
    ->group(function () {
        // BursaryController
        Route::resource('bursary', 'BursaryController');
        Route::get('approved-applications', [App\Http\Controllers\BursaryController::class, 'approvedApplications'])->name('approved.applications');
        Route::get('rejected-applications', [App\Http\Controllers\BursaryController::class, 'rejectedApplications'])->name('rejected.applications');

        Route::post('/update-bursary-approved-status', 'BursaryController@updateApprovedBursaryStatus')->name('bursary.updateApprovedStatus'); // approved
        Route::post('/update-bursary-rejected-status', 'BursaryController@updateRejectedBursaryStatus')->name('bursary.updateRejectedStatus'); // rejected

        //  applying multiple approval or rejection
        Route::post('/multi_approve_or_reject', [App\Http\Controllers\BursaryController::class, 'multiApproveOrReject'])->name('bulk.actions');

        // downloading attachments
        Route::get('/download/{filename}', 'BursaryController@downloadAttachment')->name('download.attachment');
    });

Route::prefix('admin')->middleware(['auth'])->group(
    function () {
        // AdminController
        Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
        Route::get('list', [App\Http\Controllers\AdminController::class, 'list'])->name('admin.list');

        // PermissionController
        Route::resource('permission', 'PermissionController');

        // RoleController
        Route::resource('role', 'RoleController');

        // UserController
        Route::resource('user', 'UserController');

        // Bursary Controller on edit, update and destroy methods
        Route::get('/bursary/{id}/edit', 'BursaryController@edit')->name('admin.edit.bursary');
        Route::put('/bursary/{id}', 'BursaryController@update')->name('admin.update.bursary');
        Route::delete('/bursary/{id}', 'BursaryController@destroy')->name('admin.destroy.bursary');

        // StaffController
        Route::resource('staff', 'StaffController');

        Route::get('staff-user-view-approved-tasks/{id}', [App\Http\Controllers\StaffController::class, 'viewUserApprovedTasks'])->name('staff.view.approved.applications');
        Route::get('staff-user-view-rejected-tasks/{id}', [App\Http\Controllers\StaffController::class, 'viewUserRejectedTasks'])->name('staff.view.rejected.applications');

        // application periods
        Route::resource('application-period', 'ApplicationPeriodController');

        // CountyController
        Route::resource('county', 'CountyController');

        // ConstituencyController
        Route::resource('constituency', 'ConstituencyController');
        Route::get('county-constituency/create-multiple', [App\Http\Controllers\ConstituencyController::class, 'createMultiple'])->name('constituency.create.multiple');

        // WardController
        Route::resource('ward', 'WardController');
        Route::get('county-ward/create-multiple', [App\Http\Controllers\WardController::class, 'createMultiple'])->name('ward.create.multiple');

        // LocationController
        Route::resource('location', 'LocationController');
        Route::get('locations/create-multiple', [App\Http\Controllers\LocationController::class, 'createMultiple'])->name('location.create.multiple');

        // SubLocationController
        Route::resource('sub-location', 'SubLocationController');
        Route::get('sub-locations/create-multiple', [App\Http\Controllers\SubLocationController::class, 'createMultiple'])->name('sub-location.create.multiple');

        // PollingStationController
        Route::resource('polling-station', 'PollingStationController');
        Route::get('polling-stations/create-multiple', [App\Http\Controllers\PollingStationController::class, 'createMultiple'])->name('polling-station.create.multiple');

        // system settings
        Route::resource('system-setting', 'SystemSettingController');
        Route::post('system-setting-save', [App\Http\Controllers\SystemSettingController::class, 'systemSettingsFields'])->name('settings.update.fields');
    }
);

Route::prefix('staff')->middleware(['auth', 'permission:approve bursary'])->group(function () {
    Route::get('dashboard', [StaffController::class, 'index'])->name('staff.home');
});
