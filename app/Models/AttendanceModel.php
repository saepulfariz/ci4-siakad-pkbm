<?php

namespace App\Models;

use App\Entities\Attendance;
use App\Traits\LogUserTrait;
use CodeIgniter\Model;

class AttendanceModel extends Model
{
    use LogUserTrait;

    protected $table            = 'attendances';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Attendance::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'type',
        'date',
        'status',
        'description',
    ];

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

    protected $cacheKey = 'attendances';

    public $types = [
        [
            'id' => 'student',
            'name' => 'Student',
        ],
        [
            'id' => 'teacher',
            'name' => 'Teacher',
        ]
    ];

    public $status = [
        [
            'id' => 'present',
            'name' => 'Present',
        ],

        [
            'id' => 'leave',
            'name' => 'Leave',
        ],
        [
            'id' => 'sick',
            'name' => 'Sick',
        ],
        [
            'id' => 'absent',
            'name' => 'Absent',
        ]
    ];
}
