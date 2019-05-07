<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Webpatser\Uuid\Uuid;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');

      //all the roles used in LGK
      $role_types = [
	      'administrator' => 'web',
	      'firm_manager' => 'web',
	      'firm_member' => 'web',
	      'client' => 'web',
      ];

      //create all the roles used by LGK
      foreach($role_types as $key=>$index){
	      Role::create(['guard_name' => $index, 'name' => $key]);
      }

      //all permissions used in LGK
      $permissions = [
      	'view cases',
	      'view clients',
	      'view contacts',
	      'view firm',
	      'view invoices',
	      'view calendar',
	      'view messages',
	      'view tasks',
	      'view documents',
	      'view reports',
	      'view settings',
	      'view firms',
	      'view users',
	      'view roles',
	      'view permissions',
	      ];

      //get admin role and assign all permissions to it
	    $role = Role::findByName('administrator');
      foreach($permissions as $permission){
        Permission::create(['name' => $permission]);
	      $role->givePermissionTo($permission);
      }

	    $role_fm = Role::findByName('firm_manager');
	    $role_fm->givePermissionTo('view cases');
	    $role_fm->givePermissionTo('view clients');
	    $role_fm->givePermissionTo('view contacts');
	    $role_fm->givePermissionTo('view firm');
	    $role_fm->givePermissionTo('view invoices');
	    $role_fm->givePermissionTo('view calendar');
	    $role_fm->givePermissionTo('view messages');
	    $role_fm->givePermissionTo('view tasks');
	    $role_fm->givePermissionTo('view documents');
	    $role_fm->givePermissionTo('view reports');
	    $role_fm->givePermissionTo('view settings');

	    $role_fmm = Role::findByName('firm_member');
	    $role_fmm->givePermissionTo('view cases');
	    $role_fmm->givePermissionTo('view clients');
	    $role_fmm->givePermissionTo('view contacts');
	    $role_fmm->givePermissionTo('view invoices');
	    $role_fmm->givePermissionTo('view calendar');
	    $role_fmm->givePermissionTo('view messages');
	    $role_fmm->givePermissionTo('view tasks');
	    $role_fmm->givePermissionTo('view documents');
	    $role_fmm->givePermissionTo('view reports');
	    $role_fmm->givePermissionTo('view settings');

      $role_c = Role::findByName('client');
      $role_c->givePermissionTo('view cases');
      $role_c->givePermissionTo('view invoices');
      $role_c->givePermissionTo('view calendar');
      $role_c->givePermissionTo('view messages');
      $role_c->givePermissionTo('view tasks');
      $role_c->givePermissionTo('view documents');
      
      //$uuid = Uuid::generate()->string;
      $user = User::create([
        'email' => 'codenut33@gmail.com',
        'name' => 'Robert Smith',
        'password' => bcrypt('123456'),
      ]);
      
      DB::table('model_has_roles')->insert([
         'model_type' => 'App\User',
         'model_id' => $user->id,
          'role_id' => 1,
      ]);
      
      $user_second = User::create([
        'email' => 'robby@legalkeeper.com',
        'name' => 'Robby Firm Manager',
        'password' => bcrypt('123456'),
      ]);
      
      DB::table('model_has_roles')->insert([
         'model_type' => 'App\User',
          'model_id' => $user_second->id,
          'role_id' => 2,
      ]);   
      
      $user_third = User::create([
        'email' => 'robby_member@legalkeeper.com',
        'name' => 'Robby Firm Member',
        'password' => bcrypt('123456'),
      ]);
      
      DB::table('model_has_roles')->insert([
         'model_type' => 'App\User',
          'model_id' => $user_third->id,
          'role_id' => 3,
      ]);         
      
      /*DB::table('firm')->insert([
          'name' => 'Admin Firm',
          'address_1' => '1800 Meridian Ave',
          'state' => 'TX',
          'city' => 'Waco',
          'zip' => '76708',
          'phone' => '2544059664',
      ]);
       
      */


    }
}
