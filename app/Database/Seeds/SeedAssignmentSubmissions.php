<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssignmentSubmissions extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'assignment-submissions.access',
                'title' => 'Can access the assignment-submissions area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'assignment-submissions.create',
                'title' => 'Can create sub assignment-submissions',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'assignment-submissions.edit',
                'title' => 'Can update sub assignment-submissions',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'assignment-submissions.delete',
                'title' => 'Can delete sub assignment-submissions',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'assignment-submissions.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignment-submissions.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignment-submissions.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignment-submissions.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Assignment Submissions',
                'icon' => 'fas fa-list',
                'route' => 'assignment-submissions',
                'order' => 5,
                'active' => 1,
                'permission' => 'assignment-submissions.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'assignment_id' => 1,
                'student_id' => 1,
                'description' => 'Test',
                'submitted_at' => date('Y-m-d H:i:s', strtotime('+1 Hours')),
                'review_at' => date('Y-m-d H:i:s', strtotime('+1 Hours')),
            ],
        ];

        $this->db->table('assignment_submissions')->insertBatch($data);
    }
}
