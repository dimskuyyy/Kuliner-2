<?php

namespace App\Controllers\Front;

use App\Enums\TipeKuliner;
use App\Models\Kuliner as ModelsKuliner;
use App\Models\MKuliner;
use App\Models\MMedia;
use App\Models\MPost;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;

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

    public function kategori($kategori)
    {
        $kulinerModel = new MKuliner();
        $dataKuliner = $kulinerModel->getKuliner(TipeKuliner::tryFrom($kategori));
        // dd($dataKuliner);
        return view('front/kuliner/index', compact('dataKuliner'));
    }

    public function detail($slug)
    {
        $kulinerModel = new MKuliner();
        $detailKuliner = $kulinerModel->getDetailKuliner($slug)->getFirstRow();

        if (!$detailKuliner) throw new PageNotFoundException('Kuliner tidak ditemukan.');

        $dataPostKuliner = $kulinerModel->getPostKuliner($detailKuliner->slug_kuliner);
        $dataGaleriKuliner = $kulinerModel->getGaleriKuliner($detailKuliner->slug_kuliner);
        $dataMenuKuliner = $kulinerModel->getMenuKuliner($detailKuliner->slug_kuliner);

        return view('front/kuliner/detail', compact('detailKuliner', 'dataPostKuliner', 'dataGaleriKuliner', 'dataMenuKuliner'));
    }

    public function newPost($slug)
    {
        $kulinerModel = new MKuliner();
        $detailKuliner = $kulinerModel->getDetailKuliner($slug)->getFirstRow();

        if (!$detailKuliner) throw new PageNotFoundException('Kuliner tidak ditemukan.');

        return view('front/kuliner/post', compact('detailKuliner', 'slug'));
    }

    private function validationRuleMedia($id)
    {
        $validationRules = [
            'judul' => 'required',
            'konten' => 'required',
            'media' => [
                'uploaded[media]',
                'mime_in[media,image/jpg,image/jpeg,image/png,image/webp]',
                'max_size[media,5120]'
            ]
        ];
        // jika add data tambahkan validation uploaded
        if ($id == null) {
            $validationRules['media'][] = 'uploaded[media]';
        }
        return $validationRules;
    }

    private function mediaUpload($req, $id)
    {
        if (!$req->getFile('media')->isValid()) {
            $filePath = $req->getVar('oldMedia');
        } else {
            // pindahkan file
            $filePath = $req->getFile('media')->store('media');
            // hapus file lama
            if ($id != null) {
                if (file_exists(WRITEPATH . 'uploads/' . $req->getVar('oldMedia'))) {
                    unlink(WRITEPATH . 'uploads/' . $req->getVar('oldMedia'));
                }
            }
        }
        return $filePath;
    }

    private function generateSlug($req, $id)
    {
        if ($id != null) {
            $slug = $req->getVar('oldSlug');
        } else {
            $slug = url_title(Time::now()
                ->format('Y-m-d') . ' ' . time() . rand(0, 100) . ' ' .
                $req->getVar('judul'), '-', true);
        }

        return $slug;
    }

    public function storePost($slug)
    {
        $kulinerModel = new MKuliner();
        $detailKuliner = $kulinerModel->getDetailKuliner($slug)->getFirstRow();

        if (!$detailKuliner) return $this->response->setJSON(['message' => jsonFormat(false, 'Kuliner tidak ditemukan.'), 'data' => null, 'id' => null]);;

        $req = $this->request;
        $mediaModel = new MMedia();
        $postModel = new MPost();
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            // Buat aturan validasi untuk file
            $validationRules = $this->validationRuleMedia($id);
            if ($id != null) {
                $find = $mediaModel->find($id);
                if (empty($find['media_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Media tidak ditemukan');
                    return $this->response->setJSON(['message' => $result, 'data' => null, 'id' => null]);
                }
                if (($find['media_created_by'] != AuthUser()->id)) {
                    $result = jsonFormat(false, 'Anda tidak memiliki izin untuk mengedit media ini');
                    return
                        $this->response->setJSON(['message' => $result, 'data' => null, 'id' => null]);
                }
            }
            // Jalankan validasi
            if (!$this->validate($validationRules)) {
                $data = null;
                $insertedID =  null;
                $result = jsonFormat(false, $this->validator->getErrors());
            } else {
                // lakukan proses upload media
                $filePath = $this->mediaUpload($req, $id);
                $mediaFile = $req->getFile('media');
                $mediaType =  $mediaFile->getClientMimeType();
                // cek apakah data update
                $mediaName = $req->getVar('judul');
                $slug = $this->generateSlug($req, $id);
                $data = [
                    'media_nama' => $mediaName,
                    'media_path' => $filePath,
                    'media_slug' => $slug,
                    'media_type' => $mediaType,
                    'media_user_id' => AuthUser()->id
                ];
                // cek apakah data update / create, save data
                if ($id != null ? $mediaModel->update($id, $data) : $mediaModel->insert($data)) {
                    // Mendapatkan ID dari data yang baru saja dimasukkan
                    $insertedID = $mediaModel->insertID();

                    // Create post
                    $konten = $req->getVar('konten');
                    $slugPost = $this->generateSlug($req, $id);
                    $data = [
                        'judul' => $mediaName,
                        'slug_post' => $slugPost,
                        'konten' => $konten,
                        'user_id' => AuthUser()->id,
                        'media_id' => $insertedID,
                        'kuliner_id' => $detailKuliner->kuliner_id,
                    ];

                    if ($postModel->insert($data)) $result = jsonFormat(true, 'Media berhasil disimpan');
                    else $result = jsonFormat(false, $postModel->errors());
                } else {
                    $result = jsonFormat(false, $mediaModel->errors());
                }
            }
            return $this->response->setJSON(['message' => $result, 'data' => $data, 'id' => $postModel->getInsertID()]);
        }
    }
}
