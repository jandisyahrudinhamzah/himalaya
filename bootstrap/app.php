<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        $middleware->redirectGuestsTo('/login');

        $middleware->redirectUsersTo(function () {
            $role = Auth::user()->role ?? null;

            return match($role) {
                'admin'     => '/admin/dashboard',
                'bendahara' => '/bendahara/dashboard',
                'anggota'   => '/anggota/dashboard',
                default     => '/home',
            };
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();