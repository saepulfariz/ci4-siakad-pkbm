<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssignments extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'assignments.access',
                'title' => 'Can access the assignments area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],

            [
                'name' => 'assignments.access-all',
                'title' => 'Can access the assignments all area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'assignments.create',
                'title' => 'Can create sub assignments',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'assignments.edit',
                'title' => 'Can update sub assignments',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'assignments.delete',
                'title' => 'Can delete sub assignments',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'assignments.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignments.access-all',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignments.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignments.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'assignments.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],


            [
                'group_id' => 2,
                'permission' => 'assignments.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],

            [
                'group_id' => 3,
                'permission' => 'assignments.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'assignments.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'assignments.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'assignments.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Assignments',
                    'icon' => '	fas fa-tasks',
                    'route' => 'assignments',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'assignments.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Tugas',
                    'icon' => '	fas fa-tasks',
                    'route' => 'assignments',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'assignments.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 1,
                'title' => 'Test',
                'description' => 'Test',
                'deadline' => date('Y-m-d H:i:s', strtotime('+1 Hours')),
            ],
        ];

        $this->db->table('assignments')->insertBatch($data);
    }
}
