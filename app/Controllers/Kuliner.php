<?php

namespace App\Controllers;

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
