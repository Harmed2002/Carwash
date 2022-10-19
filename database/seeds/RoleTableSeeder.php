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
        $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'id'    => 1,
                'name' => 'Super admin',
                'guard_name' => 'web',
            ],
            
        ];

        Role::insert($roles);
    }
}
