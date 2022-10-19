<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $permissions = [
            [
                'id'    => '1',
                'name' => 'Lista de permisos',
                'guard_name' => 'web',
            ],
            [
                'id'    => '2',
                'name' => 'Guardar permisos',
                'guard_name' => 'web',
            ],
            [
                'id'    => '3',
                'name' => 'Eliminar permisos',
                'guard_name' => 'web',
            ],
            [
                'id'    => '4',
                'name' => 'Lista de roles',
                'guard_name' => 'web',
            ],
            [
                'id'    => '5',
                'name' => 'Guardar roles',
                'guard_name' => 'web',
            ],
            [
                'id'    => '6',
                'name' => 'Eliminar roles',
                'guard_name' => 'web',
            ],
            [
                'id'    => '7',
                'name' => 'Lista de usuarios',
                'guard_name' => 'web',
            ],
            [
                'id'    => '8',
                'name' => 'Guardar usuarios',
                'guard_name' => 'web',
            ],
            [
                'id'    => '9',
                'name' => 'Eliminar usuarios',
                'guard_name' => 'web',
            ],

            // [
            //     'id'    => '10',
            //     'name' => 'Lista de asociación de usuario y roles',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'id'    => '11',
            //     'name' => 'Formulario de asociación de usuario y roles',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'id'    => '12',
            //     'name' => 'Guardar de asociación de usuario y roles',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'id'    => '13',
            //     'name' => 'Eliminar asociación de usuario y roles',
            //     'guard_name' => 'web',
            // ],

            // [
            //     'id'    => '14',
            //     'name' => 'Lista de asociación de rol y permisos',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'id'    => '15',
            //     'name' => 'Formulario de asociación de rol y permisos',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'id'    => '16',
            //     'name' => 'Guardar asociación de rol y permisos',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'id'    => '17',
            //     'name' => 'Eliminar asociación de rol y permisos',
            //     'guard_name' => 'web',
            // ],
            [
                'id'    => '18',
                'name' => 'Formulario de usuarios',
                'guard_name' => 'web',
            ],
            [
                'id'    => '19',
                'name' => 'Formulario de permisos',
                'guard_name' => 'web',
            ],
            [
                'id'    => '20',
                'name' => 'Formulario de roles',
                'guard_name' => 'web',
            ],

            [
                'id'    => '21',
                'name' => 'Listado viaticos y otros',
                'guard_name' => 'web'
            ],
            [
                'id'    => '22',
                'name' => 'Formulario viaticos y otros',
                'guard_name' => 'web'
            ],
            [
                'id'    => '23',
                'name' => 'Guardar viaticos y otros',
                'guard_name' => 'web'
            ],
            [
                'id'    => '24', 
                'name' => 'Eliminar viaticos y otros',
                'guard_name' => 'web'
            ],


            [
                'id'    => '25',
                'name' => 'Lista de Descarga de carrotanque',
                'guard_name' => 'web'
            ],
            [
                'id'    => '26', 
                'name' => 'Formulario de Descarga de carrotanque',
                'guard_name' => 'web'
            ],
            [
                'id'    => '27', 
                'name' => 'Guardar de Descarga de carrotanque',
                'guard_name' => 'web'
            ],
            [
                'id'    => '28', 
                'name' => 'Eliminar de Descarga de carrotanque',
                'guard_name' => 'web'
            ],

            [
                'id'    => '29', 
                'name' => 'Lista de carga de cubitanques',
                'guard_name' => 'web'
            ],
            [
                'id'    => '30', 
                'name' => 'Formulario de carga de cubitanques',
                'guard_name' => 'web'
            ],
            [
                'id'    => '31',  
                'name' => 'Guardar de carga de cubitanques',
                'guard_name' => 'web'
            ],
            [
                'id'    => '32', 
                'name' => 'Eliminar de carga de cubitanques',
                'guard_name' => 'web'
            ],

            [
                'id'    => '33',  
                'name' => 'Lista de máquinas de tanqueo',
                'guard_name' => 'web'
            ],
            [
                'id'    => '34',  
                'name' => 'Formulario de máquinas de tanqueo',
                'guard_name' => 'web'
            ],
            [
                'id'    => '35',  
                'name' => 'Guardar de máquinas de tanqueo',
                'guard_name' => 'web'
            ],
            [
                'id'    => '36',  
                'name' => 'Eliminar de máquinas de tanqueo',
                'guard_name' => 'web'
            ],

            [
                'id'    => '37', 
                'name' => 'Lista de movimiento de material',
                'guard_name' => 'web'
            ],
            [
                'id'    => '38', 
                'name' => 'Formulario de movimiento de material',
                'guard_name' => 'web'
            ],
            [
                'id'    => '39', 
                'name' => 'Guardar de movimiento de material',
                'guard_name' => 'web'
            ],
            [
                'id'    => '40', 
                'name' => 'Eliminar de movimiento de material',
                'guard_name' => 'web'
            ],
            [
                'id'    => '41', 
                'name' => 'Cambio de estado',
                'guard_name' => 'web'
            ],






        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
