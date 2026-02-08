<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedReportLogins extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'report-logins.access',
                'title' => 'Can access the report-logins',
                'created_at' => '2025-02-08 10:09:00',
                'updated_at' => '2025-02-08 10:09:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'report-logins.access',
                'created_at' => '2025-02-08 10:09:00',
                'updated_at' => '2025-02-08 10:09:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Report Logins',
                    'icon' => 'fas fa-list',
                    'route' => 'report-logins',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'report-logins.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Report Login',
                    'icon' => 'fas fa-list',
                    'route' => 'report-logins',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'report-logins.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);
    }
}
