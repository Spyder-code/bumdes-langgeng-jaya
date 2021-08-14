<?php

namespace App\Http\Middleware;

use App\Checkout;
use Closure;
use Illuminate\Support\Facades\DB;
use DateTime;

class AccessLog
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

        $ip = $request->getClientIp();
        $data = Checkout::where('ip',$ip);
        $total = $data->count();
        if($total==0){
            DB::table('access_logs')->insert([
                'path' => $request->path(),
                'ip' => $request->getClientIp(),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ]);
        }
        $response = $next($request);

        return $response;
    }
}
