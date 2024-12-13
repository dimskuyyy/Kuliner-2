<?php

namespace App\Controllers\Front;

use App\Models\MPost;
use CodeIgniter\Exceptions\PageNotFoundException;

class Post extends BaseController
{
    public function index(): string
    {
        return view('post/index');
    }

    public function detail($slug)
    {
        $postModel = new MPost();
        $detailPost = $postModel->getPostDetail($slug)->getFirstRow();

        if (!$detailPost) throw new PageNotFoundException('Post tidak ditemukan.');

        $dataKomentarPost = $postModel->getkomentarPost($slug);

        return view('front/post/detail', compact('detailPost', 'dataKomentarPost'));
    }

    public function comment($slug)
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $postModel = new MPost();
            $detailPost = $postModel->getPostDetail($slug)->getFirstRow();

            if (!$detailPost) return $this->response->setJSON(jsonFormat(false, 'Post tidak ditemukan.'));

            $comment = $req->getPost('comment');
            $data = [
                'comment' => $comment,
            ];
            $rules = [
                'comment' => 'required|string',
            ];
            if ($this->validateData($data, $rules)) {
                $komentarModel = new \App\Models\MKomentar();
                $data = [
                    'post_id' => $detailPost->post_id,
                    'user_id' => AuthUser()->id,
                    'komentar_konten' => $comment,
                ];
                // log_message('debug', 'Menyimpan data user baru. Password: {user_password_raw}, Hash: {user_password}', array_merge($data, ['user_password_raw' => $password]));
                $newKomentarId = $komentarModel->insert($data);

                // Otomatis login user baru
                if ($newKomentarId) {
                    $result = jsonFormat(true, 'Berhasil menambahkan komentar.');
                } else {
                    $result = jsonFormat(false, 'Gagal menambahkan komentar. Terjadi kesalahan ketika menyimpan data komentar baru.');
                }
            } else {
                $result = jsonFormat(false, $this->validator->getErrors());
            }
            return $this->response->setJSON($result);
        }
    }
}
