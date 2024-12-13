<?php

namespace App\Controllers\Back;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MKuliner;
use App\Models\MMembership;
use App\Models\MGaleri;
use App\Models\MMenu;
use App\Models\MMedia;
use CodeIgniter\I18n\Time;

class Kuliner extends BaseController
{

    protected $kulinerModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->kulinerModel = new MKuliner();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        $member = (new MMembership())->where('user_id', AuthUser()->id)->get()->getRowArray();
        $find = $this->kulinerModel->getDataInput($member['member_id']);
        // var_dump($find);die;
        $tmp = [
            'data'  => $find ? $find : null
        ];
        return view('dashboard/kuliner/form', $tmp);
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->kulinerModel->find($id);
                if (empty($find['kuliner_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Kuliner tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($find['kuliner_created_by'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Kuliner tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $member = (new MMembership())->where('user_id', AuthUser()->id)->get()->getRowArray();

            $slug = $this->generateSlug($req, $id);

            $data = [
                'member_id' => $member['member_id'],
                'media_id'  => $req->getVar('media'),
                'nama_kuliner' => $req->getVar('nama'),
                'slug_kuliner' => $slug,
                'alamat' => $req->getVar('alamat'),
                'deskripsi' => $req->getVar('deskripsi'),
                'latitude' => $req->getVar('latitude'),
                'longitude' => $req->getVar('longitude'),
                'tipe_kuliner' => $req->getVar('tipe'),
            ];

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }
            // var_dump($data);die;
            if ($id != null ? $this->kulinerModel->update($id, $data) : $this->kulinerModel->insert($data)) {
                $result = jsonFormat(true, 'Kuliner berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->kulinerModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }

    private function generateSlug($req, $id)
    {
        // Jika id tidak null, gunakan oldSlug
        if ($id != null) {
            $slug = $req->getVar('oldSlug') ?: ''; // Cegah nilai null atau kosong
        } else {
            // Jika id null, buat slug berdasarkan nama kuliner
            $namaKuliner = $req->getVar('nama') ?: ''; // Jika nama kosong, gunakan string kosong
            if (empty($namaKuliner)) {
                // Jika nama tetap kosong, berikan slug default
                $slug = 'kuliner-' . time(); // Menggunakan waktu sebagai slug default
            } else {
                // Membuat slug dengan url_title, memastikan format yang benar
                $slug = url_title(Time::now()->format('Y-m-d') . ' ' . time() . rand(0, 100) . ' ' . $namaKuliner, '-', true);
            }
        }

        return $slug;
    }
}
