<?php

namespace App\Models;

use App\Enums\TipeKuliner;
use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class MKuliner extends Model
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
        'tipe_kuliner'
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
        'slug_kuliner' => 'required',
        'deskripsi' => 'string',
        'alamat' => 'required|string',
        'latitude' => 'required',
        'longitude' => 'required',
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

    public function getKuliner(TipeKuliner $tipeKuliner = TipeKuliner::SEMUA, int $memberId = null, int $minPost = 0, int $maxPost = null, bool $latest = true)
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

        // Add where slug
        $builder = $builder->where('kuliner.slug_kuliner', $slugKuliner);
        
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

    public function getMenuKuliner(string $slugKuliner, bool $cheapest = true)
    {
        $builder = $this->builder();
        
        // Add join
        $builder = $builder->join('menu', 'menu.kuliner_id = kuliner.kuliner_id')
            ->join('media', 'media.media_id = menu.media_id');
        
        // Add where slug
        $builder = $builder->where('kuliner.slug_kuliner', $slugKuliner);

        // Don't include deleted menu
        $builder = $builder->where('menu.menu_deleted_at IS NULL');

        // Add sort
        $dir = 'ASC';
        if (!$cheapest) $dir = 'DESC';
        $builder = $builder->orderBy('menu.harga_menu', $dir);

        // Define column selection
        $builder = $builder->select('menu.menu_id')
            ->select('menu.nama_menu')
            ->select('menu.deskripsi_menu')
            ->select('menu.harga_menu')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path');
        
        return $builder->get();
    }

    public function getGaleriKuliner(string $slugKuliner, bool $latest = true)
    {
        $builder = $this->builder();
        
        // Add join
        $builder = $builder->join('galeri_kuliner', 'galeri_kuliner.kuliner_id = kuliner.kuliner_id')
            ->join('media', 'media.media_id = galeri_kuliner.media_id');
        
        // Add where slug
        $builder = $builder->where('kuliner.slug_kuliner', $slugKuliner);

        // Don't include deleted menu
        $builder = $builder->where('galeri_kuliner.galeri_deleted_at IS NULL');

        // Add sort
        $dir = 'DESC';
        if (!$latest) $dir = 'ASC';
        $builder = $builder->orderBy('galeri_kuliner.galeri_created_at', $dir);

        // Define column selection
        $builder = $builder->select('galeri_kuliner.galeri_id')
            ->select('galeri_kuliner.judul')
            ->select('galeri_kuliner.galeri_created_at')
            ->select('galeri_kuliner.galeri_created_at')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path');

        return $builder->get();
    }

    public function getPostKuliner(string $slugKuliner, bool $latest = true)
    {
        $builder = $this->builder();

        // Add join
        $builder = $builder->join('post', 'post.kuliner_id = kuliner.kuliner_id')
            ->join('media', 'media.media_id = post.media_id')
            ->join('user', 'user.user_id = post.user_id');
        
        // Add where slug
        $builder = $builder->where('kuliner.slug_kuliner', $slugKuliner);

        // Don't include deleted menu
        $builder = $builder->where('post.post_deleted_at IS NULL');

        // Add sort
        $dir = 'DESC';
        if (!$latest) $dir = 'ASC';
        $builder = $builder->orderBy('post.post_created_at', $dir);

        // Define column selection
        $builder = $builder->select('post.post_id')
            ->select('post.slug_post')
            ->select('post.judul')
            ->select(new RawSql('CASE WHEN LOCATE(" ", konten, 100) > 0 THEN SUBSTRING(konten, 1, LOCATE(" ", konten, 100)) ELSE SUBSTRING(konten, 1, 100) END AS excerpt'))
            ->select('post.post_created_at')
            ->select('media.media_nama')
            ->select('media.media_type')
            ->select('media.media_slug')
            ->select('media.media_path')
            ->select('user.user_id')
            ->select('user.user_nama');
        
        return $builder->get();
    }

    public function getDataInput($id){
        return $this->builder()
            ->join('media', 'kuliner.media_id = media.media_id')
            ->where('kuliner_deleted_at',null)
            ->where('member_id', $id)
            ->get()  // Eksekusi query
            ->getRowArray();;
    }

    function beforeInsert($data)
    {
        $data['data']['kuliner_created_at'] = date('Y-m-d H:i:s');
        $data['data']['kuliner_created_by'] = AuthUser()->id;
        return $data;
    }
    function beforeUpdate($data)
    {
        $data['data']['kuliner_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['kuliner_updated_by'] = AuthUser()->id;
        return $data;
    }
    function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('kuliner');
        $builder->set('kuliner_deleted_by', AuthUser()->id);
        $builder->where('kuliner_id', $id);
        $builder->update();
    }
}
