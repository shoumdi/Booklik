<?php

use App\Shared\Utils\Helper;
use Core\FailureJsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
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
         $exceptions->render(function (HttpException $e) {
            $errors = Helper::getErrorLable($e->getStatusCode());
            return FailureJsonResponse::make(
                [$errors['label'] => $e->getMessage()],
                $e->getStatusCode(),
                $errors['message']
            );
        });
        $exceptions->render(function (ExpiredTokenException $e) {
            return response()->json(
                data: [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                status: 401
            );
        });
        $exceptions->render(
            function (InvalidTokenException $e) {
                return response()->json(
                    data: [
                        'success' => false,
                        'error' => $e->getMessage()
                    ],
                    status: 401
                );
            }
        );
        $exceptions->render(
            function (InvalidCredentialsException $e) {
                return FailureJsonResponse::make(
                    status: 401,
                    message: $e->getMessage(),
                    errors: $e->errors()
                );
            }
        );
        $exceptions->render(
            function (DomainException $e) {
                return response()->json(
                    data: [
                        'success' => false,
                        'error' => $e->getMessage()
                    ],
                    status: 422
                );
            }
        );
       
    })->create();
