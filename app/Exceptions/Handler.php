<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }



  /*  public function render($request, Throwable $exception)
    {
        // Check if the request is an API request
        if ($request->is('api/*')) {
            // Handle specific exceptions for API responses
            if ($exception instanceof ValidationException) {
                return response()->json(['error' => $exception->getMessage()], 422);
            } elseif ($exception instanceof NotFoundHttpException) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            // Handle other exceptions for API responses
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        return parent::render($request, $exception);
    }*/
}
