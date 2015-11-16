<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoContentBlock;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentBlockTypeContract;

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
}