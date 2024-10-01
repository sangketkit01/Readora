<?php

use App\Http\Controllers\ComicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, "index"])->name('index');

Route::get('/signin', [WebController::class, "SignIn"])->name('sign_in');
Route::get("/signup", [WebController::class, "SignUp"])->name('sign_up');
Route::get("/forgot", [WebController::class, "Forgot"])->name('forgot');

Route::post('/login_verify', [LoginController::class, "Verify"])->name("login_verify");
Route::post("/signup_insert", [LoginController::class, "Insert"])->name("signup_insert");

Route::get('/auth/google', [GoogleController::class, "Redirect"])->name("google-auth");
Route::get("/auth/google/call-back", [GoogleController::class, "CallbackGoogle"]);

Route::get("/auth/facebook", [FacebookController::class, "Redirect"])->name("facebook-auth");
Route::get("/auth/facebook/call-back", [FacebookController::class, "CallbackFacebook"]);

Route::middleware("checkLogin")->group(function () {

    Route::get('/signout', [LoginController::class, 'Logout'])->name('sign_out');
    // profile
    Route::prefix("profile")->group(function () {
        Route::get('/', [UserController::class, "profile"])->name('profile');
        Route::get('novel', [UserController::class, 'novelInfoPage'])->name('profile.novel');
        Route::get('comic', [UserController::class, 'comicInfoPage'])->name('profile.comic');
        Route::get("bookshelf", [UserController::class, 'BookShelfPage'])->name("profile.bookshelf");
        Route::get('edit', [UserController::class, 'editInfoPage']);
    });

    Route::post('/editInfo', [UserController::class, 'edit_info'])->name('edit.info');

    Route::get('/createPassword', [UserController::class, 'viewCreatePassword'])->name('create.password.page');
    Route::post('/create_password', [UserController::class, 'create_password'])->name('create.password');

    Route::get('/changePassword', [UserController::class, 'viewChangePassword'])->name('change.password.page');
    Route::post('/change_password', [UserController::class, 'change_password'])->name('change.password');


    Route::prefix("user")->group(function(){
        Route::get('bin/{bookTypeID}',[UserController::class,"Trash"])->name("user.bin");
        Route::post("restore/all/{bookTypeID}",[UserController::class,"RestoreAll"])->name("user.restore_all");
        Route::post("restore/each/{bookTypeID}/{bookID}",[UserController::class,"RestoreEach"])->name("user.restore_each");
        Route::post("delete/all/{bookTypeID}",[UserController::class,"DeleteAll"])->name("user.delete_all");
        Route::post("delete/each/{bookTypeID}/{bookID}", [UserController::class, "DeleteEach"])->name("user.delete_each");

    });
    //

    Route::prefix("create_novel")->group(function () {
        Route::get("/", [NovelController::class, "Page"])->name("create_novel");
        Route::post("insert", [NovelController::class, "insertNewNovel"])->name("novel.insert");
    });

    Route::prefix("create_comic")->group(function () {
        Route::get("/", [ComicController::class, "page"])->name("create_comic"); 
        Route::post("insert", [ComicController::class, "insertNewComic"])->name("comic.insert"); 
    });

    Route::middleware("checkNovelOwner")->group(function () {

        Route::prefix("edit_novel")->group(function () {
            Route::get("{bookID}", [NovelController::class, 'Edit'])->name("novel.edit");
            Route::post("insert/{bookID}", [NovelController::class, "EditInsert"])->name("novel.edit_insert");
            Route::post('chapter/update/{bookID}/{chapterID}', [NovelController::class, 'ChapterStatusUpdate'])->name('novel.chapter_status_update')->middleware(['checkChapterOwner']);

            Route::get("/{bookID}/trash",[NovelController::class,"Trash"])->name("novel.trash")->middleware(["checkBookBlock"]);
        });

        Route::prefix("delete_novel")->group(function () {
            Route::post("{bookID}", [NovelController::class, "Delete"])->name("novel.delete");
            Route::post("chapter/{bookID}/{chapterID}", [NovelController::class, "DeleteChapter"])->name("novel.delete_chapter")->middleware(["checkChapterOwner"]);
        });

        Route::middleware("checkBookBlock")->group(function(){

            Route::prefix("restore")->group(function(){
                Route::post("all/{bookID}",[NovelController::class,"RestoreAll"])->name("novel.restore_all");
                Route::post("each/{bookID}/{chapterID}",[NovelController::class,"RestoreEach"])->name("novel.restore_each")->middleware(["checkChapterOwner"]);
            });

            Route::prefix("force/delete")->group(function () {
                Route::post("novel/all/{bookID}",[NovelController::class,"ForceDeleteAll"])->name("novel.force-delete-all");
                Route::post("novel/each/{bookID}/{chapterID}", [NovelController::class, "ForceDeleteEach"])->name("novel.force-delete-each")->middleware(["checkChapterOwner"]);
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


    });

    Route::middleware("checkComicOwner")->group(function () {
        Route::prefix("edit_comic")->group(function () { 
            Route::get("{bookID}", [ComicController::class, 'edit'])->name("comic.edit");
            Route::post("insert/{bookID}", [ComicController::class, "EditInsert"])->name("comic.edit_insert"); 
            Route::post('chapter/update/{bookID}/{chapterID}', [ComicController::class, 'ChapterStatusUpdate'])->name('comic.chapter_status_update')->middleware(['checkChapterOwner']);
            Route::get("/{bookID}/trash", [ComicController::class, "Trash"])->name("comic.trash")->middleware(["checkBookBlock"]);;
        });

        Route::prefix("delete_comic")->group(function () {
            Route::post("{bookID}", [ComicController::class, "Delete"])->name("comic.delete");
            Route::post("chapter/{bookID}/{chapterID}", [ComicController::class, "DeleteChapter"])->name("comic.delete_chapter")->middleware(["checkChapterOwner"]);
        });

        Route::middleware("checkBookBlock")->group(function(){

            Route::prefix("restore")->group(function () {
                Route::post("comic/each/{bookID}/{chapterID}", [ComicController::class, "RestoreEach"])->name("comic.restore_each")->middleware(["checkChapterOwner"]);
            });

            Route::prefix("force/delete")->group(function(){
                Route::post("comic/each/{bookID}/{chapterID}",[ComicController::class,"ForceDeleteEach"])->name("comic.force-delete-each")->middleware(["checkChapterOwner"]);
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

    });

    Route::get("/read_novel/{bookID}", [ReadController::class, "read_novel"])->name("read.read_novel");
    Route::get("/read_chaptnovel/{bookID}/{chapterID}", [ReadController::class, "readnovel_chapt"])->name("read.read_chaptnovel");
    Route::get('/read_first_chaptNovel/{bookID}', [ReadController::class, 'readFirstChapterNovel'])->name('read.read_first_chaptnovel');
    Route::post("/commentnovel/{bookID}/{chapterID}", [ReadController::class, 'comment_novel']);

    Route::get("/read_comic/{bookID}", [ReadController::class, "read_comic"])->name("read.read_comic");
    Route::get("/read_chaptcomic/{bookID}/{chapterID}", [ReadController::class, "readcomic_chapt"])->name("read.read_chaptcomic");
    Route::get('/read_first_chaptComic/{bookID}', [ReadController::class, 'readFirstChapterComic'])->name('read.read_first_chaptcomic');
    Route::post("/commentcomic/{bookID}/{chapterID}", [ReadController::class, 'comment_comic']);

    Route::post('/report/submit', [ReadController::class, 'submitReport'])->name('report.submit');
    Route::post('/comments/{$chapterID}', [ReadController::class, 'comment_insert'])->name('comment.insert');

    Route::get("/book_shelve_commic", [IndexController::class, "book_shelve_commic"])->name("index.book_shelve_commic");
    Route::get('/book_shelve', [IndexController::class, 'book_shelve'])->name('index.book_shelve');
    Route::post('/add-to-shelf', [ReadController::class, 'addToShelf'])->name('add_to_shelf');

    Route::get('/increment-click-and-redirect-novel/{bookID}', [ReadController::class, 'incrementClickAndRedirect'])->name('novel.incrementAndRedirect');
    Route::get('/increment-click-and-redirect-comic/{bookID}', [ReadController::class, 'incrementClickAndRedirectComic'])->name('novel.incrementAndRedirectcomic');
});

Route::prefix("admin")->group(function () {
    Route::middleware("checkAdminLogin")->group(function () {
        Route::get("index", [AdminController::class, 'Index'])->name("admin.index");
        Route::get("signout", [AdminController::class, 'SignOut'])->name("admin.signout");

        Route::get('checkreport', [AdminController::class, 'Checkreport'])->name('admin.checkreport');
        Route::get('book_detail/{bookID}', [AdminController::class, 'book_detail'])->name('admin.book_detail');
        Route::post('books/block/{bookID}', [AdminController::class, 'block'])->name('book.block');
        Route::post('books/unblock/{bookID}', [AdminController::class, 'unblock'])->name('book.unblock');
        Route::get('admin/blockedbooks', [AdminController::class, 'viewBlockedBooks'])->name('admin.blocked_books');
        Route::post('admin/unblockbook/{bookID}', [AdminController::class, 'unblockBook'])->name('admin.unblock_book');
        Route::get('admin/blockedcomic', [AdminController::class, 'viewBlockedComic'])->name('admin.blocked_comic');

        Route::get("Home_admin", [AdminController::class, "Home"])->name("Home_admin"); 

        Route::get('searchadmin', [SearchController::class, 'searchAdmin'])->name('admin.search_admin');
        Route::get('searchadmincomic', [SearchController::class, 'searchAdmincomic'])->name('admin.search_admincomic');
        Route::get('searchUserAdmin', [SearchController::class, 'searchAdminUser'])->name('admin.search_user'); 
        Route::get('searchUser', [SearchController::class, 'searchUser'])->name('admin.get_info_search'); 

        Route::post('admin.delete_user', [AdminController::class, 'adminDeleteUser'])->name('admin.delete_user'); 

        Route::get('admin/deleted-users', [AdminController::class, 'deletedUsers'])->name('admin.deleted_users');
        Route::post('admin.restore_user', [AdminController::class, 'adminRestoreUser'])->name('admin.restore_user'); 

    });

    Route::get("login", [AdminController::class, 'Login'])->name("admin.login");
    Route::post("login/verify", [AdminController::class, 'VerifyLogin'])->name("admin.login_verify");
});

Route::get('/forgot_password', [ForgotPasswordController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot_password', [ForgotPasswordController::class, 'password'])->name('forgot.password.post');
Route::get('/reset_password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset_password');
Route::post('/reset_password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset_password.post');

Route::get("/rec1", [IndexController::class, 'rec1'])->name("index.rec1");
Route::get("/rec2", [IndexController::class, "rec2"])->name("index.rec2");


Route::get("/test", function () {
    return view('user.test');
});

Route::get('/search', [SearchController::class, 'search'])->name('search'); 
Route::get("/genre/{genreID}", [IndexController::class, 'Genre'])->name('genre.newpage'); 