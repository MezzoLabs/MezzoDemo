<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('category_tutorial')->delete();

        DB::table('categories')->delete();
        DB::table('category_groups')->delete();
        DB::table('category_group_models')->delete();


        // Categories for the "content" group
        $contentGroup = \App\CategoryGroup::create(['label' => 'Content']);
        $contentGroup->syncModels([
            \App\File::class, \App\Tutorial::class
        ]);
        
        $events = $contentGroup->createCategory('Events');
        $events->createAndAppend('Local');
        $events->createAndAppend('International');

        $articles = $contentGroup->createCategory('Articles');
        $articles->createAndAppend('Stories');
        $articles->createAndAppend('Shorts');
        $articles->createAndAppend('News');

        // Categories for the "shop" group
        $shopGroup = \App\CategoryGroup::create(['label' => 'Shop']);
        $wine = $shopGroup->createCategory('Wine');
        $wine->createAndAppend('Red');
        $wine->createAndAppend('White');
        $wine->createAndAppend('Other');

        $food = $shopGroup->createCategory('Food');
        $noodles = $food->createAndAppend('Noodles');
        $food->createAndAppend('Sushi');
        $wine->createAndAppend('Saumagen');

        $noodles->createAndAppend('Italian');
        $noodles->createAndAppend('Chinese');
        $noodles->createAndAppend('Schwäbisch');


        Model::reguard();
    }
}
