<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use MezzoLabs\Mezzo\Modules\Contents\DefaultTypes\BlockTypes\TextOnly;
use MezzoLabs\Mezzo\Modules\Contents\DefaultTypes\BlockTypes\Title;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;
use MezzoLabs\Mezzo\Modules\Contents\Types\FieldTypes\AbstractContentFieldType;
use MezzoLabs\Mezzo\Modules\FileManager\Content\Blocks\ImageAndText;
use MezzoLabs\Mezzo\Modules\FileManager\Content\Blocks\Images;

class ContentTableSeeder extends Seeder
{
    public $blockTypes = [
        TextOnly::class,
        ImageAndText::class,
        Title::class,
        Images::class
    ];

    private $imageIds = [];
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


        Model::reguard();
    }

    public function seedContent()
    {
        $content = [];

        $blocks = [];

        $blocksCount = random_int(3, 10);

        for ($i = 0; $i != $blocksCount; $i++) {
            $blocks[$i] = $this->blockArray();
            $blocks[$i]['sort'] = $i + 1;
        }

        $content['blocks'] = $blocks;


        return $this->contents->updateOrCreateWithBlocks($content);
    }

    public function blockArray()
    {
        $faker = app()->make(Faker\Generator::class);
        $block = [];

        $type = $this->randomBlockType();

        $block['class'] = get_class($type);
        $block['sort'] = 0;

        $fields = [];


        /** @var AbstractContentFieldType $fieldType */
        foreach ($type->fields() as $fieldName => $fieldType) {
            if ($fieldType->inputType() instanceof \MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput) {
                $fields[$fieldName] = $faker->realText();
                continue;
            }

            if ($fieldType->inputType() instanceof \MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\ImagesInput) {
                $fields[$fieldName] = implode(',', $this->imageIds()->random(3)->toArray());
                continue;
            }

            if ($fieldType->inputType() instanceof \MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\ImageInput) {
                $fields[$fieldName] = $this->imageIds()->random(1);
                continue;
            }

            throw new \Exception('Cannot generate random input for ' . get_class($fieldType));
        }

        $block['fields'] = $fields;

        return $block;
    }

    /**
     * @return \MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentBlockTypeContract
     */
    public function randomBlockType()
    {
        return app()->make($this->blockTypes[array_rand($this->blockTypes)]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function imageIds()
    {
        $images = \App\ImageFile::all('id')->pluck('id');

        return $images;
    }
}
