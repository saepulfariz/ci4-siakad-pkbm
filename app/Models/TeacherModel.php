<?php

namespace App\Models;

use App\Entities\Teacher;
use App\Traits\LogUserTrait;
use CodeIgniter\Model;

class TeacherModel extends Model
{
    use LogUserTrait;

    protected $table            = 'teachers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Teacher::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'nip',
        'full_name',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'phone',
        'education_level',
        'education_name',
        'education_major',
        'photo',
    ];
    protected $cacheKey = 'teachers';

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

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
    protected $beforeInsert   = ['beforeInsert'];
    protected $afterInsert    = ['afterInsert'];
    protected $beforeUpdate   = ['beforeUpdate'];
    protected $afterUpdate    = ['afterUpdate'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = ['beforeDelete'];
    protected $afterDelete    = ['afterDelete'];

    // public $logName = false;
    public $logId = true;


    public $educations = [
        [
            'id' => 'SLTA/Sederajat',
            'name' => 'SLTA/Sederajat',
        ],
        [
            'id' => 'D3',
            'name' => 'D3',
        ],
        [
            'id' => 'D4',
            'name' => 'D4',
        ],
        [
            'id' => 'S1',
            'name' => 'S1',
        ],
        [
            'id' => 'S2',
            'name' => 'S2',
        ],
    ];
}
