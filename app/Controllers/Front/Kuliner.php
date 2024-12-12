<?php

namespace App\Controllers\Front;

class Kuliner extends BaseController
{
    public function index(): string
    {
        return view('kuliner/index');
    }

    public function detail(): string
    {
        return view('kuliner/detail');
    }
}
