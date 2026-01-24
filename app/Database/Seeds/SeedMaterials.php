<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedMaterials extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'materials.access',
                'title' => 'Can access the materials',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'materials.access-all',
                'title' => 'Can access the materials all',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'materials.create',
                'title' => 'Can create sub materials',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'materials.edit',
                'title' => 'Can update sub materials',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'materials.delete',
                'title' => 'Can delete sub materials',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'materials.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'materials.access-all',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'materials.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'materials.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'materials.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],


            [
                'group_id' => 2,
                'permission' => 'materials.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],

            [
                'group_id' => 3,
                'permission' => 'materials.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'materials.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'materials.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'materials.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Materials',
                    'icon' => 'fas fa-file-alt',
                    'route' => 'materials',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'materials.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Materi Mapel',
                    'icon' => 'fas fa-file-alt',
                    'route' => 'materials',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'materials.access',
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
            ],
        ];

        $this->db->table('materials')->insertBatch($data);
    }
}
