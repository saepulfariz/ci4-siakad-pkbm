<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedStudentClasses extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'student-classes.access',
                'title' => 'Can access the student-classes area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'student-classes.create',
                'title' => 'Can create sub student-classes',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'student-classes.edit',
                'title' => 'Can update sub student-classes',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'student-classes.delete',
                'title' => 'Can delete sub student-classes',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'student-classes.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'student-classes.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'student-classes.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'student-classes.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Student Classes',
                    'icon' => 'fas fa-users',
                    'route' => 'student-classes',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'student-classes.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Kelas Siswa',
                    'icon' => 'fas fa-users',
                    'route' => 'student-classes',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'student-classes.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'class_id' => 1,
                'student_id' => 1,
                'semester_id' => 1,
            ],
        ];

        $this->db->table('student_classes')->insertBatch($data);
    }
}
