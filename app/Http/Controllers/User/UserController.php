<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $config = $this->config();
        return view('user.master_latout.main', compact('config'));
    }

    private function config()
    {
        return [
            'js' => [
                '../assets/js/component/nav.js',
                '../assets/js/component/slider.js',
                '../assets/js/page/home.js',
            ]
        ];
    }
}
