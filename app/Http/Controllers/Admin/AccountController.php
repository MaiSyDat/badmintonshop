<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function __construct() {}

    public function index(Request $request)
    {
        return view('admin.account.index');
    }

    public function create(Request $request)
    {
        return view('admin.account.create');
    }
}
