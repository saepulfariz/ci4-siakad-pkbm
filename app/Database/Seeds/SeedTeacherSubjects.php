<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedTeacherSubjects extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'teacher-subjects.access',
                'title' => 'Can access the teacher-subjects area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'teacher-subjects.create',
                'title' => 'Can create sub teacher-subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'teacher-subjects.edit',
                'title' => 'Can update sub teacher-subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'teacher-subjects.delete',
                'title' => 'Can delete sub teacher-subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'teacher-subjects.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'teacher-subjects.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'teacher-subjects.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'teacher-subjects.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Teacher Subjects',
                'icon' => 'fas fa-list',
                'route' => 'teacher-subjects',
                'order' => 5,
                'active' => 1,
                'permission' => 'teacher-subjects.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'teacher_id' => 1,
                'subject_id' => 1,
            ],
        ];

        $this->db->table('teacher_subjects')->insertBatch($data);
    }
}
