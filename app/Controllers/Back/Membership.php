<?php

namespace App\Controllers\Back;

use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Datatable;
use App\Models\MMembership;
use App\Models\MMedia;
use App\Models\User;
use App\Models\MPayment;

class Membership extends BaseController
{

    protected $membershipModel;
    protected $mediaModel;
    protected $paymentModel;
    protected $userModel;

    public function __construct()
    {
        $this->membershipModel = new MMembership();
        $this->mediaModel = new MMedia();
        $this->paymentModel = new MPayment();
        $this->userModel = new User();
    }

    public function index()
    {
        return view('dashboard/membership/index');
    }

    public function getDatatable()
    {
        return view('dashboard/membership/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'member_id', 'select' => 'member_id'],
                ['dt' => 'user', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'code', 'cond' => 'member_code', 'select' => 'member_code'],
                ['dt' => 'tgl_kadaluarsa', 'cond' => 'expired_date', 'select' => 'expired_date'],
                ['dt' => 'status', 'cond' => 'member_status', 'select' => 'member_status'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'member_created_at',
                    'select' => 'member_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'member_updated_at',
                    'select' => 'member_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->membershipModel;
            $model2 = new MMembership();
            $result = (new Datatable())->run($model1->getDatatable(), $model2->getDatatable(), $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function form()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->membershipModel->find($id);
                // var_dump(AuthUser()->level);die;
                if (empty($data['member_id'])) {
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if (AuthUser()->level !== "1") {
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];
            $tmp['user'] = (new User())->where('user_status', 2)->where('user_level', 3)->where('user_deleted_at', null)->findAll();

            if ($id != null) {
                $tmp['data'] = $this->membershipModel->getMember($id);
            }
            // var_dump($tmp['data']);die;
            return view('dashboard/membership/form', $tmp);
        }
    }

    public function addPayment()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->membershipModel->find($id);
                // var_dump(AuthUser()->level);die;
                if (empty($data['member_id'])) {
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if (AuthUser()->level !== "1") {
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Data Kosong');
                return $this->response->setJSON($result);
            }

            $tmp = [
                'data' => $data
            ];

            // var_dump($tmp['data']);die;
            return view('dashboard/membership/add_payment', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->membershipModel->find($id);
                if (!empty($data['member_id'])) {
                    if (AuthUser()->level !== "1") {
                        $result = jsonFormat(false, 'Membership tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                } else {
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Membership tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['payment'] = (new MPayment())->getLastPayment($id);
            }
            // var_dump($tmp['payment']);die;
            return view('dashboard/membership/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->membershipModel->find($id);
                if (empty($find['member_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($find['member_created_by'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Membership tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'user_id' => $req->getVar('email'),
                'member_code' => $req->getVar('kode'),
                'expired_date' => $req->getVar('expire'),
                'member_status' => $req->getVar('status'),
            ];

            $userId =  $req->getVar('email');
            $user = [];
            if ($req->getVar('status') == 2) {
                $user['level'] = 2;
            } else {
                $user['level'] = 3;
            }

            if ($id != null ? $this->membershipModel->update($id, $data) : $this->membershipModel->insert($data)) {
                $this->userModel->update($userId, [
                    'user_level' => $user['level']
                ]);

                $result = jsonFormat(true, 'Membership berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->membershipModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }

    public function savePayment()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            
            $data = [
                'member_id' => $req->getVar('id'),
                'media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;
            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }
            
            if ($this->paymentModel->insert($data)) {
                $result = jsonFormat(true, 'Payment berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->paymentModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }

    public function delete()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');

            if (empty($id)) {
                $result = jsonFormat(false, 'Membership tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->membershipModel->find($id);
            if (empty($find['member_id'])) {
                $result = jsonFormat(false, 'Membership tidak ditemukan');
                return $this->response->setJSON($result);
            } else if ($find['member_created_by'] != AuthUser()->id) {
                $result = jsonFormat(false, 'Membership tidak ditemukan');
                return $this->response->setJSON($result);
            }


            // menghapus media
            if (!($find['member_created_by'] != AuthUser()->id)) {
                if ($this->membershipModel->delete($id)) {
                    $this->userModel->update($find['user_id'], [
                        'user_level' => 3
                    ]);
                    $result = jsonFormat(true, 'Membership berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Membership gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
