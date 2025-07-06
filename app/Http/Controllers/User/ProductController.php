<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller

{
    //
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Filter theo brand
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Filter theo category
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        $priceFilters = $request->input('price_filters', []);

        if (!empty($priceFilters)) {
            $query->where(function ($q) use ($priceFilters) {
                if (in_array('price1', $priceFilters)) {
                    $q->orWhere('base_price', '<', 1000000);
                }
                if (in_array('price2', $priceFilters)) {
                    $q->orWhereBetween('base_price', [1000000, 2000000]);
                }
                if (in_array('price3', $priceFilters)) {
                    $q->orWhereBetween('base_price', [2000000, 3000000]);
                }
                if (in_array('price4', $priceFilters)) {
                    $q->orWhere('base_price', '>', 3000000);
                }
            });
        }

        $sortBy = $request->input('sort_by');

        if ($sortBy === 'price_asc') {
            $query->orderBy('base_price', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $query->orderBy('base_price', 'desc');
        } else {
            $query->latest();
        }


        $products = $query->paginate(6);

        $categories = Category::all();
        $brands = Brand::all();

        return view('user.page.product', compact('products', 'categories', 'brands'));
    }

    public function ajaxFilter(Request $request)
    {
        $query = Product::where('is_active', true);

        // Filter theo brand
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Filter theo category
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Filter theo price
        $priceFilters = $request->input('price_filters', []);
        if (!empty($priceFilters)) {
            $query->where(function ($q) use ($priceFilters) {
                if (in_array('price1', $priceFilters)) {
                    $q->orWhere('base_price', '<', 1000000);
                }
                if (in_array('price2', $priceFilters)) {
                    $q->orWhereBetween('base_price', [1000000, 2000000]);
                }
                if (in_array('price3', $priceFilters)) {
                    $q->orWhereBetween('base_price', [2000000, 3000000]);
                }
                if (in_array('price4', $priceFilters)) {
                    $q->orWhere('base_price', '>', 3000000);
                }
            });
        }

        // Sắp xếp
        $sortBy = $request->input('sort_by');
        if ($sortBy === 'price_asc') {
            $query->orderBy('base_price', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $query->orderBy('base_price', 'desc');
        } else {
            $query->latest();
        }

        // Phân trang
        $products = $query->paginate(12);

        // Trả về partial view chứa danh sách sản phẩm
        return view('user.page.product_list', compact('products'))->render();
    }
}
