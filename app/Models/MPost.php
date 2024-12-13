<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class MPost extends Model
{
    protected $table            = 'post';
    protected $primaryKey       = 'post_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'media_id',
        'kuliner_id',
        'slug_post',
        'konten',
        'judul',
        'post_created_at',
        'post_created_by',
        'post_updated_at',
        'post_updated_at',
        'post_deleted_by',
        'post_deleted_by',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'post_created_at';
    protected $updatedField  = 'post_updated_at';
    protected $deletedField  = 'post_deleted_at';

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

    public function getPost(bool $mostPopular = true, bool $latest = true, int $limit = null)
    {
        $builder = $this->builder();
        
        // Add join
        $builder = $builder->join('media', 'media.media_id = post.media_id')
            ->join('user', 'user.user_id = post.user_id')
            ->join('komentar', 'komentar.post_id = post.post_id')
            ->join('kuliner', 'kuliner.kuliner_id = post.kuliner_id');

        // Don't include deleted kuliner
        $builder = $builder->where('post.post_deleted_at IS NULL');

        // Add group by
        $builder = $builder->groupBy('post.post_id');

        // Add sort
        $dir = 'DESC';
        if (!$mostPopular) $dir = 'ASC';
        $builder = $builder->orderBy('jumlah_komentar', $dir);

        // Add sort
        $dir = 'DESC';
        if (!$latest) $dir = 'ASC';
        $builder = $builder->orderBy('post.post_created_at', $dir);

        // Define the selection
        $builder = $builder->select('post.post_id')
            ->select('post.slug_post')
            ->select('post.judul')
            ->select(new RawSql('CASE WHEN LOCATE(" ", post.konten, 100) > 0 THEN SUBSTRING(post.konten, 1, LOCATE(" ", post.konten, 100)) ELSE SUBSTRING(post.konten, 1, 100) END AS excerpt'))
            ->select('post.post_created_at')
            ->select('kuliner.kuliner_id')
            ->select('kuliner.nama_kuliner')
            ->select('kuliner.slug_kuliner')
            ->select('kuliner.deskripsi')
            ->select('kuliner.alamat')
            ->select('kuliner.latitude')
            ->select('kuliner.longitude')
            ->select('kuliner.tipe_kuliner')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path')
            ->select('user.user_id')
            ->select('user.user_nama')
            ->selectCount('komentar.komentar_id', 'jumlah_komentar');
        
        return $builder->get(limit: $limit);
    }

    public function getPostDetail(string $slugPost)
    {
        $builder = $this->builder();

        // Add join
        $builder = $builder->join('media', 'media.media_id = post.media_id')
            ->join('user', 'user.user_id = post.user_id')
            ->join('kuliner', 'kuliner.kuliner_id = post.kuliner_id')
            ->join('like', 'like.post_id = post.post_id', 'left');

        // Add where slug
        $builder = $builder->where('post.slug_post', $slugPost);

        // Add group by
        $builder = $builder->groupBy('post.post_id');
        
        // Define column selection
        $builder = $builder->select('post.post_id')
            ->select('post.slug_post')
            ->select('post.judul')
            ->select('post.konten')
            ->select('post.post_created_at')
            ->select('kuliner.kuliner_id')
            ->select('kuliner.nama_kuliner')
            ->select('kuliner.slug_kuliner')
            ->select('kuliner.deskripsi')
            ->select('kuliner.alamat')
            ->select('kuliner.latitude')
            ->select('kuliner.longitude')
            ->select('kuliner.tipe_kuliner')
            ->select('user.user_nama')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path')
            ->selectCount('like.user_id', 'jumlah_like');
        
        return $builder->get();
    }

    public function getkomentarPost(string $slugPost, bool $latest = true)
    {
        $builder = $this->builder();

        // Add join
        $builder = $builder->join('komentar', 'komentar.post_id = post.post_id')
            ->join('user', 'user.user_id = komentar.user_id');

        // Add where slug
        $builder = $builder->where('post.slug_post', $slugPost);

        // Don't include deleted komentar
        $builder = $builder->where('komentar.komentar_deleted_at IS NULL');

        // Add sort
        $dir = 'DESC';
        if (!$latest) $dir = 'ASC';
        $builder = $builder->orderBy('komentar.komentar_created_at', $dir);

        // Define column selection
        $builder = $builder->select('user.user_nama')
            ->select('komentar.komentar_id')
            ->select('komentar.komentar_konten');

        return $builder->get();
    }
}
