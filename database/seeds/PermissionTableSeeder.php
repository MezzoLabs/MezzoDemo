<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if(Permission::all()->count() > 0)
            return;

        $permissions = [
            [
                'model' => 'user',
                'name' => 'show_own',
                'label' => null
            ],
            [
                'model' => 'user',
                'name' => 'show',
                'label' => null
            ],
            [
                'model' => 'user',
                'name' => 'edit_own',
                'label' => null
            ],
            [
                'model' => 'user',
                'name' => 'edit',
                'label' => null
            ],
            [
                'model' => 'user',
                'name' => 'delete_own',
                'label' => null
            ],
            [
                'model' => 'user',
                'name' => 'delete',
                'label' => null
            ],
            [
                'model' => null,
                'name' => 'administrate',
                'label' => 'Administrate stuff'
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }


        Model::reguard();
    }
}
