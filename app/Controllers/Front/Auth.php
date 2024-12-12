<?php

namespace App\Controllers\Front;

use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function register()
    {
        return view('front/auth/register');
    }

    public function storeUser()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $name = $req->getPost('username');
            $email = $req->getPost('email');
            $password = $req->getPost('password');
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];
            $rules = [
                'name' => 'required|string',
                'email' => 'required|string|is_unique[user.user_email]',
                'password' => 'required|string',
            ];
            if ($this->validateData($data, $rules)) {
                $userModel = new \App\Models\User();
                $data = [
                    'user_nama' => $name,
                    'user_email' => $email,
                    'user_password' => $password,
                    'user_level' => 3,
                    'user_status' => 2,
                    'user_created_at' => date('Y-m-d H:i:s')
                ];
                // log_message('debug', 'Menyimpan data user baru. Password: {user_password_raw}, Hash: {user_password}', array_merge($data, ['user_password_raw' => $password]));
                $newUserId = $userModel->insert($data);

                // Otomatis login user baru
                if ($newUserId) {
                    $session = session();
                    $session->set([
                        'id' => $newUserId,
                        'nama' => $name,
                        'level' => 3,
                        'level_nama' => 'User',
                        'status_akun' => 2,
                        'login_at' => date('d-m-Y H:i:s')
                    ]);
                    $result = jsonFormat(true, 'Berhasil mendaftarkan pengguna.');
                } else {
                    $result = jsonFormat(false, 'Gagal mendaftarkan pengguna. Terjadi kesalahan ketika menyimpan data pengguna baru.');
                }
            } else {
                $result = jsonFormat(false, $this->validator->getErrors());
            }
            return $this->response->setJSON($result);
        }
    }

    public function login()
    {
        return view('front/auth/login');
    }

    public function auth()
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
                $userModel = new \App\Models\User();
                $possibleUser = $userModel->select(['user_id', 'user_nama', 'user_password', 'user_level', 'user_status'])
                    ->where('user_email', $email)
                    ->where('user_status', 2)
                    ->where('user_level', 3)
                    ->first();
                
                if ($possibleUser) {
                    log_message('debug', 'User mencoba masuk. Password: {user_password_attempt}, Hash: {user_password}', array_merge($possibleUser, ['user_password_attempt' => $password]));
                    $verificationResult = password_verify($password, $possibleUser['user_password']);
                    if ($verificationResult) {
                        log_message(
                            'debug',
                            'User berhasil masuk. Password: {user_password_attempt}, Hash: {user_password}, Verication result: {verification_result}',
                            array_merge($possibleUser, [
                                'user_password_attempt' => $password,
                                'verification_result' => $verificationResult ? 'true' : 'false'
                            ])
                        );

                        $ses = session();
                        $ses->set([
                            'id' => $possibleUser['user_id'],
                            'nama' => $possibleUser['user_nama'],
                            'level' => $possibleUser['user_level'],
                            'level_nama' => 'User',
                            'status_akun' => $possibleUser['user_status'],
                            'login_at' => date('d-m-Y H:i:s')
                        ]);
                        $result = jsonFormat(true, 'Login berhasil');
                    } else {
                        log_message(
                            'debug',
                            'User gagal masuk. Password: {user_password_attempt}, Hash: {user_password}, Verication result: {verification_result}',
                            array_merge($possibleUser, [
                                'user_password_attempt' => $password,
                                'verification_result' => $verificationResult ? 'true' : 'false'
                            ])
                        );

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
}
