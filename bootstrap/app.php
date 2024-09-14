<?php

<<<<<<< HEAD
=======
use App\Http\Middleware\AdminMiddleware;
>>>>>>> 64ea1f8f7e1ca74d6774e15585d40fd1c6e7eed8
use App\Http\Middleware\OwnerBookMiddleware;
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
            'checkOwner' => OwnerBookMiddleware::class,
<<<<<<< HEAD
=======
            'checkAdminLogin' => AdminMiddleware::class,
>>>>>>> 64ea1f8f7e1ca74d6774e15585d40fd1c6e7eed8
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
