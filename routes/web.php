<?php

use App\Http\Controllers\ComicController;
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

Route::get('/', [IndexController::class, "index"])->name('index');

Route::get('/signin', [WebController::class, "SignIn"])->name('sign_in');
Route::get("/signup", [WebController::class, "SignUp"])->name('sign_up');
Route::get("/forgot", [WebController::class, "Forgot"])->name('forgot');

Route::post('/login_verify', [LoginController::class, "Verify"])->name("login_verify");
Route::post("/signup_insert", [LoginController::class, "Insert"])->name("signup_insert");

Route::get('/auth/google', [GoogleController::class, "Redirect"])->name("google-auth");
Route::get("/auth/google/call-back", [GoogleController::class, "CallbackGoogle"]);

Route::middleware("checkLogin")->group(function () {

    // profile
    Route::get('/profile', [UserController::class, "profile"])->name('profile');
    Route::get('/profile/novel', [UserController::class, 'novelInfoPage'])->name('profile.novel');
    Route::get('/profile/comic', [UserController::class, 'comicInfoPage'])->name('profile.comic');

    Route::get('/profile/{username}', [UserController::class, 'editInfoPage']);
    Route::post('/editInfo', [UserController::class, 'edit_info'])->name('edit.info');

    Route::get('/createPassword', [UserController::class, 'viewCreatePassword'])->name('create.password.page');
    Route::post('/create_password', [UserController::class, 'create_password'])->name('create.password');
    Route::get('/changePassword', [UserController::class, 'viewChangePassword'])->name('change.password.page');
    Route::post('/change_password', [UserController::class, 'change_password'])->name('change.password');
    //

    Route::get('/signout', [LoginController::class, 'Logout'])->name('sign_out');

    Route::prefix("create_novel")->group(function () {
        Route::get("/", [NovelController::class, "Page"])->name("create_novel");
        Route::post("insert", [NovelController::class, "insertNewNovel"])->name("novel.insert");
    });

    Route::prefix("create_comic")->group(function () {
        Route::get("/", [ComicController::class, "page"])->name("create_comic");
        Route::post("insert", [ComicController::class, "insertNewComic"])->name("comic.insert");
    });

    Route::middleware("checkOwner")->group(function () {

        Route::prefix("edit_novel")->group(function () {
            Route::get("{bookID}", [NovelController::class, 'Edit'])->name("novel.edit");
            Route::post("insert/{bookID}", [NovelController::class, "EditInsert"])->name("novel.edit_insert");
            Route::post('chapter/update/{bookID}/{chapterID}', [NovelController::class, 'ChapterStatusUpdate'])->name('novel.chapter_status_update')->middleware(['checkChapterOwner']);
        });

        Route::prefix("add_chapter")->group(function () {
            Route::get("{bookID}", [NovelController::class, "AddChapter"])->name("novel.add_chapter");
            Route::post("insert/{bookID}", [NovelController::class, "InsertNewChapter"])->name("novel.new_chapter");
        });


        Route::prefix('edit_chapter')->group(function () {
            Route::get('{bookID}/{chapterID}', [NovelController::class, "EditChapter"])->name('novel.edit_chapter')->middleware(['checkChapterOwner']);
            Route::post('update/{bookID}/{chapterID}', [NovelController::class, 'EditChapterUpdate'])->name('novel.chapter_update')->middleware(['checkChapterOwner']);
        });
    });

    Route::middleware("checkComicOwner")->group(function(){
        Route::prefix("edit_comic")->group(function () {
            Route::get("{bookID}", [ComicController::class, 'edit'])->name("comic.edit");
            Route::post("insert/{bookID}", [ComicController::class, "EditInsert"])->name("comic.edit_insert");
            Route::post('chapter/update/{bookID}/{chapterID}', [ComicController::class, 'ChapterStatusUpdate'])->name('comic.chapter_status_update')->middleware(['checkChapterOwner']);
        });

        Route::prefix("add_comic_chapter")->group(function () {
            Route::get("{bookID}", [ComicController::class, "AddChapter"])->name("comic.add_comic_chapter");
            Route::post("insert/{bookID}", [ComicController::class, "InsertNewChapter"])->name("comic.new_chapter");
        });

        Route::prefix('edit_comic_chapter')->group(function () {
            Route::get('{bookID}/{chapterID}', [ComicController::class, "EditChapter"])->name('comic.edit_comic_chapter')->middleware(['checkChapterOwner']);
            Route::post('update/{bookID}/{chapterID}', [ComicController::class, 'EditChapterUpdate'])->name('comic.chapter_update')->middleware(['checkChapterOwner']);
        });
    });

    Route::post('/comments', [ReadController::class, 'comment_insert'])->name('comment.insert');
});

Route::prefix("admin")->group(function () {
    Route::middleware("checkAdminLogin")->group(function () {
        Route::get("index", [AdminController::class, 'Index'])->name("admin.index");
        Route::get("signout", [AdminController::class, 'SignOut'])->name("admin.signout");
        Route::get("Home_admin", [AdminController::class, "Home"])->name("Home_admin");
    });

    Route::get("login", [AdminController::class, 'Login'])->name("admin.login");
    Route::post("login/verify", [AdminController::class, 'VerifyLogin'])->name("admin.login_verify");
});


// Route::get("/mail",function(){
//     Mail::to('auttzeza@gmail.com')
//         ->Send(new Hellomail());
// });
Route::get('/forgot_password', [ForgotPasswordController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot_password', [ForgotPasswordController::class, 'password'])->name('forgot.password.post');
Route::get('/reset_password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset_password');
Route::post('/reset_password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset_password.post');

Route::get("/rec1", [IndexController::class, 'rec1'])->name("index.rec1");
Route::get("/rec2",[IndexController::class,"rec2"])->name("index.rec2");
Route::get("/read_novel/{bookID}", [ReadController::class, "read"])->name("read.read_novel");
Route::get("/read_chapt/{bookID}/{chapterID}", [ReadController::class, "readnovel_chapt"])->name("read.read_chapt");
Route::get('/read_first_chapt/{bookID}', [ReadController::class, 'readFirstChapter'])->name('read.read_first_chapt');



Route::get("/test", function () {
    return view('user.test');
});
