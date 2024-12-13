<?php

namespace App\Controllers\Back;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    public function login()
    {
        if (!isGuest()) {
            return redirect()->to('wbpanel');
        }
        // $data['logo'] = $this->getLogo();
        return view('auth/login');
    }
    public function doLogin()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $email = $req->getPost('email');
            $password = $req->getPost('password');
            $data = [
                'email' => $email,
                'password' => $password,
            ];
            $rules = [
                'email' => 'required|string',
                'password' => 'required|string',
            ];
            if ($this->validateData($data, $rules)) {
                $user = (new User())
                    ->select(['user_id', 'user_nama', 'user_password', 'user_level', 'user_status'])
                    ->where('user_email', $email)->where('user_status', 2)
                    ->whereIn('user_level', [1, 2])
                    ->first();
                $level = 0;
                if ($user['user_level'] == 1) {
                    $level = "SuperAdmin";
                } else if ($user['user_level'] == 2) {
                    $level = "Member";
                } else {
                    $result = jsonFormat(false, $this->validator->getErrors());
                    return $this->response->setJSON($result);
                }
                if ($user != null) {
                    if (password_verify($password, $user['user_password'])) {
                        $ses = session();
                        $ses->set([
                            'id' => $user['user_id'],
                            'nama' => $user['user_nama'],
                            'level' => $user['user_level'],
                            'level_nama' => $level,
                            'status_akun' => $user['user_status'],
                            'login_at' => date('d-m-Y H:i:s')
                        ]);
                        $result = jsonFormat(true, 'Login berhasil');
                    } else {
                        $result = jsonFormat(false, 'Gagal login, silahkan coba kembali');
                    }
                } else {
                    $result = jsonFormat(false, 'Gagal login, akun tidak ditemukan/tidak aktif !');
                }
            } else {
                $result = jsonFormat(false, $this->validator->getErrors());
            }
            return $this->response->setJSON($result);
        }
    }
    public function logout()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            session()->destroy();
            return $this->response->setJSON(['status' => true, 'msg' => 'Logout berhasil']);
        }
    }
}
