<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
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
    return view('auth.login');
});

Route::get('/defined-error', function () {
    return view('errors.403');
});

Route::get('/test', function () {
    return view('test');
});


Auth::routes();

// Route::prefix('testPerm')->group(['middleware'=>['permission:']]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('applicant.home');

// Multistep Form Controller
Route::prefix('multi-step')->middleware(['auth'])->group( function () {
    Route::resource('form', 'MultiStepFormController');

});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('profile', 'ProfileController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('notifications', 'NotificationController');
});

// user bursary
Route::prefix('user-bursary')->middleware(['auth'])->group(function () {
    Route::get('history/{id}', [App\Http\Controllers\BursaryController::class, 'history'])->name('user.bursary.history');
    Route::get('create', [App\Http\Controllers\BursaryController::class, 'create'])->name('user.bursary.create.form');
    Route::post('save', [App\Http\Controllers\BursaryController::class, 'store'])->name('user.bursary.store');
});


// bursary application, approved applications and rejected applications( for admin and staffs only)
Route::middleware(['auth', 'staffAuth'])
    ->group(function () {
        // BursaryController
        Route::resource('bursary', 'BursaryController');
        Route::get('approved-applications', [App\Http\Controllers\BursaryController::class, 'approvedApplications'])->name('approved.applications');
        Route::get('rejected-applications', [App\Http\Controllers\BursaryController::class, 'rejectedApplications'])->name('rejected.applications');
        Route::get('bursary/{id}/show', [App\Http\Controllers\BursaryController::class, 'showToAttendees'])->name('bursary.show.to.attendees');
});


Route::prefix('admin')->middleware(['auth', 'adminAuth'])->group(
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

        // StaffController
        Route::resource('staff', 'StaffController');
        Route::get('staff-users', [App\Http\Controllers\StaffController::class, 'staffUsersList'])->name('staff_users.list');
        Route::get('staff-users/create', [App\Http\Controllers\StaffController::class, 'staffUsersCreate'])->name('admin/staff_users/create');
        Route::post('staff-users/save', [App\Http\Controllers\StaffController::class, 'staffUsersStore'])->name('admin/staff_users/save');
        Route::get('staff-users/{id}', [App\Http\Controllers\StaffController::class, 'showStaffUser'])->name('staff.users.show');
        Route::post('staff-user-edit/{id}', [App\Http\Controllers\StaffController::class, 'editStaffUser'])->name('staff.users.edit');
        Route::put('staff-user-update/{id}', [App\Http\Controllers\StaffController::class, 'updateStaffUser'])->name('staff.users.update');
        Route::put('staff-user-delete/{id}', [App\Http\Controllers\StaffController::class, 'deleteStaffUser'])->name('staff.users.delete');

        // system settings
        Route::get('system-settings', [App\Http\Controllers\AdminController::class, 'systemSettings'])->name('system.settings');
    }
);


// Route::prefix('staff')->group(
//     function () {
//         Route::get('dashboard', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.home')->middleware('staffAuth');
//     }
// );

Route::prefix('staff')->middleware(['auth', 'permission:approve bursary'])->group(function () {
    Route::get('dashboard', [StaffController::class, 'index'])->name('staff.home');
});

Route::prefix('school')->group(
    function () {
        Route::get('dashboard', [SchoolController::class, 'index'])->name('school.home');
    }
);
