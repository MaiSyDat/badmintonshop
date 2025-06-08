<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct() {}

    public function index(Request $request)
    {
        return view('admin.categories.index');
    }

    public function create() {}

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
