<?php

namespace App\Controllers\Front;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }
}
