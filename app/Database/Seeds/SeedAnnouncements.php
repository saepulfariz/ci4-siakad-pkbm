<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAnnouncements extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'announcements.access',
                'title' => 'Can access the announcements area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'announcements.create',
                'title' => 'Can create sub announcements',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'announcements.edit',
                'title' => 'Can update sub announcements',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'announcements.delete',
                'title' => 'Can delete sub announcements',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'announcements.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'announcements.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'announcements.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'announcements.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Announcements',
                'icon' => 'fas fa-list',
                'route' => 'announcements',
                'order' => 5,
                'active' => 1,
                'permission' => 'announcements.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'title' => 'Test',
                'content' => 'Test',
            ],
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}
