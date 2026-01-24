<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedSubjects extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'subjects.access',
                'title' => 'Can access the subjects area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'subjects.create',
                'title' => 'Can create sub subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'subjects.edit',
                'title' => 'Can update sub subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'subjects.delete',
                'title' => 'Can delete sub subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'subjects.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'subjects.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'subjects.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'subjects.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Subjects',
                    'icon' => 'fas fa-book',
                    'route' => 'subjects',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'subjects.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Mapel',
                    'icon' => 'fas fa-book',
                    'route' => 'subjects',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'subjects.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'code' => 'MTK-X',
                'name' => 'Matematika X',
            ],
            [
                'code' => 'MTK-XI',
                'name' => 'Matematika XI',
            ],
            [
                'code' => 'MTK-XII',
                'name' => 'Matematika XII',
            ],
        ];

        $this->db->table('subjects')->insertBatch($data);
    }
}
