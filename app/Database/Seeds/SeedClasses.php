<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedClasses extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'classes.access',
                'title' => 'Can access the classes area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'classes.create',
                'title' => 'Can create sub classes',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'classes.edit',
                'title' => 'Can update sub classes',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'classes.delete',
                'title' => 'Can delete sub classes',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'classes.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'classes.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'classes.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'classes.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Classes',
                'icon' => 'fas fa-list',
                'route' => 'classes',
                'order' => 5,
                'active' => 1,
                'permission' => 'classes.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'parent_id' => null,
                'name' => 'X',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => 1,
                'name' => 'X A',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => 1,
                'name' => 'X B',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => null,
                'name' => 'XI',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => 4,
                'name' => 'XI A',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => 4,
                'name' => 'XI B',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => null,
                'name' => 'XII',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => 7,
                'name' => 'XII A',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
            [
                'parent_id' => 7,
                'name' => 'XII B',
                'teacher_id' => 1,
                'education_id' => 1,
            ],
        ];

        $this->db->table('classes')->insertBatch($data);
    }
}
