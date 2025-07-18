<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Hiển thị form thông tin cá nhân.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.profile', compact('user'));
    }

    /**
     * Cập nhật thông tin cá nhân.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'username'     => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'full_name'    => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:500',
        ]);

        $user->fill($validated);
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Thông tin đã được cập nhật.');
    }

    /**
     * Xóa tài khoản người dùng.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Tài khoản đã bị xóa.');
    }
}
