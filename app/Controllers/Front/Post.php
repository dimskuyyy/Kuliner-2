<?php

namespace App\Controllers\Front;

class Post extends BaseController
{
    public function index(): string
    {
        return view('post/index');
    }

    public function detail(): string
    {
        return view('post/detail');
    }
}
