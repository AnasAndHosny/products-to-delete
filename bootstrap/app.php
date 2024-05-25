<?php

use App\Http\Responses\Response;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \App\Http\Middleware\Localization::class, //change locale language for api routes
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // handle NotAuthorized exceptions from api requests and send JsonResponse
        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return Response::Error([], __('messages.notAuthorized'), 403);
            }
        });

        // handle route model binding exceptions from api requests and send JsonResponse
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*') && ($e->getPrevious() instanceof ModelNotFoundException)) {
                switch ($e->getPrevious()->getModel()) {
                    case User::class:
                        $class = 'user';
                        break;

                    case Category::class: case SubCategory::class:
                        $class = 'category';
                        break;

                    default:
                        $class = 'record';
                        break;
                }
                return Response::Error([], __('messages.notFound', ['class' => __($class)]), 404);
            }
        });
    })->create();
