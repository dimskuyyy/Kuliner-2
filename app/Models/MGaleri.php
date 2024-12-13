<?php

namespace App\Models;

use CodeIgniter\Model;

class MGaleri extends Model
{
    protected $table            = 'galeri_kuliner';
    protected $primaryKey       = 'galeri_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['kuliner_id', 'media_id', 'judul', 'galeri_created_at', 'galeri_created_by', 'galeri_updated_at', 'galeri_updated_by', 'galeri_deleted_at', 'galeri_deleted_by',];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'galeri_created_at';
    protected $updatedField  = 'galeri_updated_at';
    protected $deletedField  = 'galeri_deleted_at';

    // Validation
    protected $validationRules      = [
        'judul' => [
            'label' => 'Judul',
            'rules' => 'required|string|max_length[255]'
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
        $data['data']['galeri_created_at'] = date('Y-m-d H:i:s');
        $data['data']['galeri_created_by'] = AuthUser()->id;
        return $data;
    }
    function beforeUpdate($data)
    {
        $data['data']['galeri_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['galeri_updated_by'] = AuthUser()->id;
        return $data;
    }
    function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('galeri_kuliner');
        $builder->set('galeri_deleted_by', AuthUser()->id);
        $builder->where('galeri_id', $id);
        $builder->update();     
    }

    public function getDataKuliner($kulinerId){
        return $this->builder()
            ->join('media', 'galeri_kuliner.media_id = media.media_id')
            ->where('kuliner_id', $kulinerId)
            ->where('galeri_deleted_at',null)
            ->get()
            ->getResultArray();
    }

    public function getListGaleri($id){
        return $this->builder()
            ->join('media', 'galeri_kuliner.media_id = media.media_id')
            ->select('galeri_kuliner.galeri_id as id')
            ->select('galeri_kuliner.judul as galeri')
            ->select('galeri_kuliner.kuliner_id as kuliner')
            ->select('media.media_id as media')
            ->select('media.media_slug as slug')
            ->where('galeri_kuliner.galeri_id',$id)
            ->get()
            ->getRowArray()
            ;
    }
}
