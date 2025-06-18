<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use App\Models\VariantAttributeValue;
use App\Models\ProductVariantAttributeMap;
use App\Models\Brand;    // Thêm các models cần thiết
use App\Models\Category; // Thêm các models cần thiết

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'brand', 'variants'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('product_name', 'like', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->brand_id, function ($query) use ($request) {
                $query->where('brand_id', $request->brand_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();
        $brands = Brand::all();
        $variantAttributes = VariantAttribute::all();

        return view('admin.product.index', compact('products', 'categories', 'brands', 'variantAttributes'));
    }


    public function create()
    {
        $brands = \App\Models\Brand::select('brand_id', 'brand_name')->get();
        $categories = \App\Models\Category::select('category_id', 'category_name')->get();
        $attributes = \App\Models\VariantAttribute::with('values')->get();

        return view('admin.product.create', compact('brands', 'categories', 'attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'base_price' => 'required|numeric',
            'brand_id' => 'required|uuid',
            'category_id' => 'required|uuid',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'variants' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            // Lưu ảnh đại diện sản phẩm
            $imagePath = null;
            if ($request->hasFile('main_image')) {
                $imagePath = $request->file('main_image')->store('assets/img/product', 'public');
            }

            // Tạo sản phẩm
            $product = Product::create([
                'product_id' => Str::uuid(),
                'product_name' => $request->product_name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'base_price' => $request->base_price,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'main_image_url' => $imagePath,
                'is_active' => true,
            ]);

            // Lặp qua các biến thể
            foreach ($request->variants as $index => $variantData) {
                // Lưu ảnh biến thể (nếu có)
                $variantImage = null;
                if ($request->hasFile("variants.$index.variant_image")) {
                    $variantImage = $request->file("variants.$index.variant_image")->store('assets/img/product', 'public');
                }

                // Tạo biến thể
                $variant = ProductVariant::create([
                    'variant_id' => Str::uuid(),
                    'product_id' => $product->product_id,
                    'sku' => $variantData['sku'],
                    'additional_price' => -1 * abs($variantData['discount_price']), // Giảm giá
                    'stock_quantity' => $variantData['stock_quantity'],
                    'variant_image_url' => $variantImage,
                    'is_available' => true,
                ]);

                // Ánh xạ thuộc tính
                if (!empty($variantData['attributes'])) {
                    foreach ($variantData['attributes'] as $value_id) {
                        ProductVariantAttributeMap::create([
                            'map_id' => Str::uuid(),
                            'variant_id' => $variant->variant_id,
                            'value_id' => $value_id,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Lỗi khi lưu sản phẩm: ' . $e->getMessage()]);
        }
    }
}
