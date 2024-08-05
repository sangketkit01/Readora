<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('all.index');
})->name('index');

Route::get('/signin',[WebController::class,"sign_in"])->name('sign_in');
Route::get("/signup",[WebController::class,"sign_up"])->name('sign_up');
Route::get("/forgot",[WebController::class,"forgot"])->name('forgot');

Route::get('/novel_list', [NovelController::class, "novel_list"])->name('novel_list');
Route::get('/novel', [NovelController::class, "novel"])->name('novel');
Route::get('/novel_detail/{id}',[NovelController::class,"novel_detail"])->name('novel_detail');

Route::get('/profile',[UserController::class,"profile"])->name('profile');
Route::get('/unfinish',[UserController::class,"unfinish"])->name('unfinish');

Route::get('/writer/create',[WriterController::class,"create"])->name('create');
Route::get("/writer/edit/{id}",[WriterController::class,"edit"])->name('edit');
Route::get("/writer/mynovel",[WriterController::class,"mynovel"])->name("mynovel");
Route::get("/writer/novel_detail/{id}",[WriterController::class,"novel_detail"])->name("writer_novel_detail");
Route::get("/writer/stat",[WriterController::class,"stat"])->name("stat");

Route::post('/login_verify',[LoginController::class,"verify"])->name("login_verify");
Route::post("/signup_insert",[LoginController::class,"insert"])->name("signup_insert");
Route::get('/signout',[LoginController::class,'logout'])->name('sign_out');

Route::get('/auth/google',[GoogleController::class,"redirect"])->name("google-auth");
Route::get("/auth/google/call-back",[GoogleController::class,"callbackGoogle"]);
