<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\AdminAuthUserController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Services\CountryService;
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


Route::get('/storage', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    dd('Done storage');
});

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    dd('Done clear');
});

Route::get('/seed', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed');
    dd('Done seed');
});

Route::get('/migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate');
    dd('Done migrate');
});

//Auth
Route::group(['middleware' => ['guest']], function() {
    Route::get('/', [AuthUserController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthUserController::class, 'postRegistration'])->name('register.post');
    Route::get('login', [AuthUserController::class, 'index'])->name('login');
    Route::post('post-login', [AuthUserController::class, 'postLogin'])->name('login.post');
    Route::get('refresh_captcha', [AuthUserController::class, 'refreshCaptcha'])->name('refresh_captcha');

//Admin
    Route::group(['prefix'=>'admin'], function(){
        Route::get('login', [AdminAuthUserController::class, 'index'])->name('login.admin');
        Route::post('post-login', [AdminAuthUserController::class, 'postLogin'])->name('login.post.admin');
        Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });
});

Route::get('/state/{data?}', [App\Http\Controllers\CountryController::class, 'state'])->name('state');
Route::group(['middleware' => ['auth', 'block.user']], function() {
    Route::post('logout', [AuthUserController::class, 'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/t-o-s-action',[HomeController::class,'TosAction'])->name('tos_action');
    Route::group(['prefix'=>'pages'], function(){
        Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
        Route::get('/chat/{id?}', [App\Http\Controllers\HomeController::class, 'chat'])->name('chat')->middleware('chat.user.access');
        Route::get('/history/chat', [App\Http\Controllers\HomeController::class, 'chatHistory'])->name('chat.history');
        Route::get('/inbox', [App\Http\Controllers\HomeController::class, 'inbox'])->name('inbox');
    });

    Route::get('/online/users', [App\Http\Controllers\HomeController::class, 'onlineUsers'])->name('online.users');
    Route::post('/block/user', [App\Http\Controllers\HomeController::class, 'blockUser'])->name('block.user');
    Route::get('/messages/{id?}', [App\Http\Controllers\HomeController::class, 'messages'])->name('messages');
    Route::post('/messages/all/read', [App\Http\Controllers\HomeController::class, 'messagesAllRead'])->name('messages.all.read');
    Route::post('/message/send', [App\Http\Controllers\HomeController::class, 'messageSend'])->name('message-send');
    Route::post('/report/send', [App\Http\Controllers\HomeController::class, 'reportSend'])->name('report-send');


    Route::group(['middleware' => ['auth.admin'], 'prefix'=>'admin'], function() {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/user/{id?}', [App\Http\Controllers\DashboardController::class, 'user'])->name('dashboard.user');
        Route::post('/change/role', [App\Http\Controllers\DashboardController::class, 'changeRole'])->name('dashboard.change.role');
        Route::post('/block/unblock', [App\Http\Controllers\DashboardController::class, 'blockOrUnblockUser'])->name('dashboard.block-or-unblock');
        Route::get('/report/{id?}', [App\Http\Controllers\DashboardController::class, 'report'])->name('dashboard.report');
        Route::post('/change/setting', [App\Http\Controllers\DashboardController::class, 'changeSetting'])->name('dashboard.change.setting');
        Route::post('/change/params', [App\Http\Controllers\DashboardController::class, 'changeParams'])->name('dashboard.change.params');
        Route::get('/report/remove/{id?}', [App\Http\Controllers\DashboardController::class, 'reportRemove'])->name('dashboard.report.remove');

        /**
         * Profile area
         */
        Route::prefix('profile')->group(function(){
            Route::get('/',[AdminProfileController::class,'Profile'])->name('admin_profile');
            Route::post('/save',[AdminProfileController::class,'Update'])->name('admin_profile_save');
        });

        /**
         * Role And Permission
         */
        Route::prefix('role-permission')->group(function(){
            Route::get('/role',[RolePermissionController::class,'Roles'])->name('admin_roles');
            Route::post('/save',[RolePermissionController::class,'Save'])->name('admin_role_save');
            Route::delete('/delete',[RolePermissionController::class,'Delete'])->name('admin_role_delete');
        });

        /**
         * User
         */
        Route::prefix('users')->group(function(){
            Route::get('/form',[UsersController::class,'form'])->name('admin_user_form');
        });
    });
});
