<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedEducations extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'educations.access',
                'title' => 'Can access the educations area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'educations.create',
                'title' => 'Can create sub educations',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'educations.edit',
                'title' => 'Can update sub educations',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'educations.delete',
                'title' => 'Can delete sub educations',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'educations.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'educations.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'educations.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'educations.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Educations',
                    'icon' => 'fas fa-university',
                    'route' => 'educations',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'educations.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Jenjang Pendidikan',
                    'icon' => 'fas fa-university',
                    'route' => 'educations',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'educations.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'teacher_id' => 1,
                'name' => 'PKBM',
                'unit' => 'PKBM',
            ],
        ];

        $this->db->table('educations')->insertBatch($data);
    }
}
