<?php


namespace MezzoLabs\Mezzo\Modules\Contents\BlockTypes;


use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentBlockTypeContract;
use MezzoLabs\Mezzo\Modules\Contents\Contracts\ContentFieldTypeContract;
use MezzoLabs\Mezzo\Modules\Contents\Exceptions\ContentBlockException;
use MezzoLabs\Mezzo\Modules\Contents\Exceptions\NoKeyForContentBlockException;
use MezzoLabs\Mezzo\Modules\Contents\FieldTypes\ContentFieldTypeCollection;

abstract class AbstractContentBlockType implements ContentBlockTypeContract
{
    protected $title = "";

    /**
     * @var ContentFieldTypeCollection;
     */
    protected $fields;

    /**
     * Returns the unique key of this content block.
     * @return string
     * @throws NoKeyForContentBlockException
     */
    public function key()
    {
        return get_class($this);
    }

    /**
     * Returns the title that will be displayed in the dashboard.
     *
     * @return string
     */
    public function title()
    {
        if (empty($this->title))
            return space_case(class_basename($this));

        return $this->title;
    }

    /**
     * Adds a field to the schema of the content block.
     *
     * @param ContentFieldTypeContract $fieldType
     */
    public function addField(ContentFieldTypeContract $fieldType)
    {
        if ($this->fields()->has($fieldType->name()))
            throw new ContentBlockException('A field with the name "' . $fieldType->name() . '" does already exist ' .
                'in "' . $this->key() . '".');

        $this->fields()->put($fieldType->name(), $fieldType);
    }


    /**
     * Returns the field types that are present in this block.
     *
     * @return ContentFieldTypeCollection
     */
    public function fields()
    {
        if (!$this->fields)
            $this->fields = new ContentFieldTypeCollection();

        return $this->fields;
    }

    /**
     * Creates a view with some variables filled in.
     *
     * @param $viewKey
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    protected function makeView($viewKey, $mergeData = [])
    {
        return view()->make($viewKey, [
            'block' => $this,
            'fields' => $this->fields()
        ], $mergeData);
    }

}