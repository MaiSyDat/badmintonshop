<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; // <-- Thêm dòng này để import Role model
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException; // Thêm dòng này để xử lý ValidationException

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $customerRole = Role::where('role_name', 'Customer')->first();

        if (!$customerRole) {
            // Xử lý trường hợp không tìm thấy vai trò 'Customer'
            // Điều này có thể xảy ra nếu seeder chưa chạy hoặc tên role bị sai
            return redirect()->back()->with('error', 'Lỗi hệ thống: Không tìm thấy vai trò Customer. Vui lòng liên hệ quản trị viên.');
        }

        // Tạo người dùng mới
        $user = User::create([
            'username' => $request->name, // Sử dụng 'name' làm username
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->name, // Cũng có thể gán 'name' cho full_name
            'phone_number' => null, // Có thể thêm vào form nếu muốn
            'address' => null,     // Có thể thêm vào form nếu muốn
            'role_id' => $customerRole->role_id, // Gán role_id của Customer
            'is_active' => true, // Mặc định là active
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }
}
