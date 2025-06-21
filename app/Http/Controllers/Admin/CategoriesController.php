<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    //
    public function __construct() {}

    public function index(Request $request)
    {
        $query = Category::withCount('products');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('category_name', 'like', "%{$search}%")
                    ->orWhere('category_slug', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('is_active', $request->status);
        }

        $categories = $query->paginate(10)->withQueryString();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'category_name' => $validatedData['category_name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Danh mục đã được tạo thành công.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name,' . $category->category_id . ',category_id',
            'description' => 'nullable|string|max:500',
        ]);

        // Cập nhật dữ liệu cho danh mục
        $category->update([
            'category_name' => $validatedData['category_name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Category $category)
    {
        if (method_exists($category, 'products') && $category->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa danh mục này vì đang có sản phẩm thuộc danh mục.'
            ]);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa quyền thành công!');
    }
}
