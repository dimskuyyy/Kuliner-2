<?php

namespace App\Controllers\Front;

use App\Enums\TipeKuliner;
use App\Models\Kuliner as ModelsKuliner;
use App\Models\MKuliner;
use App\Models\MPost;

class Kuliner extends BaseController
{
    public function index($kategori = TipeKuliner::SEMUA->value): string
    {
        // $kulinerModel = new MKuliner();
        // dd($kulinerModel->getPostKuliner('sanama_coffee_&_space')->getResult());
        $kulinerModel = new MKuliner();
        $dataKuliner = $kulinerModel->getKuliner(TipeKuliner::tryFrom($kategori));
        // dd($dataKuliner);
        return view('front/kuliner/index', compact('dataKuliner', 'kategori'));
    }

    public function kategori($kategori) {
        $kulinerModel = new MKuliner();
        $dataKuliner = $kulinerModel->getKuliner(TipeKuliner::tryFrom($kategori));
        // dd($dataKuliner);
        return view('front/kuliner/index', compact('dataKuliner'));
    }

    public function detail(): string
    {
        return view('front/kuliner/detail');
    }
}
