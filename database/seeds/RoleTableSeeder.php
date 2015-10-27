<?php

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (Role::all()->count() > 0)
            return;

        $roles = ['admin' => 'Administrator', 'moderator' => 'Moderator', 'user' => 'User', 'guest' => 'Guest'];

        $allPermissions = \App\Permission::all()->lists('id')->keys()->toArray();
        $firstUser = User::first();

        foreach ($roles as $name => $label) {
            $role = Role::create([
                'name' => $name,
                'label' => $label
            ]);

            if($name == 'admin' || $name = 'moderator'){
                $role->permissions()->sync($allPermissions);
                $firstUser->roles()->save($role);
            }

        }


        Model::reguard();
    }
}
