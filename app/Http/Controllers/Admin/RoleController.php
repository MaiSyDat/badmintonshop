<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10); // Lấy tất cả roles và phân trang
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.roles.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'role_name' => 'required|string|max:255|unique:roles,role_name', // Tên role phải duy nhất
    //         'description' => 'nullable|string|max:500',
    //     ]);

    //     Role::create($validatedData);

    //     return redirect()->route('admin.roles.index')->with('success', 'Thêm quyền mới thành công!');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
