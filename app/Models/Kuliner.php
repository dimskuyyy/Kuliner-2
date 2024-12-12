<?php

namespace App\Models;

use App\Enums\TipeKuliner;
use CodeIgniter\Model;

class Kuliner extends Model
{
    protected $table            = 'kuliner';
    protected $primaryKey       = 'kuliner_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'member_id',
        'media_id',
        'nama_kuliner',
        'slug_kuliner',
        'deskripsi',
        'alamat',
        'latitude',
        'longitude',
        'kuliner_created_at',
        'kuliner_updated_at',
        'kuliner_deleted_at',
        'kuliner_deleted_by',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'kuliner_created_at';
    protected $updatedField  = 'kuliner_updated_at';
    protected $deletedField  = 'kuliner_deleted_at';

    // Validation
    protected $validationRules      = [
        'member_id' => 'required|integer',
        'media_id' => 'required|integer',
        'nama_kuliner' => 'required|string',
        'slug_kuliner' => 'required|regex_match[/^[a-z0-9_-]+$/]',
        'deskripsi' => 'string',
        'alamat' => 'required|string',
        'latitude' => 'required|regex_match[/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)]$/]',
        'longitude' => 'required|regex_match[/^[-+]?((1[0-7]\d)|([1-9]?\d))(\.\d+)?|180(\.0+)?$/]',
    ];
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

    public function getKuliner(TipeKuliner $tipeKuliner = TipeKuliner::SEMUA, int $memberId = null, int $minPost = 0, int $maxPost = null, $latest = true)
    {
        $builder = $this->builder();
        
        // Add join
        $builder = $builder->join('media', 'media.media_id = kuliner.media_id')
            ->join('membership', 'membership.member_id = kuliner.member_id')
            ->join('user', 'user.user_id = membership.user_id')
            ->join('post', 'post.kuliner_id = kuliner.kuliner_id', 'left');

        // Add filter tipe kuliner
        if ($tipeKuliner != TipeKuliner::SEMUA) $builder = $builder->where('kuliner.tipe_kuliner', $tipeKuliner->value);

        // Add filter member
        if ($memberId) $builder = $builder->where('kuliner.member_id', $memberId);

        // Don't include deleted kuliner
        $builder = $builder->where('kuliner.kuliner_deleted_at IS NULL');

        // Add group by
        $builder = $builder->groupBy('kuliner.kuliner_id');

        // Add filter minimum dan maksimum post
        $builder = $builder->having('jumlah_post >=', $minPost);
        if ($maxPost) $builder = $builder->having('jumlah_post <=', $maxPost);

        // Add sort
        $dir = 'DESC';
        if (!$latest) $dir = 'ASC';
        $builder = $builder->orderBy('kuliner.kuliner_created_at', $dir);

        // Define the selection
        $builder = $builder->select('kuliner.kuliner_id')
            ->select('kuliner.nama_kuliner')
            ->select('kuliner.slug_kuliner')
            ->select('kuliner.deskripsi')
            ->select('kuliner.alamat')
            ->select('kuliner.latitude')
            ->select('kuliner.longitude')
            ->select('kuliner.kuliner_created_at')
            ->select('kuliner.kuliner_updated_at')
            ->select('kuliner.tipe_kuliner')
            ->select('user.user_nama')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path')
            ->selectCount('post.post_id', 'jumlah_post');
        
        return $builder->get();
    }

    public function getDetailKuliner(string $slugKuliner)
    {
        $builder = $this->builder();

        // Add join
        $builder = $builder->join('media', 'media.media_id = kuliner.media_id')
            ->join('membership', 'membership.member_id = kuliner.member_id')
            ->join('user', 'user.user_id = membership.user_id');
        
        // Define column selection
        $builder = $builder->select('kuliner.kuliner_id')
            ->select('kuliner.nama_kuliner')
            ->select('kuliner.slug_kuliner')
            ->select('kuliner.deskripsi')
            ->select('kuliner.alamat')
            ->select('kuliner.latitude')
            ->select('kuliner.longitude')
            ->select('kuliner.kuliner_created_at')
            ->select('kuliner.kuliner_updated_at')
            ->select('kuliner.tipe_kuliner')
            ->select('user.user_nama')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path');
        
        return $builder->get();
    }
}
