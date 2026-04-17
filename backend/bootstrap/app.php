<?php

use App\Shared\Utils\Helper;
use App\Shared\Utils\SqlHelper;
use Core\FailureJsonResponse;
use Core\Strings;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use JWT\Exception\ExpiredTokenException;
use JWT\Exception\InvalidCredentialsException;
use JWT\Exception\InvalidTokenException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ValidationException $e) {
            return FailureJsonResponse::make($e->errors(), $e->status, $e->getMessage());
        });
        $exceptions->render(function (HttpException $e) {
            return FailureJsonResponse::make(
                [Helper::getErrorLable($e->getStatusCode()) => $e->getMessage()],
                $e->getStatusCode(),
                $e->getMessage()
            );
        });
        $exceptions->render(function (ExpiredTokenException | InvalidTokenException  $e) {
            return FailureJsonResponse::make($e->getMessage(), 403, $e->getMessage());
        });
        $exceptions->render(
            function (InvalidCredentialsException $e) {
                return FailureJsonResponse::make($e->getMessage(), 422, $e->getMessage());
            }
        );
        $exceptions->render(
            function (DomainException $e) {
                // for logging
                return FailureJsonResponse::make(Strings::$DOMAIN_EXCEPTION, 500, Strings::$DOMAIN_EXCEPTION);
            }
        );
        $exceptions->render(function (QueryException $q) {
            $response =  SqlHelper::response($q->errorInfo[1]);
            return FailureJsonResponse::make(['uknown' => $response['message']], $response['status'], $response['message']);
        });
    })->create();
