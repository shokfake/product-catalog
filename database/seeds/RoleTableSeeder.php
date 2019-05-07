<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ];

        $role = Role::create(['name' => 'Super Admin']);
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Admin managers']);
        $role->syncPermissions(
            [
                'category-list',
                'product-list',
                'product-create',
                'product-edit'
            ]);

        $role = Role::create(['name' => 'User']);
        $role->syncPermissions(['product-list','category-list']);
    }
}
