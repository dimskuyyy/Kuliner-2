<?php

namespace App\Controllers\Back;

use App\Models\MGaleri;
use App\Models\MMembership;
use App\Models\MKuliner;

class Galeri extends BaseController
{
    protected $modelGaleri;
    protected $cache;

    public function __construct()
    {
        $this->modelGaleri = new MGaleri();
        $this->cache = \Config\Services::cache();
    }
    public function index()
    {
        $member = (new MMembership())->where('user_id',AuthUser()->id)->where('member_status',2)->where('member_deleted_at',null)->limit(1)->get()->getRowArray();
        $kuliner = (new MKuliner())->where('member_id',$member['member_id'])->get()->getRowArray();
        $galeri = $this->modelGaleri->getDataKuliner($kuliner['kuliner_id']);
        // dd($galeri);
        return view('dashboard/galeri/index', [
            'galeri' => $galeri,
            'kuliner' => $kuliner 
        ]);
    }
    public function edit()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');
            if (!empty($id)) {
                $data = $this->modelGaleri
                    ->getListGaleri($id);
                if ($data != null) {
                    $result = jsonFormat(true, 'Data berhasil ditemukan', $data);
                } else {
                    $result = jsonFormat(false, 'Galeri tidak ditemukan !');
                }
            } else {
                $result = jsonFormat(false, 'Silahkan pilih data');
            }
            return $this->response->setJSON($result);
        }
    }
    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;

            $data = [
                'judul' => $req->getVar('judul'),
                'kuliner_id' => $req->getVar('kuliner_id'),
                'media_id' => $req->getVar('media')
            ];
            if ($id != null ? $this->modelGaleri->update($id, $data) : $this->modelGaleri->insert($data)) {
                $this->cache->delete('Galeri');
                $result = jsonFormat(true, 'Galeri berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->modelGaleri->errors());
            }
            return $this->response->setJSON($result);
        }
    }
    public function delete()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');
            if ($this->modelGaleri->delete($id)) {
                $this->cache->delete('Galeri');
                $result = jsonFormat(true, 'Galeri berhasil dihapus');
            } else {
                $result = jsonFormat(false, 'Galeri gagal dihapus');
            }
            return $this->response->setJSON($result);
        }
    }
}
