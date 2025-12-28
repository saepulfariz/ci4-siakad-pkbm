<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedClassSubjects extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'class-subjects.access',
                'title' => 'Can access the class-subjects area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'class-subjects.create',
                'title' => 'Can create sub class-subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'class-subjects.edit',
                'title' => 'Can update sub class-subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'class-subjects.delete',
                'title' => 'Can delete sub class-subjects',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'class-subjects.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'class-subjects.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'class-subjects.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'class-subjects.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Class Subjects',
                'icon' => 'fas fa-list',
                'route' => 'class-subjects',
                'order' => 5,
                'active' => 1,
                'permission' => 'class-subjects.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'class_id' => 1,
                'subject_id' => 1,
            ],
        ];

        $this->db->table('class_subjects')->insertBatch($data);
    }
}
