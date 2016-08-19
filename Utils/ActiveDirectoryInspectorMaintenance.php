<?php namespace App\Modules\ActiveDirectoryInspector\Utils;

use DB;
use Sroutier\L51ESKModules\Contracts\ModuleMaintenanceInterface;
use Sroutier\L51ESKModules\Traits\MaintenanceTrait;

class ActiveDirectoryInspectorMaintenance implements ModuleMaintenanceInterface
{

    use MaintenanceTrait;

    static public function initialize()
    {
        DB::transaction(function () {
//            self::migrate('active_directory_inspector');
//            self::seed('active_directory_inspector');

            $permUseActiveDirectoryInspector = self::createPermission(  'use-activedirectoryinspector',
                'Use ActiveDirectoryInspector',
                'Allows a user to use the ActiveDirectoryInspector module.');


            $routeHome = self::createRoute( 'activedirectoryinspector.home',
                'activedirectoryinspector',
                'App\Modules\ActiveDirectoryInspector\Http\Controllers\ActiveDirectoryInspectorController@home',
                $permUseActiveDirectoryInspector );
            self::createRoute( 'activedirectoryinspector.show',
                'activedirectoryinspector/show/{dn}',
                'App\Modules\ActiveDirectoryInspector\Http\Controllers\ActiveDirectoryInspectorController@show',
                $permUseActiveDirectoryInspector );
            self::createRoute( 'activedirectoryinspector.search',
                'activedirectoryinspector/search',
                'App\Modules\ActiveDirectoryInspector\Http\Controllers\ActiveDirectoryInspectorController@search',
                $permUseActiveDirectoryInspector,
                'POST' );

            // Create a role for the module
            self::createRole( 'activedirectoryinspector-users',
                'ActiveDirectoryInspector Users',
                'Users of the ActiveDirectoryInspector module.',
                [$permUseActiveDirectoryInspector->id] );

            // Create menu system for the module
            $menuToolsContainer = self::createMenu( 'tools-container', 'Tools', 10, 'ion ion-settings', 'home', true );
            self::createMenu( 'activedirectoryinspector.home', 'AD Inspector', 0, 'fa fa-book', $menuToolsContainer, false, $routeHome );
        }); // End of DB::transaction(....)
    }

    static public function unInitialize()
    {
        DB::transaction(function () {

            self::destroyMenu('activedirectoryinspector.home');
            self::destroyMenu('tools-container');

            self::destroyRole('activedirectoryinspector-users');

            self::destroyRoute('activedirectoryinspector.show');
            self::destroyRoute('activedirectoryinspector.search');
            self::destroyRoute('activedirectoryinspector.home');

            self::destroyPermission('use-activedirectoryinspector');

//            self::rollbackMigration('active_directory_inspector');
        }); // End of DB::transaction(....)
    }

    static public function enable()
    {
        DB::transaction(function () {
            self::enableMenu('activedirectoryinspector.home');
        });
    }



    static public function disable()
    {
        DB::transaction(function () {
            self::disableMenu('activedirectoryinspector.home');
        });
    }




}