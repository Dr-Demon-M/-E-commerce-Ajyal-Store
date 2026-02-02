<?php

use App\Http\Middleware\AbilityMiddleware;
use App\Http\Middleware\CheckUserType;
use App\Http\Middleware\MarkNotificationsAsRead;
use App\Http\Middleware\SetAppLocale;
use App\Http\Middleware\UserActiveAt;
use App\Providers\FortifyServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__ . '/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // apiPrefix: 'api/v1',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectTo(
            guests: 'user/login',
            users: function (Request $request) {
                if (Auth::guard('admin')->check() && $request->is('admin*')) {
                    return '/admin/dashboard';
                }
                return '/';
            }
        );
        $middleware->alias([
            'checkUserType'           => CheckUserType::class,
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'ability.auto'            => AbilityMiddleware::class,
        ]);
        $middleware->web([
            UserActiveAt::class, // route in web تشتغل علي طول مع اي 
            MarkNotificationsAsRead::class,
            // SetAppLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
        // استخدم reportable لتنفيذ أكواد عند حدوث خطأ معين (مثل إرسال إيميل أو تسجيل Log مخصص)
        $exceptions->reportable(function (QueryException $e) {
            // تسجيل تفاصيل إضافية
            Log::error('حدث خطأ في قاعدة البيانات بجدول معين', [
                'message' => $e->getMessage(),
                'time' => now()
            ]);
        });

        // إذا كنت تريد منع (Ignore) بعض الأخطاء من التسجيل في الـ Logs تماماً
        // $exceptions->dontReport([
        //     QueryException::class,
        // ]);

        $exceptions->render(function (QueryException $e, $request) {
            return redirect()
                ->back()
                ->withInput() // to retain form input (any data user send before)
                ->withErrors(['database_error' => 'A database error occurred: ' . $e->getMessage()])
                ->with('delete', 'A database error occurred.');
        });
        */
    })->create();
