<?php

namespace App\Models;

use CodeIgniter\Model;

class MKomentar extends Model
{
    protected $table            = 'komentar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'post_id',
        'user_id',
        'komentar_konten',
        'komentar_created_at',
        'komentar_created_by',
        'komentar_updated_at',
        'komentar_updated_at',
        'komentar_deleted_by',
        'komentar_deleted_by',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'komentar_created_at';
    protected $updatedField  = 'komentar_updated_at';
    protected $deletedField  = 'komentar_deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
