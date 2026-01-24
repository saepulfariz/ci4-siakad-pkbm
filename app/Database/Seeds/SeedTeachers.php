<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserIdentityModel;

class SeedTeachers extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'teacher',
                'title' => 'Teacher',
                'description' => 'Has access to teacher features.',
                'created_at' => '2026-01-04 04:08:00',
                'updated_at' => '2026-01-04 04:08:00',
            ],
        ];

        // $this->db->table('auth_groups')->insertBatch($data);

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

        $users = auth()->getProvider();
        $model_user_identity = new UserIdentityModel();

        // Buat user baru
        $user = new User([
            'email'    => 'teacher@mail.com',
            'username' => 'teacher',
            'password' => '123', // Shield akan meng-hash ini secara otomatis
        ]);

        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        $model_user_identity->update($users->getInsertID(), ['name' => 'Teacher']);

        // Add to default group
        $user->addGroup('teacher');



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

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Teachers',
                    'icon' => 'fas fa-chalkboard-teacher',
                    'route' => 'teachers',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'teachers.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Tutor',
                    'icon' => 'fas fa-chalkboard-teacher',
                    'route' => 'teachers',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'teachers.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'user_id' => 3,
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
