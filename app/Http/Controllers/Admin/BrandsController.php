<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand; // Đảm bảo import Brand model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

use function Whoops\Example\bar;

class BrandsController extends Controller
{
    // Không cần hàm __construct rỗng

    /**
     * Hiển thị danh sách các thương hiệu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Sử dụng eager load count cho products nếu quan hệ tồn tại và cần hiển thị số sản phẩm
        // Nếu không có bảng products hoặc không muốn hiển thị số lượng, bỏ .withCount('products')
        $query = Brand::query();

        // Search (chỉ tìm theo brand_name vì brand_slug không có trong migration hiện tại)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('brand_name', 'like', "%{$search}%");
        }

        // is_active không có trong migration hiện tại, bỏ qua filter này
        // if ($request->has('status') && in_array($request->status, ['0', '1'])) {
        //     $query->where('is_active', $request->status);
        // }

        $brands = $query->paginate(10)->withQueryString();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Hiển thị form tạo thương hiệu mới.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Lưu thương hiệu mới vào database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
                // Tạo thư mục với quyền 0755 (hoặc 0775 nếu cần) và recursive
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        // Sẽ tạo view 'admin.brands.edit' sau
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Brand $brand)
    {
        // Kiểm tra xem thương hiệu có sản phẩm liên quan không (nếu có quan hệ products)
        if (method_exists($brand, 'products') && $brand->products()->exists()) {
            return back()->with('error', 'Không thể xóa vì đang có sản phẩm thuộc thương hiệu này!');
        }

        // Xóa logo thương hiệu khỏi thư mục public/assets/img/brand
        if ($brand->brand_logo_url && file_exists(public_path($brand->brand_logo_url))) {
            unlink(public_path($brand->brand_logo_url)); // Xóa file vật lý
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Xóa thương thành công!');
    }
}
