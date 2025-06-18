<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role; // Đảm bảo import Role model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Để sử dụng Rule::unique

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Role::query();

        // Nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search !== null) {
            $query->where('role_name', 'like', '%' . $request->search . '%');
        }

        $roles = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString(); // Giữ query khi phân trang

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name',
        ]);

        Role::create($validatedData);

        return redirect()->route('admin.roles.index')->with('success', 'Thêm quyền mới thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'role_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'role_name')->ignore($role->role_id, 'role_id'),
            ],
        ]);

        $role->update($validatedData);

        return redirect()->route('admin.roles.index')->with('success', 'Cập nhật quyền thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')->with('error', 'Không thể xóa quyền này vì có người dùng đang sử dụng!');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Xóa quyền thành công!');
    }
}
