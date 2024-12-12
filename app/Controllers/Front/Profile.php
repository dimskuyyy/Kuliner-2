<?php

namespace App\Controllers\Front;

class Profile extends BaseController
{
    public function index(): string
    {
        return view('profile/index');
    }
}
