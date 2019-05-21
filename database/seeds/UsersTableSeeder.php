<?php
    
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder {

    private $rolOwner;
    private $rolAdmin;
    private $rolGestHum;

    public function run() {

        $pass = '123';

        //*********************************************************************
        $this->command->info('--- Seeder Creación de Roles');

        $this->rolOwner = Role::create([
            'name'         => 'owner',
            'display_name' => 'Project Owner',
            'description'  => 'User is the owner of a given project',
        ]);
        $this->rolAdmin = Role::create([
            'name'         => 'admin',
            'display_name' => 'Administrador',
            'description'  => 'User is allowed to manage and edit other users',
        ]);
        $this->rolGestHum = Role::create([
            'name'         => 'gesthum',
            'display_name' => 'Gestión Humana',
            //'description'  => 'Comentario',
        ]);
        $rolSuperOper = Role::create([
            'name'         => 'superoper',
            'display_name' => 'Supervisor Operaciones',
            //'description'  => 'Comentario',
        ]);
        $rolCoorOper = Role::create([
            'name'         => 'cooroper',
            'display_name' => 'Coordinador Operaciones',
            //'description'  => 'Comentario',
        ]);
        $rolEmpleado = Role::create([
            'name'         => 'empleado',
            'display_name' => 'Empleado',
            //'description'  => 'Comentario',
        ]);
        $rolEjecutivo = Role::create([
            'name'         => 'ejecutivo',
            'display_name' => 'Ejecutivo de Cuenta',
            //'description'  => 'Comentario',
        ]);


        //*********************************************************************
        $this->command->info('--- Seeder Creación de Usuarios prueba');

        //Admin
        $admin = User::firstOrcreate( [
            'name' => 'Administrador',
            'cedula' => 1,
            'username' => 'admin',
            'email' => 'sghmasterpromo@gmail.com',
            'password'  => \Hash::make($pass),
        ]);
        $admin->attachRole($this->rolAdmin);

        //Owner
        $owner = User::create( [
            'name' => 'Owner',
            'cedula' => 2,
            'username' => 'owner',
            'email' => 'owner@mail.com',
            'password'  => \Hash::make($pass),
        ]);
        $owner->attachRoles([$this->rolAdmin, $this->rolOwner]);
        
        //Editores
        $gesthum1 = User::create( [
            'name' => 'Gestión humana 1 de prueba',
            'cedula' => 444444444,
            'username' => 'gesthum1',
            'email' => 'kfrodriguez@misena.edu.co',
            'password'  => \Hash::make($pass),
            'USER_CREADOPOR'  => 'PRUEBAS'
        ]);
        $gesthum1->attachRole($this->rolGestHum);

        $super = User::create( [
            'name' => 'Supervisor de prueba',
            'cedula' => 555555555,
            'username' => 'superoper',
            'email' => 'coordinadornomin@aseoregional.com',
            'password'  => \Hash::make($pass),
            'USER_CREADOPOR'  => 'PRUEBAS'
        ]);
        $super->attachRoles([$rolSuperOper, $rolCoorOper, $rolEjecutivo]);

        $coordi = User::create( [
            'name' => 'Coordinador de prueba',
            'cedula' => 6666666666,
            'username' => 'coordi',
            'email' => 'coordi@outlook.com',
            'password'  => \Hash::make($pass),
            'USER_CREADOPOR'  => 'PRUEBAS'
        ]);
        $coordi->attachRole($rolCoorOper);

        $ejecutivo = User::create( [
            'name' => 'Ejecutivo de prueba',
            'cedula' => 7777777777,
            'username' => 'ejecutivo',
            'email' => 'ejecutivo@gmail.com',
            'password'  => \Hash::make($pass),
            'USER_CREADOPOR'  => 'PRUEBAS'
        ]);
        $ejecutivo->attachRole($rolEjecutivo);

        //5 usuarios faker
        //$users = factory(App\User::class)->times(5)->create();

        //DB::table('oauth_clients')->where('id',2)->update(['secret'=>'UW59wSYQ2bjP5LqS6hAygpfHSzq37jamkKHJI7VX']);

    }
}