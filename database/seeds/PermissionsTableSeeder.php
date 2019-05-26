<?php
    
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder {

    private $rolOwner;
    private $rolAdmin;
    private $rolGestHum;
    private $rolEjecutivo;
    private $rolSuperOper;
    private $rolCoorOper;
    private $rolEmpleado;

    public function run(){

        $this->getRoles();
        $this->createpermissionsSystem();
        $this->command->info('--- Seeder Creación de Permisos');

        //Permisos para el negocio
        //$this->createPermissions(Modelo::class, 'modelo display_name', 'description...', true, false);
        $this->createPermissions(Pais::class, 'países', null, true, false);
        $this->createPermissions(Departamento::class, 'departamentos', null, true, false);
        $this->createPermissions(Ciudad::class, 'ciudades', null, true, false);
        $this->createPermissions(Barrio::class, 'barrios', null, true, false);
        
        $permMasc = $this->createPermissions(Mascota::class, 'mascotas', null, true, false);
        $this->rolEmpleado->attachPermissions($permMasc);
        $permPers = $this->createPermissions(Persona::class, 'personas', null, true, false);
        $this->rolEmpleado->attachPermissions($permPers);
        $permPubl = $this->createPermissions(Publicacion::class, 'publicaciones', null, true, false);
        $this->rolEmpleado->attachPermissions($permPubl);
    }


    private function createPermissions($name, $display_name, $description = null, $attachAdmin=true, $attachGestHum=true)
    {
        $name = strtolower(last(explode('\\',basename(get_model($name)))));

        if($description == null)
            $description = $display_name;

        $create = Permission::create([
            'name'         => $name.'-create',
            'display_name' => 'Crear '.$display_name,
            'description'  => 'Crear '.$description,
        ]);
        $edit = Permission::create([
            'name'         => $name.'-edit',
            'display_name' => 'Editar '.$display_name,
            'description'  => 'Editar '.$description,
        ]);
        $index = Permission::create([
            'name'         => $name.'-index',
            'display_name' => 'Listar '.$display_name,
            'description'  => 'Listar '.$description,
        ]);
        $delete = Permission::create([
            'name'         => $name.'-delete',
            'display_name' => 'Borrar '.$display_name,
            'description'  => 'Borrar '.$description,
        ]);

        if($attachAdmin)
            $this->rolAdmin->attachPermissions([$index, $create, $edit, $delete]);

        if($attachGestHum)
            $this->rolGestHum->attachPermissions([$index, $create, $edit]);

        return compact('create', 'edit', 'index', 'delete');
    }


    private function getRoles() {
        $roles = Role::all();
        $this->rolOwner = $roles->where('name', 'owner')->first();
        $this->rolAdmin = $roles->where('name', 'admin')->first();
        $this->rolGestHum = $roles->where('name', 'gesthum')->first();
        $this->rolEjecutivo = $roles->where('name', 'ejecutivo')->first();
        $this->rolSuperOper = $roles->where('name', 'superoper')->first();
        $this->rolCoorOper = $roles->where('name', 'cooroper')->first();
        $this->rolEmpleado = $roles->where('name', 'empleado')->first();
    }


    private function createpermissionsSystem()
    {
        
        //Permisos del sistema
        $menu = Permission::create([
            'name'         => 'app-menu',
            'display_name' => 'Administrar menú',
            'description'  => 'Permite crear, eliminar y ordenar el menú del sistema.',
        ]);
        $uploads = Permission::create([
            'name'         => 'app-upload',
            'display_name' => 'Cargas masivas',
            'description'  => '¡CUIDADO! Permite realizar cargas masivas de datos en el sistema.',
        ]);
        $parametersg = Permission::create([
            'name'         => 'app-parameterglobal',
            'display_name' => 'Parámetros generales',
            'description'  => 'Permite crear, eliminar y ordenar los parámetros generales del sistema.',
        ]);
        $dashboard = Permission::create([
            'name'         => 'app-dashboard',
            'display_name' => 'Dashboard',
            'description'  => 'Muestra panel con KPIs y reportes gráficos.',
        ]);
        $this->rolOwner->attachPermissions([$menu, $parametersg, $uploads]);
        $this->rolAdmin->attachPermissions([$menu, $parametersg, $uploads, $dashboard]);

        $reports = Permission::create([
            'name'         => 'report-index',
            'display_name' => 'Reportes',
            'description'  => 'Permite ejecutar reportes y exportarlos.',
        ]);
        $this->rolOwner->attachPermission($reports);
        $this->rolAdmin->attachPermission($reports);
        //$this->rolGestHum->attachPermission($reports);
        $this->rolEjecutivo->attachPermission($reports);
        $this->rolSuperOper->attachPermission($reports);
        $this->rolCoorOper->attachPermission($reports);

        $this->createPermissions(User::class, 'usuarios', null,  true, false);
        $this->createPermissions(Permission::class, 'permisos', null, true, false);
        $this->createPermissions(Role::class, 'roles', null, true, false);

    }

}