<?php

namespace App\Controllers\Back;

use App\Models\MMenu;
use App\Models\MMembership;
use App\Models\MKuliner;

class Menu extends BaseController
{
    protected $menuModel;
    protected $cache;

    public function __construct()
    {
        $this->menuModel = new MMenu();
        $this->cache = \Config\Services::cache();
    }
    public function index()
    {
        $member = (new MMembership())->where('user_id',AuthUser()->id)->where('member_status',2)->where('member_deleted_at',null)->limit(1)->get()->getRowArray();
        $kuliner = (new MKuliner())->where('member_id',$member['member_id'])->get()->getRowArray();
        $menu = $this->menuModel->getDataKuliner($kuliner['kuliner_id']);
        // dd($menu);
        return view('dashboard/menu/index', [
            'menu' => $menu,
            'kuliner' => $kuliner 
        ]);
    }
    public function edit()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');
            if (!empty($id)) {
                $data = $this->menuModel
                    ->getMenuList($id);
                if ($data != null) {
                    $result = jsonFormat(true, 'Data berhasil ditemukan', $data);
                } else {
                    $result = jsonFormat(false, 'Menu tidak ditemukan !');
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
                'nama_menu' => $req->getVar('nama'),
                'deskripsi_menu' => $req->getVar('deskripsi'),
                'harga_menu' => $req->getVar('harga'),
                'kuliner_id' => $req->getVar('kuliner_id'),
                'media_id' => $req->getVar('media')
            ];
            if ($id != null ? $this->menuModel->update($id, $data) : $this->menuModel->insert($data)) {
                $this->cache->delete('Menu');
                $result = jsonFormat(true, 'Menu berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->menuModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }
    public function delete()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');
            if ($this->menuModel->delete($id)) {
                $this->cache->delete('Menu');
                $result = jsonFormat(true, 'Menu berhasil dihapus');
            } else {
                $result = jsonFormat(false, 'Menu gagal dihapus');
            }
            return $this->response->setJSON($result);
        }
    }
}
