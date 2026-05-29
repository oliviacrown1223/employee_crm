<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {

            Route::middleware('web')
                ->group(base_path('routes/superadmin.php'))
                ->group(base_path('routes/employee.php'))
                ->group(base_path('routes/manager.php'))
                ->group(base_path('routes/hr.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // PREVENT BACK CACHE
        $middleware->web(append: [

            \App\Http\Middleware\PreventBackHistory::class,

        ]);

        // MIDDLEWARE ALIAS
        $middleware->alias([

            'role' => RoleMiddleware::class,

            'permission' => PermissionMiddleware::class,

            'role_or_permission' => RoleOrPermissionMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

