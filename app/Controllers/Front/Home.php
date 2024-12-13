<?php

namespace App\Controllers\Front;

use App\Models\MKuliner;
use App\Models\MPost;

class Home extends BaseController
{
    public function index(): string
    {
        $topKuliner = (new MKuliner())->getKuliner(limit: 10);
        $topPost = (new MPost())->getPost(limit: 4);
        $allKuliner = (new MKuliner())->findAll();
        
        $allKulinerCoordinates = array_map(function ($item) {
            return [
                $item['latitude'],
                $item['longitude'],
                $item['nama_kuliner'],
            ];
        }, $allKuliner);

        return view('home', compact('topKuliner', 'topPost', 'allKulinerCoordinates'));
    }
}
