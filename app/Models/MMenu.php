<?php

namespace App\Models;

use CodeIgniter\Model;

class MMenu extends Model
{
    protected $table            = 'menu';
    protected $primaryKey       = 'menu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['kuliner_id', 'media_id', 'nama_menu', 'deskripsi_menu', 'harga_menu', 'menu_created_at', 'menu_created_by', 'menu_updated_at', 'menu_updated_by', 'menu_deleted_at', 'menu_deleted_by',];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'menu_created_at';
    protected $updatedField  = 'menu_updated_at';
    protected $deletedField  = 'menu_deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_menu' => [
            'label' => 'Nama Menu',
            'rules' => 'required|string|max_length[255]'
        ],
        'deskripsi_menu' => [
            'label' => 'Deskripsi',
            'rules' => 'required|string'
        ],
        'harga_menu' => [
            'label' => 'Harga Menu',
            'rules' => 'required|numeric|greater_than_equal_to[1]'
        ]

    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['beforeInsert'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['beforeUpdate'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = ['afterDelete'];

    function beforeInsert($data)
    {
        $data['data']['menu_created_at'] = date('Y-m-d H:i:s');
        $data['data']['menu_created_by'] = AuthUser()->id;
        return $data;
    }
    function beforeUpdate($data)
    {
        $data['data']['menu_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['menu_updated_by'] = AuthUser()->id;
        return $data;
    }
    function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('menu');
        $builder->set('menu_deleted_by', AuthUser()->id);
        $builder->where('menu_id', $id);
        $builder->update();     
    }

    public function getDataKuliner($kulinerId){
        return $this->builder()
            ->join('media', 'menu.media_id = media.media_id')
            ->where('kuliner_id', $kulinerId)
            ->where('menu_deleted_at',null)
            ->get()
            ->getResultArray();
    }

    public function getMenuList($id){
        return $this->builder()
            ->join('media', 'menu.media_id = media.media_id')
            ->select('menu.menu_id as id')
            ->select('menu.nama_menu as menu')
            ->select('menu.deskripsi_menu as deskripsi')
            ->select('menu.harga_menu as harga')
            ->select('menu.kuliner_id as kuliner')
            ->select('media.media_id as media')
            ->select('media.media_slug as slug')
            ->where('menu.menu_id',$id)
            ->get()
            ->getRowArray()
            ;
    }
}
