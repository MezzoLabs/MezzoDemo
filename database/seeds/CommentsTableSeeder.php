<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        factory(App\Comment::class, 20)->create()->each(function (App\Comment $c) {
            $c->save();
        });

        Model::reguard();
    }
}
