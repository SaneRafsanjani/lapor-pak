<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissonSeeder extends Seeder
{
    private $permissions = [
        'dashboard' => ['view'],

        'user' => [
            'view',
            'create',
            'edit',
            'delete',
        ],

        'resident' => [
            'view',
            'create',
            'edit',
            'delete',
        ],

        'report-category' => [
            'view',
            'create',
            'edit',
            'delete',
        ],

        'report' => [
            'view',
            'create',
            'edit',
            'delete',
        ],

        'report-status' => [
            'view',
            'create',
            'edit',
            'delete',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat semua permission
        foreach ($this->permissions as $key => $value) {
            foreach ($value as $permission) {
                Permission::firstOrCreate([
                    'name' => $key . '_' . $permission,
                    'guard_name' => 'web', // disarankan tambah guard_name
                ]);
            }
        }

        // Role Admin
        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ])->givePermissionTo(Permission::all());

        // Role Resident
        Role::firstOrCreate([
            'name' => 'resident',
            'guard_name' => 'web'
        ])->givePermissionTo([
            'report-category_view',
            'report_view',
            'report_create',
            'report_edit',
            'report_delete',
            'report-status_view',
        ]);
    }
}
