<?php

namespace App\Http\Middleware;

use App\Models\System\AccessLogModel;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccessLogoAfter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // DEBUG 模式下才会记录GET请求
        if ($request->method() == "GET" && !env("APP_DEBUG")) {
            return $response;
        }

        // 常规模式下记录增，改，删 用作审计记录
        $params = $request->all();
        $data = [
            'method' => $request->method(),
            'path' => $request->getPathInfo(),
            'ip' => $request->ip(),
            'body' => $params ? json_encode($params) : '',
            'agent' => $request->userAgent(),
            'latency' => round(microtime(true) - START, 3),
            'user_id' => (Auth::user())->id ?? '',
            'user_name' => (Auth::user())->username ?? '',
            'resp' => $response->original,
            'status' => ($response->original)['code'] ?? 200,
            'error_message' => ($response->original)['msg'] ?? "未捕获错误信息",
        ];

        DB::beginTransaction();
        try {
            (new AccessLogModel())->fill($data)->save();
            DB::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollback();
        }

        return $response;
    }
}
