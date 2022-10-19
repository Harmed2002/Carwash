<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Admin\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user = User::create(array(
            'name' => 'Administrador del sistema',
            'email' => 'admin@localhost.com',
            'password' => bcrypt('123456'),
        ));

        $user = User::create(array(
            'name' => 'Super administrador del sistema',
            'email' => 'adminRoot@localhost.com',
            'password' => bcrypt('123456'),
        ));
       
    }
}
