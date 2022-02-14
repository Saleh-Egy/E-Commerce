<?php

namespace App\Exceptions;

use App\Events\ExceptionFired;
use App\Models\Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    public function render($request, Throwable $e)
    {
        try {
            Exception::create([
                'file' => $e->getFile(),
                'url' => $request->getPathInfo(),
                'message' =>  $e->getMessage(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
                'user_ip' =>$request->server('REMOTE_ADDR'),
                'data' => $request->all(),
            ]);
        } catch (\Exception $ex) {
            return parent::render($request, $e);
        }
        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
