<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; // Import Role Model để lấy danh sách role
use App\Http\Requests\StoreUserRequest; // Import Form Request của bạn
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Để tạo UUID
use Illuminate\Support\Facades\Storage; // Để lưu trữ file
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy tất cả người dùng, có phân trang, và eager load role để tránh N+1 query
        $users = User::with('role')
            ->when($request->search, function ($query, $search) {
                $query->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
            })
            ->when($request->status, function ($query, $status) {
                // Giả sử 'is_active' là boolean: 1 cho hoạt động, 0 cho không hoạt động
                // Cần điều chỉnh logic này tùy thuộc vào cách bạn lưu trạng thái
                if ($status === 'active') {
                    $query->where('is_active', 1);
                } elseif ($status === 'inactive') {
                    $query->where('is_active', 0);
                }
                // Nếu có trạng thái 'pending' thì cần cột riêng hoặc logic khác
            })
            ->when($request->role_id, function ($query, $role_id) {
                $query->where('role_id', $role_id);
            })
            ->orderBy('created_at', 'desc') // Sắp xếp theo ngày tạo mới nhất
            ->paginate(10); // Phân trang 10 người dùng mỗi trang

        // Lấy danh sách các vai trò để đổ vào dropdown filter (tùy chọn)
        $roles = Role::all();
        return view('admin.account.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all(); // Lấy tất cả các vai trò từ database
        return view('admin.account.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) // <-- SỬ DỤNG STOREUSERREQUEST
    {
        // Dữ liệu đã được validate tự động bởi StoreUserRequest
        $data = $request->validated();

        // Xử lý upload avatar
        // $avatarPath = null;
        // if ($request->hasFile('avatar')) {
        //     $avatarFile = $request->file('avatar');
        //     // Tạo tên file duy nhất
        //     $fileName = time() . '_' . Str::random(10) . '.' . $avatarFile->getClientOriginalExtension();
        //     // Lưu trữ vào thư mục 'public/avatars'
        //     $avatarPath = $avatarFile->storeAs('avatars', $fileName, 'public'); // 'public' disk
        // }

        // Tạo người dùng mới
        $user = User::create([
            'user_id' => Str::uuid(), // Tự động tạo UUID
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'full_name' => $data['full_name'] ?? null,
            'phone_number' => $data['phone_number'] ?? null,
            'address' => $data['address'] ?? null,
            'role_id' => $data['role_id'],
            'is_active' => $data['is_active'],
            // 'avatar' => $avatarPath, // Lưu đường dẫn avatar
        ]);

        return redirect()->route('admin.account.index')->with('success', 'Thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::where('user_id', $id)->firstOrFail();
        // dd($user->user_id); // Dừng thực thi và hiển thị giá trị
        return view('admin.account.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->firstOrFail();

        $rules = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->user_id, 'user_id')
            ],
            'full_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'role_id' => 'required|string|exists:roles,role_id',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['password_confirmation'] = 'required|string|min:8';
        } else {
            $request->offsetUnset('password_confirmation');
        }

        $validatedData = $request->validate($rules);

        $user->email = $validatedData['email'];
        $user->full_name = $validatedData['full_name'];
        $user->phone_number = $validatedData['phone_number'];
        $user->role_id = $validatedData['role_id'];
        $user->address = $validatedData['address'];
        $user->is_active = $request->boolean('is_active');

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('admin.account.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();

        if (auth()->check() && auth()->user()->user_id === $user->user_id) {
            return redirect()->back()->with('error', 'Bạn không thể tự xóa tài khoản của mình.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return redirect()->back()->with('success', 'Người dùng đã được xóa thành công.');
    }
}
