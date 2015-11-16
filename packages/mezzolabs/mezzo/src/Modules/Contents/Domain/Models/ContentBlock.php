<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoContentBlock;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentBlockTypeContract;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentFieldTypeContract;

abstract class ContentBlock extends MezzoContentBlock
{
    /**
     * @var ContentBlockTypeContract
     */
    protected $blockType;

    /**
     * @param ContentBlockTypeContract $blockType
     */
    public function setType(ContentBlockTypeContract $blockType)
    {
        $this->blockType = $blockType;
    }

    /**
     * Creates the content block instance via the class that is set in the database.
     */
    private function setTypeByClass()
    {
        $blockTypeClass = $this->getAttribute('class');
        $this->setType(app()->make($blockTypeClass));
    }

    /**
     * @return ContentBlockTypeContract
     */
    public function getType()
    {
        if (!$this->blockType) {
            $this->setTypeByClass();
        }

        return $this->blockType;
    }

    /**
     * Get the rules for this type.
     *
     * @return array
     */
    public function fieldsRules()
    {
        return $this->getType()->fieldsRules();
    }

    public static function makeByType($contentBlockType)
    {
        $block = new static();

        if (is_string($contentBlockType) && class_exists($contentBlockType))
            $contentBlockType = app()->make($contentBlockType);

        $block->setType($contentBlockType);

        return $block;
    }

    /**
     * @param $name
     * @return ContentFieldTypeContract|null
     */
    public function typeOfField($name)
    {
        return $this->getType()->fields()->get($name, null);
    }


    public function text()
    {
        $textArray = [];
        $this->fields->each(function (\App\ContentField $field) use (&$textArray) {
            $text = $field->text();

            if (empty($text))
                return true;

            $textArray[] = $text;
        });

        return implode("\r\n", $textArray);
    }

}