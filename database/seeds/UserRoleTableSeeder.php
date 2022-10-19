<?php

use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::find(1);
        $roles = Role::find(1);
        $user->roles()->sync($roles);

        $userSuper = User::find(2);
        $roleSuper = Role::find(2);
        $userSuper->roles()->sync($roleSuper);
        // $user->assignRole($role);
    }
}
