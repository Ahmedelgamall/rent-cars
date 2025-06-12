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

        #sliders page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list sliders', 'permission_group' => 'settings', 'permission_monitor' => 'sliders' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add slider', 'permission_group' => 'settings', 'permission_monitor' => 'sliders' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit slider', 'permission_group' => 'settings', 'permission_monitor' => 'sliders' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete slider', 'permission_group' => 'settings', 'permission_monitor' => 'sliders' ] );

        #blogs page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list blogs', 'permission_group' => 'settings', 'permission_monitor' => 'blogs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add blog', 'permission_group' => 'settings', 'permission_monitor' => 'blogs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit blog', 'permission_group' => 'settings', 'permission_monitor' => 'blogs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete blog', 'permission_group' => 'settings', 'permission_monitor' => 'blogs' ] );

        #testimonials page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list testimonials', 'permission_group' => 'settings', 'permission_monitor' => 'testimonials' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add testimonial', 'permission_group' => 'settings', 'permission_monitor' => 'testimonials' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit testimonial', 'permission_group' => 'settings', 'permission_monitor' => 'testimonials' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete testimonial', 'permission_group' => 'settings', 'permission_monitor' => 'testimonials' ] );

        #faqs page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list faqs', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add faq', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit faq', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete faq', 'permission_group' => 'settings', 'permission_monitor' => 'faqs' ] );

        #features page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list features', 'permission_group' => 'settings', 'permission_monitor' => 'features' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add feature', 'permission_group' => 'settings', 'permission_monitor' => 'features' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit feature', 'permission_group' => 'settings', 'permission_monitor' => 'features' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete feature', 'permission_group' => 'settings', 'permission_monitor' => 'features' ] );

        #why choose us page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list why choose us elements', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add why choose us element', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit why choose us element', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete why choose us element', 'permission_group' => 'settings', 'permission_monitor' => 'why choose us' ] );

        #cities page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list cities', 'permission_group' => 'settings', 'permission_monitor' => 'cities' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add city', 'permission_group' => 'settings', 'permission_monitor' => 'cities' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit city', 'permission_group' => 'settings', 'permission_monitor' => 'cities' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete city', 'permission_group' => 'settings', 'permission_monitor' => 'cities' ] );

        #areas page
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list areas', 'permission_group' => 'settings', 'permission_monitor' => 'areas' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add area', 'permission_group' => 'settings', 'permission_monitor' => 'areas' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit area', 'permission_group' => 'settings', 'permission_monitor' => 'areas' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete area', 'permission_group' => 'settings', 'permission_monitor' => 'areas' ] );

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
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list categories', 'permission_group' => 'products', 'permission_monitor' => 'categories' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add category', 'permission_group' => 'products', 'permission_monitor' => 'categories' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit category', 'permission_group' => 'products', 'permission_monitor' => 'categories' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete category', 'permission_group' => 'products', 'permission_monitor' => 'categories' ] );

        # products permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list products', 'permission_group' => 'products', 'permission_monitor' => 'products' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add product', 'permission_group' => 'products', 'permission_monitor' => 'products' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit product', 'permission_group' => 'products', 'permission_monitor' => 'products' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete product', 'permission_group' => 'products', 'permission_monitor' => 'products' ] );

        # orders permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list orders', 'permission_group' => 'orders', 'permission_monitor' => 'orders' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit order', 'permission_group' => 'orders', 'permission_monitor' => 'orders' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete order', 'permission_group' => 'orders', 'permission_monitor' => 'orders' ] );

        # coupons permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list coupons', 'permission_group' => 'orders', 'permission_monitor' => 'coupons' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add coupon', 'permission_group' => 'orders', 'permission_monitor' => 'coupons' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit coupon', 'permission_group' => 'orders', 'permission_monitor' => 'coupons' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete coupon', 'permission_group' => 'orders', 'permission_monitor' => 'coupons' ] );

        # customers permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list customers', 'permission_group' => 'customers', 'permission_monitor' => 'customers' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'add customer', 'permission_group' => 'customers', 'permission_monitor' => 'customers' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'edit customer', 'permission_group' => 'customers', 'permission_monitor' => 'customers' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete customer', 'permission_group' => 'customers', 'permission_monitor' => 'customers' ] );

        # contacts permissions
        Permission::create( [ 'guard_name' => 'web', 'name' => 'list contacts', 'permission_group' => 'customers', 'permission_monitor' => 'contacts' ] );
        Permission::create( [ 'guard_name' => 'web', 'name' => 'delete contact', 'permission_group' => 'customers', 'permission_monitor' => 'contacts' ] );

    }
}
