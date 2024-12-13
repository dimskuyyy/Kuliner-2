<?php

namespace App\Models;

use CodeIgniter\Model;

class MPayment extends Model
{
    protected $table            = 'member_payment';
    protected $primaryKey       = 'payment_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['member_id', 'media_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'payment_created_at';
    protected $updatedField  = 'payment_updated_at';
    protected $deletedField  = 'payment_deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = true;
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
        $data['data']['payment_created_at'] = date('Y-m-d H:i:s');
        $data['data']['payment_created_by'] = AuthUser()->id;
        return $data;
    }
    function beforeUpdate($data)
    {
        $data['data']['payment_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['payment_updated_by'] = AuthUser()->id;
        return $data;
    }
    
    function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('member_payment');
        $builder->set('payment_deleted_by', AuthUser()->id);
        $builder->where('payment_id', $id);
        $builder->update();
    }

    public function getLastPayment($id){
        return $this->builder()
            ->join('media', 'member_payment.media_id = media.media_id',)
            ->where('member_id',$id)
            ->orderBy('payment_id', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray()
            ;
    }
}
