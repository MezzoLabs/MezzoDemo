<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('contents')->delete();
        DB::table('content_blocks')->delete();
        DB::table('content_fields')->delete();


        Model::reguard();
    }
}
