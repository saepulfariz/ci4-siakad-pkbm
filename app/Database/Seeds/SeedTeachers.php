<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedTeachers extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'teachers.access',
                'title' => 'Can access the teachers area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'teachers.create',
                'title' => 'Can create sub teachers',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'teachers.edit',
                'title' => 'Can update sub teachers',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'teachers.delete',
                'title' => 'Can delete sub teachers',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'teachers.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'teachers.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'teachers.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'teachers.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Teachers',
                'icon' => 'fas fa-list',
                'route' => 'teachers',
                'order' => 5,
                'active' => 1,
                'permission' => 'teachers.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'user_id' => 1,
                'nip' => '8889999',
                'full_name' => 'Aceng Dadan',
                'gender' => 'L',
                'birth_place' => 'Subang',
                'birth_date' => '2025-12-20',
                'address' => 'Subang',
                'phone' => '08XXXXXXXXXX',
                'education' => 'SMK BISA',
                'photo' => 'teacher.png',
            ],
        ];

        $this->db->table('teachers')->insertBatch($data);
    }
}
