<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password; // Import this

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Kiểm tra quyền: Chỉ Admin mới được thêm tài khoản
        // Auth::user()->isAdmin() là helper method nếu bạn đã thêm vào User model
        // Hoặc bạn có thể dùng Auth::user()->role && Auth::user()->role->role_name === 'Admin'
        return auth()->check() && auth()->user()->isAdmin(); // Hoặc logic phân quyền của bạn
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'role_id' => ['required', 'exists:roles,role_id'], // Đảm bảo role_id tồn tại trong bảng roles
            'address' => ['nullable', 'string', 'max:500'],
            'password' => [
                'required',
                'confirmed',
                Password::min(6)
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Tối đa 2MB
            'is_active' => ['boolean'], // check box
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Tên đăng nhập không được để trống.',
            'username.unique' => 'Tên đăng nhập này đã tồn tại.',
            'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự.',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'email.max' => 'Email không được vượt quá :max ký tự.',

            'role_id.required' => 'Vui lòng chọn chức vụ cho người dùng.',
            'role_id.exists' => 'Chức vụ được chọn không hợp lệ.',

            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            'avatar.image' => 'File tải lên phải là hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải thuộc định dạng JPEG, PNG, JPG, GIF.',
            'avatar.max' => 'Kích thước ảnh đại diện không được vượt quá 2MB.',
        ];
    }

    // Nếu bạn muốn xử lý dữ liệu trước khi validate, ví dụ set default cho checkbox
    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active'), // Nếu checkbox có tồn tại trong request thì là true, ngược lại là false
        ]);
    }
}
