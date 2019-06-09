<?php

namespace App\Http\Middleware;

use DB;
use Closure;

class RequestMiddleware
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
        if (in_array(app()->environment(), ["local", "development"])) {
            $this->writeLog($request);
        }
        return $next($request);
    }

    private function writeLog($request)
    {
        $query = collect($request->all())->except("q")->all();
        \Log::debug($request->method(), ["path" => $request->query("q", "/"), "query" => http_build_query($query)]);

        // 商用環境以外だった場合、SQLログを出力する
        DB::listen(function ($query) {
            \Log::debug("Query Time:{$query->time}s] $query->sql");
        });
    }
}
