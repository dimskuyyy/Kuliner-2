<?php

namespace App\Controllers\Front;

class Home extends BaseController
{
    public function index(): string
    {
        // session()->destroy();
        // var_dump(session('id'));die;
        return view('home');
    }
}
