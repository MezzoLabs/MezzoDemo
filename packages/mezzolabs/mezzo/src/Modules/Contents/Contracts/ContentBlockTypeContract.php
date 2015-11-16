<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Contracts;


use MezzoLabs\Mezzo\Modules\Contents\Types\FieldTypes\ContentFieldTypeCollection;

interface ContentBlockTypeContract
{
    /**
     * Returns the unique key of this content block.
     *
     * @return string
     */
    public function key();

    /**
     * Returns the title that will be displayed in the dashboard.
     *
     * @return string
     */
    public function title();

    /**
     * Called when a content block type is booted.
     * Now is the time to add some field types to this type of content block.
     */
    public function boot();

    /**
     * Adds a field to the schema of the content block.
     *
     * @param ContentFieldTypeContract $fieldType
     */
    public function addField(ContentFieldTypeContract $fieldType);

    /**
     * Returns the field types that are present in this block.
     *
     * @return ContentFieldTypeCollection
     */
    public function fields();

    /**
     * Create the evaluated view contents for this block.
     *
     * @return string
     */
    public function renderInputs();

    /**
     * The name attribute that represents a content field in the form array.
     *
     * @param $fieldName
     * @return string
     */
    public function inputName($fieldName);

    /**
     * The name attribute that represents a content field in the form array.
     *
     * @param $optionName
     * @return string
     */
    public function optionInputName($optionName);

    /**
     * Returns the rules of all fields
     *
     * @return array
     */
    public function fieldsRules();
}