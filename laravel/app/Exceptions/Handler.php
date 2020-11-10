<?php

namespace App\Exceptions;

use Throwable;
use App\Utils\ResultHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    use ResultHelper;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * 401 未授权(UnauthorizedHttpException) 转化为Api返回格式
     * @param  Request  $request
     * @param  Throwable  $exception
     * @return Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json($this->failed(401, "未授权登录，请先登录", ["reload" => true]));
        }

        return parent::render($request, $exception);
    }
}
