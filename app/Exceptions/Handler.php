<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register(){
        $this->renderable(function(Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    private function handleException($request, Exception $exception){
        $accept = request()->header('Accept');
        if($accept == 'application/json'){
            switch (true) {
                case $exception instanceof NotFoundHttpException:
                    return response( ['error' => ['message' => 'not found'] ] ,Response::HTTP_NOT_FOUND );
                case $exception instanceof MethodNotAllowedHttpException:
                    return response( ['error' => ['message' => 'Unsupport Method'] ] ,Response::HTTP_METHOD_NOT_ALLOWED );
                default:
                    return response( ['error' => ['message' => 'Unknown Error'] ] ,Response::HTTP_FAILED_DEPENDENCY );
            }
        }else{
            switch (true) {
                case $exception instanceof NotFoundHttpException:
                    return;
                default:
                    return response( view('errors.default') ,Response::HTTP_INTERNAL_SERVER_ERROR );
            }
        }

        return null;
    }
}