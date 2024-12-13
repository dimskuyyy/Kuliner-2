<?php

namespace App\Models;

use CodeIgniter\Model;

class MMembership extends Model
{
    protected $table            = 'membership';
    protected $primaryKey       = 'member_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'member_code', 'expired_date', 'expired_date','member_status', 'member_created_at', 'member_updated_at', 'member_updated_by', 'member_deleted_at', 'member_deleted_by'];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'member_created_at';
    protected $updatedField  = 'member_updated_at';
    protected $deletedField  = 'member_deleted_at';

    // Validation
    protected $validationRules      = [
        'member_code' => [
            'label' => 'Member Code',
            'rules' => 'required|string|max_length[255]',
        ],
        'expired_date' => [
            'label' => 'Expired Date',
            'rules' => 'required|valid_date[Y-m-d]',
        ],
        'member_status' => [
            'label' => 'Password',
            'rules' => 'required|integer|in_list[1,2]',
        ],
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
        $data['data']['member_created_at'] = date('Y-m-d H:i:s');
        $data['data']['member_created_by'] = AuthUser()->id;
        return $data;
    }
    function beforeUpdate($data)
    {
        $data['data']['member_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['member_updated_by'] = AuthUser()->id;
        return $data;
    }
    function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('membership');
        $builder->set('member_deleted_by', AuthUser()->id);
        $builder->where('member_id', $id);
        $builder->update();
    }

    public function getDatatable(){
        return $this->builder()
            ->join('user', 'user.user_id = membership.user_id')
            ->where('member_deleted_at',null)
            ->where('user.user_deleted_at', null);
    }

    public function getMember($id){
        return $this->builder()
        ->join('user', 'user.user_id = membership.user_id')
        ->where('member_id',$id)
        ->limit(1)
        ->get()
        ->getRowArray();
    }
}
