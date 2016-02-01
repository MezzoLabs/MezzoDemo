<?php


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;
use MezzoLabs\Mezzo\Modules\Posts\Domain\Repositories\PostRepository;

class PostsTableSeeder extends Seeder
{

    /**
     * @var ContentRepository
     */
    private $contents;
    /**
     * @var ContentTableSeeder
     */
    private $contentSeeder;
    /**
     * @var PostRepository
     */
    private $posts;

    public function __construct(ContentRepository $contents, ContentTableSeeder $contentSeeder, PostRepository $posts)
    {

        $this->contents = $contents;
        $this->contentSeeder = $contentSeeder;
        $this->posts = $posts;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        \MezzoLabs\Mezzo\Core\Permission\PermissionGuard::setActive(false);


        for ($i = 0; $i != 2000; $i++) {
            $this->seedPost($this->faker());
        }

        Model::reguard();
    }

    private function seedPost(\Faker\Generator $faker)
    {
        $content = $this->contentSeeder->seedContent();

        $array = [
            'title' => $faker->text(30),
            'teaser' => $faker->text(200),
            'state' => 'deleted',
            'content_id' => $content->id,
            'user_id' => 1
        ];

        $post = \App\Post::create($array);

        return $post;
    }

    /**
     * @return \Faker\Generator
     */
    private function faker()
    {
        return app()->make(\Faker\Generator::class);
    }
}