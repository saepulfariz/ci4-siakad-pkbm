<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAttendances extends Seeder
{
    public function run()
    {
        $data = [

            [
                'name' => 'attendances.access',
                'title' => 'Can access the attendances',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'name' => 'attendances.access-all',
                'title' => 'Can access the attendances all',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'name' => 'attendances.create',
                'title' => 'Can create attendances',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'name' => 'attendances.edit',
                'title' => 'Can update attendances',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'name' => 'attendances.delete',
                'title' => 'Can delete attendances',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],

            [
                'name' => 'attendances.sunday',
                'title' => 'Can create attendance sunday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'name' => 'attendances.monday',
                'title' => 'Can create attendance monday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'name' => 'attendances.tuesday',
                'title' => 'Can create attendance tuesday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'name' => 'attendances.wednesday',
                'title' => 'Can create attendance wednesday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'name' => 'attendances.thursday',
                'title' => 'Can create attendance thursday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'name' => 'attendances.friday',
                'title' => 'Can create attendance friday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'name' => 'attendances.saturday',
                'title' => 'Can create attendance saturday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
        ];

        $this->db->table('auth_permissions')->insertBatch($data);

        $data = [
            [
                'group_id' => 1,
                'permission' => 'attendances.access',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.access-all',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.create',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.edit',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.delete',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],

            [
                'group_id' => 1,
                'permission' => 'attendances.sunday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.monday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.tuesday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.wednesday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.thursday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.friday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 1,
                'permission' => 'attendances.saturday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],


            [
                'group_id' => 2,
                'permission' => 'attendances.access',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'group_id' => 2,
                'permission' => 'attendances.create',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],

            [
                'group_id' => 2,
                'permission' => 'attendances.sunday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 2,
                'permission' => 'attendances.saturday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],


            [
                'group_id' => 3,
                'permission' => 'attendances.access',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'attendances.create',
                'created_at' => '2026-02-02 05:34:00',
                'updated_at' => '2026-02-02 05:34:00',
            ],


            [
                'group_id' => 3,
                'permission' => 'attendances.sunday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
            [
                'group_id' => 3,
                'permission' => 'attendances.saturday',
                'created_at' => '2026-02-08 16:53:00',
                'updated_at' => '2026-02-08 16:53:00',
            ],
        ];

        $this->db->table('auth_permissions_groups')->insertBatch($data);

        if (ENVIRONMENT === 'development') {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Attendances',
                    'icon' => 'fas fa-calendar-check',
                    'route' => 'attendances',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'attendances.access',
                ],
            ];
        } else {
            $data = [
                [
                    'parent_id' => NULL,
                    'title' => 'Absensi',
                    'icon' => 'fas fa-calendar-check',
                    'route' => 'attendances',
                    'order' => 5,
                    'active' => 1,
                    'permission' => 'attendances.access',
                ],
            ];
        }

        $this->db->table('auth_menus')->insertBatch($data);
    }
}
