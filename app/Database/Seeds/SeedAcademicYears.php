<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAcademicYears extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'academic-years.access',
                'title' => 'Can access the academic-years area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'academic-years.create',
                'title' => 'Can create sub academic-years',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'academic-years.edit',
                'title' => 'Can update sub academic-years',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'academic-years.delete',
                'title' => 'Can delete sub academic-years',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'academic-years.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'academic-years.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'academic-years.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'academic-years.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Academic Years',
                'icon' => 'fas fa-list',
                'route' => 'academic-years',
                'order' => 5,
                'active' => 1,
                'permission' => 'academic-years.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'name' => '2024-2025',
                'start_year' => '2024',
                'end_year' => '2025',
                'is_active' => 1,
            ],
            [
                'name' => '2025-2026',
                'start_year' => '2025',
                'end_year' => '2026',
                'is_active' => 0,
            ],
        ];

        $this->db->table('academic_years')->insertBatch($data);
    }
}
