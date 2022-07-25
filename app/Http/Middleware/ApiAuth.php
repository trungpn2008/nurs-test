<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            if ($user->status == 0) {
                return response()->json([
                    'data' => [],
                    'msg' => 'Tài khoản chưa được active',
                    'success' => false,
                    'code' => 401,
                ], 401);
            }
            if($user->verify == 0){
                return response()->json([
                    'data' => [],
                    'msg' => 'Tài khoản chưa được verify',
                    'success' => false,
                    'code' => 401,
                ], 401);
            }
            if($user->ban == 1){
                return response()->json([
                    'data' => [],
                    'msg' => 'Tài khoản Đã bị ban',
                    'success' => false,
                    'code' => 401,
                ], 401);
            }
        } else {
            return response()->json([
                'data' => [],
                'msg' => 'Phiên đăng nhập hết hạn!',
                'success' => false,
                'code' => 401,
            ], 401);
        }
        return $next($request);
    }
}
