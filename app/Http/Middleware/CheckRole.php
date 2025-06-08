<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Kiểm tra xem người dùng có vai trò không và vai trò của họ có nằm trong danh sách được phép không
        // role_name trong database là 'Admin', 'Staff', 'Customer'
        if ($user->role && in_array(strtolower($user->role->role_name), array_map('strtolower', $roles))) {
            return $next($request);
        }
        return redirect('home')->with('error', 'Bạn không có quyền truy cập trang này.');
    }
}
