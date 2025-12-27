<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedStudents extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'students.access',
                'title' => 'Can access the students area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'students.create',
                'title' => 'Can create sub students',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'students.edit',
                'title' => 'Can update sub students',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'students.delete',
                'title' => 'Can delete sub students',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'students.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'students.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'students.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'students.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Students',
                'icon' => 'fas fa-list',
                'route' => 'students',
                'order' => 5,
                'active' => 1,
                'permission' => 'students.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'user_id' => 1,
                'nis' => '8889999',
                'nisn' => '8889999',
                'full_name' => 'Jajang Dadan',
                'gender' => 'L',
                'birth_place' => 'Subang',
                'birth_date' => '2025-12-20',
                'address' => 'Subang',
                'phone' => '08XXXXXXXXXX',
                'parent_name' => 'Kang Ibing',
                'photo' => 'student..png',
            ],
        ];

        $this->db->table('students')->insertBatch($data);
    }
}
