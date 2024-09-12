<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WriterController;
use App\Mail\Hellomail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\SendGridHandler;

Route::get('/', function () {
    return view('user.index');
})->name('index');

Route::get('/signin',[WebController::class,"sign_in"])->name('sign_in');
Route::get("/signup",[WebController::class,"sign_up"])->name('sign_up');
Route::get("/forgot",[WebController::class,"forgot"])->name('forgot');

Route::get('/profile',[UserController::class,"profile"])->name('profile');
Route::post('/update_profile', [UserController::class, 'update'])->name('update.profile');

Route::post('/login_verify',[LoginController::class,"verify"])->name("login_verify");
Route::post("/signup_insert",[LoginController::class,"insert"])->name("signup_insert");
Route::get('/signout',[LoginController::class,'logout'])->name('sign_out');

Route::get('/auth/google',[GoogleController::class,"redirect"])->name("google-auth");
Route::get("/auth/google/call-back",[GoogleController::class,"callbackGoogle"]);

Route::get("/create_novel",[NovelController::class,"page"])->name("create_novel");
Route::post("/create_novel/insert",[NovelController::class,"insertNewNovel"])->name("novel.insert");

Route::get("/mail",function(){
    Mail::to('auttzeza@gmail.com')
        ->Send(new Hellomail());
});
Route::get('/forgot_password',[ForgotPasswordController::class,'forgot'])->name('forgot.password');
Route::post('/forgot_password',[ForgotPasswordController::class,'password'])->name('forgot.password.post');
Route::get('/reset_password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('reset_password');
Route::post('/reset_password',[ForgotPasswordController::class,'resetPasswordPost'])->name('reset_password.post');

