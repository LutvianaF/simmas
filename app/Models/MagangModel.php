<?php

namespace App\Models;

use CodeIgniter\Model;

class MagangModel extends Model
{
    protected $table            = 'magang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['siswa_id','dudi_id','guru_id','status','nilai_akhir','tanggal_mulai','tanggal_selesai'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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

    public const STATUS_PENDING     = 'pending';
    public const STATUS_DITERIMA    = 'diterima';
    public const STATUS_DITOLAK     = 'ditolak';
    public const STATUS_BERLANGSUNG = 'berlangsung';
    public const STATUS_SELESAI     = 'selesai';
    public const STATUS_DIBATALKAN  = 'dibatalkan';
}
