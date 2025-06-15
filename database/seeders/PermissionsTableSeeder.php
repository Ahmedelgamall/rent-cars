<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {

        #settings page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit settings', 'permission_group' => 'settings', 'permission_monitor' => 'settings' ] );

        # why choose us permissions

        Permission::create(['guard_name' => 'web', 'name' => 'list why choose us', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us']);
        Permission::create(['guard_name' => 'web', 'name' => 'add why choose us', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit why choose us', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete why choose us', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us']);

        
        #faqs page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list faqs', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add faq', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit faq', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete faq', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );



        # admins permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list admins', 'permission_group' => 'admins and roles', 'permission_monitor' => 'admins' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add admin', 'permission_group' => 'admins and roles', 'permission_monitor' => 'admins' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit admin', 'permission_group' => 'admins and roles', 'permission_monitor' => 'admins' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete admin', 'permission_group' => 'admins and roles', 'permission_monitor' => 'admins' ] );

        # roles permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list roles', 'permission_group' => 'admins and roles', 'permission_monitor' => 'roles' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add role', 'permission_group' => 'admins and roles', 'permission_monitor' => 'roles' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit role', 'permission_group' => 'admins and roles', 'permission_monitor' => 'roles' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete role', 'permission_group' => 'admins and roles', 'permission_monitor' => 'roles' ] );

        # categories permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list categories', 'permission_group' => 'cars', 'permission_monitor' => 'categories' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add category', 'permission_group' => 'cars', 'permission_monitor' => 'categories' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit category', 'permission_group' => 'cars', 'permission_monitor' => 'categories' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete category', 'permission_group' => 'cars', 'permission_monitor' => 'categories' ] );

        # cars permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list cars', 'permission_group' => 'cars', 'permission_monitor' => 'cars' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add car', 'permission_group' => 'cars', 'permission_monitor' => 'cars' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit car', 'permission_group' => 'cars', 'permission_monitor' => 'cars' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete car', 'permission_group' => 'cars', 'permission_monitor' => 'cars' ] );

        # orders permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list orders', 'permission_group' => 'contacts', 'permission_monitor' => 'orders' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete order', 'permission_group' => 'contacts', 'permission_monitor' => 'orders' ] );

        

        # contacts permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list contacts', 'permission_group' => 'contacts', 'permission_monitor' => 'contacts' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete contact', 'permission_group' => 'contacts', 'permission_monitor' => 'contacts' ] );

    }
}
