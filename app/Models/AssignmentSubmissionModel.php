<?php

namespace App\Models;

use App\Entities\AssignmentSubmission;
use App\Traits\LogUserTrait;
use CodeIgniter\Model;

class AssignmentSubmissionModel extends Model
{
    use LogUserTrait;

    protected $table            = 'assignment_submissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = AssignmentSubmission::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'assignment_id',
        'student_id',
        'description',
        'status',
        'file',
        'feedback',
        'score',
        'submitted_at',
        'review_id',
        'review_at',
    ];

    protected $cacheKey = 'assignment_submissions';

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

    public $status = [
        [
            'id' => 'Submitted',
            'name' => 'Submitted'
        ],
        [
            'id' => 'Late',
            'name' => 'Late'
        ]
    ];
}
