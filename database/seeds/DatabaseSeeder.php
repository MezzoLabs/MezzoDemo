<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \MezzoLabs\Mezzo\Core\Permission\PermissionGuard::setActive(false);

        // $this->call(UserTableSeeder::class);

        /**
        $this->call(UserTableSeeder::class);
        $this->call(TutorialTableSeeder::class);

        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
         * **/

        $this->call(CategoryTableSeeder::class);


        Model::reguard();
    }
}
