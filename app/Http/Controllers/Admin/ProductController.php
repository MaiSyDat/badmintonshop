<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductExtend;
use App\Models\ProductImage;

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

        return view('admin.product.index', compact('products', 'categories', 'brands'));
    }


    public function create()
    {
        $brands = Brand::select('brand_id', 'brand_name')->get();
        $categories = Category::select('category_id', 'category_name')->get();

        return view('admin.product.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'product_name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'base_price' => 'required|numeric',
            'brand_id' => 'required|uuid',
            'category_id' => 'required|uuid',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'detail_imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            // Biến thể (product_extend)
            'sku' => 'required|string|max:100|unique:product_extend,sku',
            'color' => 'required|string|max:100',
            'weight_WU' => 'required|string|max:100',
            'length' => 'required|string|max:100',
            'grip_size_G' => 'required|string|max:100',
            'lbs' => 'required|string|max:100',
            'material' => 'required|string|max:100',
            'balance' => 'required|string|max:100',
            'stiffness' => 'required|string|max:100',
            'discount' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            // Xử lý ảnh đại diện (main image)
            $mainImageUrl = null;
            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $mainImageUrl = 'assets/img/product/' . $imageName;
                $image->move(public_path('assets/img/product'), $imageName);
            }

            // Tạo product_id dạng UUID
            $productId = Str::uuid();

            // Tạo sản phẩm
            $product = Product::create([
                'product_id' => $productId,
                'product_name' => $request->product_name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'base_price' => $request->base_price,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'main_image_url' => $mainImageUrl,
                'is_active' => true,
            ]);

            // Tạo biến thể sản phẩm (product_extend)
            DB::table('product_extend')->insert([
                'product_id' => $productId,
                'sku' => $request->sku,
                'color' => $request->color,
                'weight_WU' => $request->weight_WU,
                'length' => $request->length,
                'grip_size_G' => $request->grip_size_G,
                'lbs' => $request->lbs,
                'material' => $request->material,
                'balance' => $request->balance,
                'stiffness' => $request->stiffness,
                'discount' => $request->discount ?? 0,
                'quantity' => $request->quantity ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Xử lý ảnh chi tiết (product_images)
            if ($request->hasFile('detail_imgs')) {
                foreach ($request->file('detail_imgs') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'assets/img/product_detail/' . $imageName;
                    $image->move(public_path('assets/img/product_detail'), $imageName);

                    DB::table('product_images')->insert([
                        'id' => Str::uuid(),
                        'product_id' => $productId,
                        'name' => $imageName,
                        'path' => $imagePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi lưu sản phẩm: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'product' => $product,
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();

        $request->validate([
            'product_name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'base_price' => 'required|numeric',
            'brand_id' => 'required|uuid',
            'category_id' => 'required|uuid',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'detail_imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sku' => 'required|string|max:100|unique:product_extend,sku,' . $id . ',product_id',
            'color' => 'required|string|max:100',
            'weight_WU' => 'required|string|max:100',
            'length' => 'required|string|max:100',
            'grip_size_G' => 'required|string|max:100',
            'lbs' => 'required|string|max:100',
            'material' => 'required|string|max:100',
            'balance' => 'required|string|max:100',
            'stiffness' => 'required|string|max:100',
            'discount' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $mainImageUrl = 'assets/img/product/' . $imageName;
                $image->move(public_path('assets/img/product'), $imageName);

                if ($product->main_image_url && file_exists(public_path($product->main_image_url))) {
                    unlink(public_path($product->main_image_url));
                }

                $product->main_image_url = $mainImageUrl;
            }

            $product->update([
                'product_name' => $request->product_name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'base_price' => $request->base_price,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'is_active' => $request->is_active ?? true,
            ]);

            DB::table('product_extend')->where('product_id', $product->product_id)->update([
                'sku' => $request->sku,
                'color' => $request->color,
                'weight_WU' => $request->weight_WU,
                'length' => $request->length,
                'grip_size_G' => $request->grip_size_G,
                'lbs' => $request->lbs,
                'material' => $request->material,
                'balance' => $request->balance,
                'stiffness' => $request->stiffness,
                'discount' => $request->discount ?? 0,
                'quantity' => $request->quantity ?? 0,
                'updated_at' => now(),
            ]);

            if ($request->hasFile('detail_imgs')) {
                $oldImages = DB::table('product_images')->where('product_id', $product->product_id)->get();
                foreach ($oldImages as $img) {
                    if ($img->path && file_exists(public_path($img->path))) {
                        unlink(public_path($img->path));
                    }
                }
                DB::table('product_images')->where('product_id', $product->product_id)->delete();

                foreach ($request->file('detail_imgs') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'assets/img/product_detail/' . $imageName;
                    $image->move(public_path('assets/img/product_detail'), $imageName);

                    DB::table('product_images')->insert([
                        'id' => Str::uuid(),
                        'product_id' => $product->product_id,
                        'name' => $imageName,
                        'path' => $imagePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm.');
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();

        $product = Product::with(['product_extend', 'images'])->where('product_id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
        }

        // Xóa ảnh đại diện
        if ($product->main_image_url && file_exists(public_path($product->main_image_url))) {
            unlink(public_path($product->main_image_url));
        }

        // Xóa ảnh chi tiết
        foreach ($product->images as $image) {
            if ($image->path && file_exists(public_path($image->path))) {
                unlink(public_path($image->path));
            }
        }

        // Xóa dữ liệu liên quan
        DB::table('product_extend')->where('product_id', $id)->delete();
        DB::table('product_images')->where('product_id', $id)->delete();

        // Xóa sản phẩm chính
        $product->delete();

        DB::commit();

        return redirect()->route('admin.product.index')->with('success', 'Đã xóa sản phẩm thành công!');
    }
}
