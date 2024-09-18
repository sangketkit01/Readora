<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReadController;
use App\Mail\Hellomail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,"index"])->name('index');

Route::get('/signin',[WebController::class,"sign_in"])->name('sign_in');
Route::get("/signup",[WebController::class,"sign_up"])->name('sign_up');
Route::get("/forgot",[WebController::class,"forgot"])->name('forgot');

Route::post('/login_verify',[LoginController::class,"verify"])->name("login_verify");
Route::post("/signup_insert",[LoginController::class,"insert"])->name("signup_insert");

Route::get('/auth/google',[GoogleController::class,"redirect"])->name("google-auth");
Route::get("/auth/google/call-back",[GoogleController::class,"callbackGoogle"]);

Route::middleware("checkLogin")->group(function(){
    Route::get('/profile', [UserController::class, "profile"])->name('profile');
    Route::post('/update_info', [UserController::class, 'update_info'])->name('update_info');
    Route::get('/create_password_page', [UserController::class, 'callView'])->name('create.password.page');
    Route::post('/create_password', [UserController::class, 'create_password'])->name('create.password');
    Route::get('/change_password_page', [UserController::class, 'callView2'])->name('change.password.page');
    Route::post('/change_password', [UserController::class, 'create_password'])->name('change.password');

    Route::get('/signout', [LoginController::class, 'logout'])->name('sign_out');

    Route::get("/create_novel", [NovelController::class, "page"])->name("create_novel");
    Route::get("/edit_novel/{bookID}", [NovelController::class, 'edit'])->name("novel.edit")->middleware(["checkOwner"]);
    Route::get("/add_chapter/{bookID}", [NovelController::class, "AddChapter"])->name("novel.add_chapter")->middleware(["checkOwner"]);
    Route::post("/create_novel/insert", [NovelController::class, "insertNewNovel"])->name("novel.insert");
    Route::post("/edit_novel/insert/{bookID}",[NovelController::class,"edit_insert"])->name("novel.edit_insert")->middleware(["checkOwner"]);
    Route::post("/add_chapter/insert/{bookID}", [NovelController::class, "InsertNewChapter"])->name("novel.new_chapter")->middleware(["checkOwner"]);

    Route::get('/edit_chapter/{bookID}/{chapterID}',[NovelController::class,"EditChapter"])->name('novel.edit_chapter')->middleware(['checkOwner','checkChapterOwner']);
    Route::post('/edit_chapter/update/{bookID}/{chapterID}',[NovelController::class,'EditChapterUpdate'])->name('novel.chapter_update')->middleware(['checkOwner', 'checkChapterOwner']);
});

Route::middleware("checkAdminLogin")->group(function(){
    Route::get("/admin/index", [AdminController::class, 'Index'])->name("admin.index");
    Route::get("/admin/signout",[AdminController::class,'SignOut'])->name("admin.signout");
});

Route::get("/admin/login",[AdminController::class,'Login'])->name("admin.login");
Route::post("/admin/login/verify",[AdminController::class,'VerifyLogin'])->name("admin.login_verify");

Route::get("/mail",function(){
    Mail::to('auttzeza@gmail.com')
        ->Send(new Hellomail());
});
Route::get('/forgot_password',[ForgotPasswordController::class,'forgot'])->name('forgot.password');
Route::post('/forgot_password',[ForgotPasswordController::class,'password'])->name('forgot.password.post');
Route::get('/reset_password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('reset_password');
Route::post('/reset_password',[ForgotPasswordController::class,'resetPasswordPost'])->name('reset_password.post');

Route::get("/rec1", [IndexController::class, 'rec1'])->name("index.rec1");
Route::get("/rec2",[IndexController::class,"rec2"])->name("index.rec2");
Route::get("/read_novel/{bookID}", [ReadController::class, "read_novel"])->name("index.read");


Route::get("/Home_admin",[AdminController::class,"Home"])->name("Home_admin");



