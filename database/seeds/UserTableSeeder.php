<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        factory(App\User::class, 20)->create()->each(function(App\User $u){
            $u->save();
        });

        Model::reguard();
    }
}
