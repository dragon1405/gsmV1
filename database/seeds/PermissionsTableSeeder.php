<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuarios
    	Permission::create(array(
    		'name' 		  => 'Ver usuarios',
    		'slug'		  => 'users.index',
    		'description' => 'Puede ver los usuarios',
    	));

        Permission::create(array(
        	'name' 		  => 'Detalles usuarios',
        	'slug'		  => 'users.show',
        	'description' => 'Puede ver especificaciones de los usuarios',
        ));
        Permission::create(array(
        	'name' 		  => 'Crear usuarios',
        	'slug'		  => 'users.create',
        	'description' => 'Puede crear nuevos usuarios',
        ));
        Permission::create([
        	'name' 		  => 'Editar usuarios',
        	'slug'		  => 'users.edit',
        	'description' => 'Puede editar datos del usuario',
        ]);
        Permission::create([
        	'name' 		  => 'Eliminar usuarios',
        	'slug'		  => 'users.destroy',
        	'description' => 'Puede eliminar el usuario',
        ]);

        //Grupos o roles
        Permission::create([
        	'name' 		  => 'Ver roles o grupos',
        	'slug'		  => 'roles.index',
        	'description' => 'Puede ver de roles o grupos',
    	]);

        Permission::create([
        	'name' 		  => 'Detalles roles o grupos',
        	'slug'		  => 'roles.show',
        	'description' => 'Puede ver especificaciones roles o grupos',
        ]);
        Permission::create([
        	'name' 		  => 'Crear roles o grupos',
        	'slug'		  => 'roles.create',
        	'description' => 'Puede crear nuevos roles o grupos',
        ]);
        Permission::create([
        	'name' 		  => 'Editar roles o grupos',
        	'slug'		  => 'roles.edit',
        	'description' => 'Puede editar datos de roles o grupos',
        ]);
        Permission::create([
        	'name' 		  => 'Eliminar roles o grupos',
        	'slug'		  => 'roles.destroy',
        	'description' => 'Puede eliminar roles o grupos',
        ]);

        //Proyectos
        Permission::create([
        	'name' 		  => 'Ver Proyectos',
        	'slug'		  => 'projects.index',
        	'description' => 'Puede ver de proyectos',
    	]);

        Permission::create([
        	'name' 		  => 'Detalles Proyectos',
        	'slug'		  => 'projects.show',
        	'description' => 'Puede ver especificaciones de proyectos',
        ]);
        Permission::create([
        	'name' 		  => 'Crear proyectos',
        	'slug'		  => 'projects.create',
        	'description' => 'Puede crear nuevos proyectos',
        ]);
        Permission::create([
        	'name' 		  => 'Editar proyectos',
        	'slug'		  => 'projects.edit',
        	'description' => 'Puede editar datos de proyectos',
        ]);
        Permission::create([
        	'name' 		  => 'Eliminar proyectos',
        	'slug'		  => 'projects.destroy',
        	'description' => 'Puede eliminar proyectos',
        ]);

        Role::create([
            'name'        => 'Admin',
            'slug'        => 'admin',
            'special'     => 'all-access',
        ]);
          Role::create([
            'name'        => 'Director',
            'slug'        => 'dir',
        ]);
           Role::create([
            'name'        => 'Manager',
            'slug'        => 'mng',
        ]);
            Role::create([
            'name'        => 'User',
            'slug'        => 'user',
        ]);
            User::create([
            'id'          =>    '666',
            'name'        => 'Misraim Levi',
            'email'       => 'dragon@dragon.com',
            'password'    => bcrypt('12345678'),
        ]);
            DB::table('role_user')->insert([
                'role_id'   =>'1',
                'user_id'   =>'666'
            ]);
    }
}



