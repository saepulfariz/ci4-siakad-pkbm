<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedSemesters extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'semesters.access',
                'title' => 'Can access the semesters area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'semesters.create',
                'title' => 'Can create sub semesters',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'semesters.edit',
                'title' => 'Can update sub semesters',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'semesters.delete',
                'title' => 'Can delete sub semesters',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'semesters.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'semesters.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'semesters.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'semesters.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Semesters',
                'icon' => 'fas fa-list',
                'route' => 'semesters',
                'order' => 5,
                'active' => 1,
                'permission' => 'semesters.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'academic_year_id' => 1,
                'name' => 'Ganjil',
                'start_date' => '2025-07-01',
                'end_date' => '2025-12-20',
                'is_active' => 1,
            ],
            [
                'academic_year_id' => 1,
                'name' => 'Genap',
                'start_date' => '2026-01-12',
                'end_date' => '2026-06-20',
                'is_active' => 0,
            ],
        ];

        $this->db->table('semesters')->insertBatch($data);
    }
}
