<?php namespace App\Modules\ActiveDirectoryInspector\Utils;

use Sroutier\L51ESKModules\Contracts\ModuleMaintenanceInterface;
use App\Models\Menu;
use App\Models\Route;
use App\Models\Permission;
use App\Models\Role;
use DB;

class ActiveDirectoryInspectorMaintenance implements ModuleMaintenanceInterface {


    static public function initialize()
    {

        DB::transaction(function () {

            //Register module routes.
            $routeHome = Route::firstOrCreate([
                'name' => 'activedirectoryinspector.home',
                'method' => 'GET',
                'path' => 'activedirectoryinspector',
                'action_name' => 'App\Modules\ActiveDirectoryInspector\Http\Controllers\ActiveDirectoryInspectorController@home',
                'enabled' => 1,
            ]);
            $routeShow = Route::firstOrCreate([
                'name' => 'activedirectoryinspector.show',
                'method' => 'GET',
                'path' => 'activedirectoryinspector/show/{dn}',
                'action_name' => 'App\Modules\ActiveDirectoryInspector\Http\Controllers\ActiveDirectoryInspectorController@show',
                'enabled' => 1,
            ]);
            $routeSearch = Route::firstOrCreate([
                'name' => 'activedirectoryinspector.search',
                'method' => 'POST',
                'path' => 'activedirectoryinspector/search',
                'action_name' => 'App\Modules\ActiveDirectoryInspector\Http\Controllers\ActiveDirectoryInspectorController@search',
                'enabled' => 1,
            ]);

            // Create permissions required by module
            $permUseActiveDirectoryInspector = Permission::firstOrCreate([
                'name' => 'use-activedirectoryinspector',
                'display_name' => 'Use ActiveDirectoryInspector',
                'description' => 'Allows a user to use the ActiveDirectoryInspector module.',
                'enabled' => true,
            ]);

            // Associate module permissions to the module routes
            $routeHome->permission()->associate($permUseActiveDirectoryInspector);
            $routeHome->save();
            $routeShow->permission()->associate($permUseActiveDirectoryInspector);
            $routeShow->save();
            $routeSearch->permission()->associate($permUseActiveDirectoryInspector);
            $routeSearch->save();

            // Create a role for the module
            $roleActiveDirectoryInspector = Role::firstOrCreate([
                "name" => "activedirectoryinspector-users",
                "display_name" => "ActiveDirectoryInspector Users",
                "description" => "Users of the ActiveDirectoryInspector module.",
                "enabled" => true
            ]);
            // Assign module permission to new role.
            $roleActiveDirectoryInspector->perms()->sync([$permUseActiveDirectoryInspector->id]);

            // Get handle on home menu as the parent.
            $parentMenu = Menu::where('name', 'home')->first();
            // If home menu was not found, the site admin, must have customized the menu system.
            // Best to create our menu under root and let the admin work it out.
            if (!$parentMenu) {
                $parentMenu = Menu::where('name', 'root')->first();
            }

            // Create modules menu container/folder.
            $menuToolsContainer = Menu::firstOrCreate([
                'name'          => 'tools-container',
                'label'         => 'Tools',
                'position'      => 10,
                'icon'          => 'fa fa-wrench',
                'separator'     => false,
                'url'           => null,                // No url.
                'enabled'       => true,
                'parent_id'     => $parentMenu->id,     // Parent is home or root.
                'route_id'      => null,                // No route
                'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                        // any sub-items, the menu will be rendered, otherwise it will
                                                        // not.
            ]);
            // Create home sub-menu
            $menuActiveDirectoryInspectorHome = Menu::firstOrCreate([
                'name'          => 'activedirectoryinspector.home',
                'label'         => 'AD Inspector',
                'position'      => 0,
                'icon'          => 'fa fa-book',
                'separator'     => false,
                'url'           => null,                   // Get URL from route.
                'enabled'       => false,
                'parent_id'     => $menuToolsContainer->id,
                'route_id'      => $routeHome->id,
                'permission_id' => null,                   // Get permission from route.
            ]);

        }); // End of DB::transaction(....)

    }

    static public function unInitialize()
    {

        DB::transaction(function () {

            // Locate module sub menu entries and delete them.
            $menuActiveDirectoryInspectorHome = Menu::where('name', 'activedirectoryinspector.home')->first();
            if ($menuActiveDirectoryInspectorHome) {
                Menu::destroy($menuActiveDirectoryInspectorHome->id);
            }
            // Locate demo module parent folder and delete it if if does not contain
            // any other sub-menu entries.
            $menuToolsContainer = Menu::where('name', 'tools-container')->first();
            if ( ($menuToolsContainer) && (!$menuToolsContainer->children->count()) ) {
                Menu::destroy($menuToolsContainer->id);
            }

            // Locate module role, detach from perms and users then delete.
            $roleActiveDirectoryInspector = Role::where('name', 'activedirectoryinspector-users')->first();
            if ($roleActiveDirectoryInspector) {
                $roleActiveDirectoryInspector->perms()->detach();
                $roleActiveDirectoryInspector->users()->detach();
                Role::destroy($roleActiveDirectoryInspector->id);
            }

            // Locate module routes, dissociate from perms and delete
            $routeShow = Route::where('name', 'activedirectoryinspector.show')->first();
            if ($routeShow) {
                $routeShow->permission()->dissociate();
                Route::destroy($routeShow->id);
            }
            $routeSearch = Route::where('name', 'activedirectoryinspector.search')->first();
            if ($routeSearch) {
                $routeSearch->permission()->dissociate();
                Route::destroy($routeSearch->id);
            }
            $routeHome = Route::where('name', 'activedirectoryinspector.home')->first();
            if ($routeHome) {
                $routeHome->permission()->dissociate();
                Route::destroy($routeHome->id);
            }

            // Locate module permission and delete
            $permUseActiveDirectoryInspector = Permission::where('name', 'use-activedirectoryinspector')->first();
            if ($permUseActiveDirectoryInspector) {
                Permission::destroy($permUseActiveDirectoryInspector->id);
            }

        }); // End of DB::transaction(....)

    }

    static public function enable()
    {

        DB::transaction(function () {

            // Locate module sub menu entries and enable them.
            $menuActiveDirectoryInspectorHome = Menu::where('name', 'activedirectoryinspector.home')->first();
            if ($menuActiveDirectoryInspectorHome) {
                $menuActiveDirectoryInspectorHome->enabled = true;
                $menuActiveDirectoryInspectorHome->save();
            }

        }); // End of DB::transaction(....)

    }

    static public function disable()
    {

        DB::transaction(function () {

            // Locate module sub menu entries and disable them.
            $menuActiveDirectoryInspectorHome = Menu::where('name', 'activedirectoryinspector.home')->first();
            if ($menuActiveDirectoryInspectorHome) {
                $menuActiveDirectoryInspectorHome->enabled = false;
                $menuActiveDirectoryInspectorHome->save();
            }

        }); // End of DB::transaction(....)

    }

}