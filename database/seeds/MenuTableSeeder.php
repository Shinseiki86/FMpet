<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Permission;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderMenuLeft = 0;
        $orderMenuTop = 0;


        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Admin',
            'MENU_ICON' => 'fas fa-cogs',
            'MENU_ORDER' => $orderMenuLeft++,
        ]);

            $orderItem2 = 0;
            $parent2 = Menu::create([
                'MENU_LABEL' => 'Usuarios y roles',
                'MENU_ICON' => 'fas fa-user-circle',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
            ]);
                Menu::create([
                    'MENU_LABEL' => 'Usuarios',
                    'MENU_URL' => 'auth/usuarios',
                    'MENU_ICON' => 'fas fa-user',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('user-index'),
                ]);
                Menu::create([
                    'MENU_LABEL' => 'Roles',
                    'MENU_URL' => 'auth/roles',
                    'MENU_ICON' => 'fas fa-male',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('role-index'),
                ]);
                Menu::create([
                    'MENU_LABEL' => 'Permisos',
                    'MENU_URL' => 'auth/permisos',
                    'MENU_ICON' => 'fas fa-address-card',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('permission-index'),
                ]);

            $orderItem2 = 0;
            $parent2 = Menu::create([
                'MENU_LABEL' => 'Geográficos',
                'MENU_ICON' => 'fas fa-globe-americas',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
            ]);
                Menu::create([
                    'MENU_LABEL' => 'Países',
                    'MENU_URL' => 'cnfg-geograficos/paises',
                    'MENU_ICON' => 'fas fa-map-marker-alt',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('pais-index'),
                ]);
                Menu::create([
                    'MENU_LABEL' => 'Departamentos',
                    'MENU_URL' => 'cnfg-geograficos/departamentos',
                    'MENU_ICON' => 'fas fa-map-marker-alt',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('departamento-index'),
                ]);
                Menu::create([
                    'MENU_LABEL' => 'Ciudades',
                    'MENU_URL' => 'cnfg-geograficos/ciudades',
                    'MENU_ICON' => 'fas fa-map-marker-alt',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('ciudad-index'),
                ]);
                Menu::create([
                    'MENU_LABEL' => 'Barrios',
                    'MENU_URL' => 'cnfg-geograficos/barrios',
                    'MENU_ICON' => 'fas fa-map-marker-alt',
                    'MENU_PARENT' => $parent2->MENU_ID,
                    'MENU_ORDER' => $orderItem2++,
                    'PERM_ID' => $this->getPermission('barrio-index'),
                ]);

            Menu::create([
                'MENU_LABEL' => 'Menú',
                'MENU_URL' => 'app/menu',
                'MENU_ICON' => 'fas fa-bars',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'MENU_ENABLED' => true,
                'PERM_ID' => $this->getPermission('app-menu'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Carga masiva',
                'MENU_URL' => 'app/upload',
                'MENU_ICON' => 'fas fa-cog',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('app-upload'),
            ]);
            Menu::create([
                'MENU_LABEL' => 'Parámetros del Sistema',
                'MENU_URL' => 'app/parametrosgenerales',
                'MENU_ICON' => 'fas fa-bolt',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('app-parametrosgenerales'),
            ]);
            /*Menu::create([
                'MENU_LABEL' => 'Parámetros generales',
                'MENU_URL' => 'app/parameters',
                'MENU_ICON' => 'fas fa-cog',
                'MENU_PARENT' => $parent->MENU_ID,
                'MENU_ORDER' => $orderItem++,
                'PERM_ID' => $this->getPermission('app-parameters'),
           ]);*/

        $orderItem = 0;
        $parent = Menu::create([
            'MENU_LABEL' => 'Reportes',
            'MENU_ICON' => 'fas fa-filter',
            'MENU_URL' => 'reportes',
            'MENU_ORDER' => $orderMenuLeft++,
            'PERM_ID' => $this->getPermission('reportes'),
        ]);

		
    //TOP
        Menu::create([
            'MENU_LABEL' => 'Google',
            'MENU_URL' => 'http://www.google.com',
            'MENU_ICON' => 'fab fa-google',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
            'PERM_ID' => null,
        ]);
        Menu::create([
            'MENU_LABEL' => 'Facebook',
            'MENU_URL' => 'http://www.facebook.com',
            'MENU_ICON' => 'fab fa-facebook',
            'MENU_ORDER' => $orderMenuTop++,
            'MENU_POSITION' => 'TOP',
            'PERM_ID' => null,
        ]);

    }

	
    //Obtiene el permiso
    private function getPermission($namePermission)
    {
        $perm = Permission::where('name', $namePermission)->get()->first();
        if(isset($perm))
            return $perm->id;
        return null;
    }
}
