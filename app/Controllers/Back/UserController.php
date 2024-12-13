<?php

namespace App\Controllers\Back;

use App\Models\User;
use App\Libraries\Datatable;

class UserController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function index()
    {
        return view('dashboard/user/index');
    }

    public function profile()
    {
        $data = $this->userModel->find(AuthUser()->id);
        $tmp = [
            'data' => $data
        ];
        return view('dashboard/user/profile', $tmp);
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'level', 'cond' => 'user_level', 'select' => 'user_level'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'status', 'cond' => 'user_status', 'select' => 'user_status'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'user_created_at',
                    'select' => 'user_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'user_updated_at',
                    'select' => 'user_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];
            $model1 = $this->userModel;
            $model2 = new User();
            $result = (new Datatable())->run($model1->where('user_deleted_at', null)->where('user_status', 2)->where('user_level!=', 1)->orderBy('user_level'), $model2->where('user_deleted_at', null)->where('user_status', 2)->where('user_level!=', 1)->orderBy('user_level'), $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function form()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->userModel->find($id);
                if (empty($data['user_id']) && $data['user_level'] == 1) {
                    $result = jsonFormat(false, 'User tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
            }

            return view('dashboard/user/form', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->userModel->find($id);
                if (empty($data['user_id']) && $data['user_level'] == 1) {
                    $result = jsonFormat(false, 'User tidak ditemukan');
                    return $this->response->setJSON($result);
                }
                $password = $req->getVar('password') ?? null;
                // cek ada request password, lakukan proses reset password, jika tidak lakukan proses update data
                if ($password !== null) {
                    $result = $this->resetPassword($id, $req);
                } else {
                    // lakukan proses update
                    $result = $this->updateUser($id, $req);
                }
            } else {
                // lakukan proses create data
                $result = $this->createUser($req);
            }
            return $this->response->setJSON($result);
        }
    }

    private function createUser($req)
    {
        $data = [
            'user_nama' => $req->getVar('nama'),
            'user_email' => $req->getVar('email'),
            'user_password' => $req->getVar('password'),
            'confirm_password' => $req->getVar('confirm_password'),
            'user_level' => $req->getVar('user_level'),
            'user_status' => $req->getVar('status'),
        ];
        if ($this->userModel->validateCreate($data)) {
            // Data valid
            $result = jsonFormat(true, 'User berhasil disimpan');
        } else {
            // Data tidak valid, tampilkan error validasi
            $result = jsonFormat(false,  $this->userModel->errors());
        }
        return $result;
    }

    private function updateUser($id, $req)
    {
        // $level = null;
        // $status = null;
        if (!$req->getVar('level') && !$req->getVar('status')) {
            $data = $this->userModel->find($req->getVar('id'));
            $level = $data['user_level'];
            $status = $data['user_status'];
        }
        $data = [
            'user_id' => $req->getVar('id'),
            'user_nama' => $req->getVar('nama'),
            'user_email' => $req->getVar('email'),
            'user_level' => $req->getVar('level') ?? $level,
            'user_status' => $req->getVar('status') ?? $status,
        ];
        $this->userModel->setValidationRulesUpdate($id);
        if ($this->userModel->validateUpdate($data)) {
            // Data valid
            $result = jsonFormat(true, 'User berhasil disimpan');
            if ($data['user_id'] === AuthUser()->id) {
                $tipe = null;
                switch ($data['user_level']) {
                    case 1:
                        $tipe = "SuperAdmin";
                        break;
                    case 2:
                        $tipe = "Member";
                        break;
                    case 3:
                        $tipe = "Normal User";
                        break;
                }
                $ses = session();
                $ses->set([
                    'id' => $data['user_id'],
                    'nama' => $data['user_nama'],
                    'level' => $data['user_level'],
                    'level_nama' => $tipe,
                    'status_akun' => $data['user_status'],
                ]);
            }
        } else {
            // Data tidak valid, tampilkan error validasi
            $result = jsonFormat(false,  $this->userModel->errors());
        }
        return $result;
    }

    private function resetPassword($id, $req)
    {
        if ($req->getVar('oldPassword')) {
            $data = $this->userModel->find($id);
            if (!password_verify($req->getVar('oldPassword'), $data['user_password'])) {
                return jsonFormat(false, 'Password anda salah');
            }
        }
        $data = [
            'user_id' => $id,
            'user_password' => $req->getVar('password'),
            'confirm_password' => $req->getVar('confirm_password'),
        ];
        if ($this->userModel->validateResetPassword($data)) {
            // Data valid, lakukan update
            $result = jsonFormat(true, 'User berhasil disimpan');
        } else {
            // Data tidak valid, tampilkan error validasi
            $result = jsonFormat(false,  $this->userModel->errors());
        }
        return $result;
    }

    public function delete()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');

            if (empty($id)) {
                // ID kosong, kirim respons error
                $result = jsonFormat(false, 'User tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->userModel->find($id);
            if (empty($find['user_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'User tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus user
            if ($find['user_level'] == 2 ? $this->userModel->delete($id) : false) {
                $result = jsonFormat(true, 'User berhasil dihapus');
            } else {
                $result = jsonFormat(false, 'User gagal dihapus');
            }
            return $this->response->setJSON($result);
        }
    }
}
