<?php


use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ChapterOwner;
use App\Http\Middleware\OwnerComicMiddleware;
use App\Http\Middleware\OwnerNovelMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'checkLogin' => UserMiddleware::class,
            'checkNovelOwner' => OwnerNovelMiddleware::class,
            'checkAdminLogin' => AdminMiddleware::class,
            'checkChapterOwner' => ChapterOwner::class,
            'checkComicOwner' => OwnerComicMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
