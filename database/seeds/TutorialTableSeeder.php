<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TutorialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        factory(App\Tutorial::class, 20)->create()->each(function(App\Tutorial $t){
            $t->save();
        });

        Model::reguard();
    }
}
