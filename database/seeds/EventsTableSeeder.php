<?php


use Illuminate\Database\Seeder;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;

class EventsTableSeeder extends Seeder
{

    /**
     * @var ContentRepository
     */
    private $contents;

    public function __construct(ContentRepository $contents)
    {

        $this->contents = $contents;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        for ($i = 0; $i != 20; $i++) {
            $this->seedEvent($this->faker());
        }


        Model::reguard();
    }

    private function seedEvent(\Faker\Generator $faker)
    {
        $contentData = [

        ];
    }

    /**
     * @return \Faker\Generator
     */
    private function faker()
    {
        return app()->make(\Faker\Generator::class);
    }
}