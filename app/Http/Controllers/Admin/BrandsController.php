<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

use function Whoops\Example\bar;

class BrandsController extends Controller
{

    /**
     * Hiển thị danh sách các thương hiệu.
     */
    public function index(Request $request)
    {
        $query = Brand::query();

        // Search theo brand_name
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('brand_name', 'like', "%{$search}%");
        }

        $brands = $query->paginate(10)->withQueryString();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Hiển thị form tạo thương hiệu mới.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Lưu thương hiệu mới vào database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string|max:100|unique:brands,brand_name',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brandLogoUrl = null;

        if ($request->hasFile('brand_logo')) {
            $logo = $request->file('brand_logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();

            // Đường dẫn tuyệt đối đến thư mục đích trong thư mục 'public' của dự án
            $destinationPath = public_path('assets/img/brand');

            // Đảm bảo thư mục đích tồn tại, nếu không thì tạo nó
            if (!file_exists($destinationPath)) {
                // Tạo thư mục với quyền 0755 và recursive
                mkdir($destinationPath, 0755, true);
            }

            // Di chuyển file đã upload vào thư mục đích
            $logo->move($destinationPath, $logoName);

            // Đường dẫn sẽ lưu vào DB (tương đối từ thư mục 'public')
            $brandLogoUrl = 'assets/img/brand/' . $logoName;
        }

        Brand::create([
            'brand_name' => $validatedData['brand_name'],
            'brand_logo_url' => $brandLogoUrl,
        ]);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Thương hiệu đã được tạo thành công.');
    }


    /**
     * Show the form for editing
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string|max:100|unique:brands,brand_name,' . $brand->brand_id . ',brand_id',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = ['brand_name' => $validatedData['brand_name']];

        if ($request->hasFile('brand_logo')) {
            // Xóa logo cũ nếu có và tồn tại trên đĩa
            if ($brand->brand_logo_url && file_exists(public_path($brand->brand_logo_url))) {
                unlink(public_path($brand->brand_logo_url)); // Xóa file vật lý
            }

            $logo = $request->file('brand_logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $destinationPath = public_path('assets/img/brand');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $logo->move($destinationPath, $logoName);
            $data['brand_logo_url'] = 'assets/img/brand/' . $logoName;
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Thương hiệu đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Không cho phép xóa nếu có sản phẩm liên quan
        if (method_exists($brand, 'products') && $brand->products()->exists()) {
            return back()->with('error', 'Không thể xóa vì đang có sản phẩm thuộc thương hiệu này!');
        }

        // Xóa ảnh logo nếu tồn tại
        if (!empty($brand->brand_logo_url)) {
            $logoPath = public_path($brand->brand_logo_url);
            if (file_exists($logoPath) && is_file($logoPath)) {
                unlink($logoPath);
            }
        }

        // Xóa thương hiệu khỏi DB
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Đã xóa thương hiệu thành công!');
    }
}
