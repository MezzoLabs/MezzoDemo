<?php


namespace Mezzolabs\Mezzo\Modules\Contents\Http\FormObjects;


use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Mezzolabs\Mezzo\Cockpit\Http\FormObjects\FormObject;
use Mezzolabs\Mezzo\Cockpit\Http\FormObjects\GenericFormObject;
use Mezzolabs\Mezzo\Cockpit\Http\FormObjects\NestedRelations;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;

class ContentBlocksFormObject implements FormObject
{
    const CONTENT_FORM_NAME = "content";
    const BLOCKS_FORM_NAME = "blocks";
    const FIELDS_FORM_NAME = "fields";

    /**
     * @var GenericFormObject
     */
    protected $genericFormObject;

    /**
     * @var Collection
     */
    protected $blocksData;

    /**
     * @var Collection
     */
    protected $contentData;

    /**
     * @var Collection
     */
    protected $allData;

    /**
     * @param MezzoModelReflection $model
     * @param array $data
     */
    public function __construct(MezzoModelReflection $model, $data)
    {
        $this->allData = new Collection($data);

        $this->contentsData = new Collection($this->allData->get(static::CONTENT_FORM_NAME, []));
        $this->blocksData = new Collection($this->contentsData->get(static::BLOCKS_FORM_NAME, []));

        $this->genericFormObject = new GenericFormObject($model, $this->allData->except(static::CONTENT_FORM_NAME));
    }


    /**
     * The reflection of the eloquent model.
     *
     * @return MezzoModelReflection
     */
    public function model()
    {
        return $this->genericFormObject->model();
    }

    /**
     * Returns the data that was sent by the form request.
     *
     * @return Collection
     */
    public function data()
    {
        return $this->genericFormObject->data();
    }

    /**
     * Returns a collection with all the data of nested relations.
     *
     * @return NestedRelations
     */
    public function nestedRelations()
    {
        return $this->genericFormObject->nestedRelations();
    }

    /**
     * Returns a collection with the data of the received attributes that are not inside a nested relation.
     *
     * @return Collection
     */
    public function atomicAttributesData()
    {
        return $this->genericFormObject->atomicAttributesData();
    }

    /**
     * Return all the rules of atomic attributes and nested relations for a store request in a dot notation.
     *
     * @return array
     */
    public function rulesForStoring()
    {
        $rules = $this->genericFormObject->rulesForStoring();

        return array_merge($rules, $this->contentBlockRules());
    }

    /**
     * Return all the rules of atomic attributes and nested relations for a update request in a dot notation.
     *
     * @param array $dirty
     * @return array
     */
    public function rulesForUpdating(array $dirty)
    {
        $rules = $this->genericFormObject->rulesForUpdating($dirty);

        return array_merge($rules, $this->contentBlockRules());
    }


    /**
     * @return Collection
     */
    public function blocksData()
    {
        return $this->blocksData;
    }

    /**
     * @return Collection
     */
    public function contentData()
    {
        return $this->contentsData;
    }

    public function hasContentBlocks()
    {
        return !$this->blocksData()->isEmpty();
    }

    protected function contentBlockRules()
    {
        if (!$this->hasContentBlocks()) {
            return [static::CONTENT_FORM_NAME . '.' . static::BLOCKS_FORM_NAME => 'required'];
        }

        $rules = [];
        foreach ($this->blocksData() as $blockIndex => $blockData) {
            $rules = array_merge(
                $rules,
                [
                    $blockIndex => $this->rulesForBlock(new Collection($blockData))
                ]
            );
        }

        $blocksRules = Arr::dot([
            static::CONTENT_FORM_NAME . '.' . static::BLOCKS_FORM_NAME => $rules
        ]);

        return array_merge([
            static::CONTENT_FORM_NAME . '.' . static::BLOCKS_FORM_NAME => 'required'
        ], $blocksRules);
    }

    protected function rulesForBlock(Collection $blockData)
    {
        $block = new \App\ContentBlock($blockData->except(static::FIELDS_FORM_NAME)->toArray());
        $blockPropertyRules = $block->getRules();
        $blockFieldsRules = [
            static::FIELDS_FORM_NAME => $block->fieldsRules()
        ];

        return array_merge($blockPropertyRules, $blockFieldsRules);
    }

}