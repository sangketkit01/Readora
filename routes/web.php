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

Route::get('/signin',[WebController::class,"SignIn"])->name('sign_in');
Route::get("/signup",[WebController::class,"SignUp"])->name('sign_up');
Route::get("/forgot",[WebController::class,"Forgot"])->name('forgot');

Route::post('/login_verify',[LoginController::class,"Verify"])->name("login_verify");
Route::post("/signup_insert",[LoginController::class,"Insert"])->name("signup_insert");

Route::get('/auth/google',[GoogleController::class,"Redirect"])->name("google-auth");
Route::get("/auth/google/call-back",[GoogleController::class,"CallbackGoogle"]);

Route::middleware("checkLogin")->group(function(){
    Route::get('/profile', [UserController::class, "profile"])->name('profile');
    Route::post('/update_info', [UserController::class, 'update_info'])->name('update_info');
    Route::get('/create_password_page', [UserController::class, 'callView'])->name('create.password.page');
    Route::post('/create_password', [UserController::class, 'create_password'])->name('create.password');
    Route::get('/change_password_page', [UserController::class, 'callView2'])->name('change.password.page');
    Route::post('/change_password', [UserController::class, 'create_password'])->name('change.password');

    Route::get('/signout', [LoginController::class, 'Logout'])->name('sign_out');

    Route::prefix("create_novel")->group(function () {
        Route::get("/", [NovelController::class, "Page"])->name("create_novel");
        Route::post("insert", [NovelController::class, "insertNewNovel"])->name("novel.insert");
    });

    Route::middleware("checkOwner")->group(function(){
        
        Route::prefix("edit_novel")->group(function () {
            Route::get("{novelID}", [NovelController::class, 'Edit'])->name("novel.edit");
            Route::post("insert/{novelID}", [NovelController::class, "EditInsert"])->name("novel.edit_insert");
            Route::post('chapter/update/{novelID}/{chapterID}', [NovelController::class, 'ChapterStatusUpdate'])->name('novel.chapter_status_update')->middleware(['checkChapterOwner']);
        });
    
        Route::prefix("add_chapter")->group(function(){
            Route::get("{novelID}", [NovelController::class, "AddChapter"])->name("novel.add_chapter");
            Route::post("insert/{novelID}", [NovelController::class, "InsertNewChapter"])->name("novel.new_chapter");
        });
    

        Route::prefix('edit_chapter')->group(function(){
            Route::get('{novelID}/{chapterID}', [NovelController::class, "EditChapter"])->name('novel.edit_chapter')->middleware(['checkChapterOwner']);
            Route::post('update/{novelID}/{chapterID}', [NovelController::class, 'EditChapterUpdate'])->name('novel.chapter_update')->middleware(['checkChapterOwner']);
        });
    });
});

Route::prefix("admin")->group(function(){
    Route::middleware("checkAdminLogin")->group(function(){
        Route::get("index", [AdminController::class, 'Index'])->name("admin.index");
        Route::get("signout",[AdminController::class,'SignOut'])->name("admin.signout");
        Route::get("Home_admin", [AdminController::class, "Home"])->name("Home_admin");

    });
    
    Route::get("login",[AdminController::class,'Login'])->name("admin.login");
    Route::post("login/verify",[AdminController::class,'VerifyLogin'])->name("admin.login_verify");
});


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
Route::get("/read_novel/{novelID}", [ReadController::class, "read_novel"])->name("index.read");


Route::get("/test", function () {
    return view('user.test');
});



