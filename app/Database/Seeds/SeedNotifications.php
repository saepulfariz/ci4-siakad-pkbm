<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedNotifications extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'notifications.access',
                'title' => 'Can access the notifications area',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'notifications.create',
                'title' => 'Can create sub notifications',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'notifications.edit',
                'title' => 'Can update sub notifications',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'name' => 'notifications.delete',
                'title' => 'Can delete sub notifications',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'notifications.access',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'notifications.create',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'notifications.edit',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'notifications.delete',
                'created_at' => '2025-12-25 21:52:00',
                'updated_at' => '2025-12-25 21:52:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        $data = [
            [
                'parent_id' => NULL,
                'title' => 'Notifications',
                'icon' => 'fas fa-list',
                'route' => 'notifications',
                'order' => 5,
                'active' => 1,
                'permission' => 'notifications.access',
            ],
        ];

        $this->db->table('auth_menus')->insertBatch($data);

        $data = [
            [
                'user_id' => 1,
                'title' => 'Test Notif',
                'message' => 'Tes',
                'status' => 'Unread',
            ],
        ];

        $this->db->table('notifications')->insertBatch($data);
    }
}
