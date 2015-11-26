<?php

namespace Mezzolabs\Mezzo\Cockpit\Http\FormObjects;


use Illuminate\Contracts\Validation\Validator as IlluminateValidator;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;

interface FormObject
{
    /**
     * Validate the given data.
     *
     * @return IlluminateValidator
     */
    public function validate();

    /**
     * The reflection of the eloquent model.
     *
     * @return MezzoModelReflection
     */
    public function model();

    /**
     * Returns the data that was sent by the form request.
     *
     * @return Collection
     */
    public function data();

    /**
     * Returns a collection with all the data of nested relations.
     *
     * @return NestedRelations
     */
    public function nestedRelations();

    /**
     * Returns a collection with the data of the received attributes that are not inside a nested relation.
     *
     * @return Collection
     */
    public function atomicAttributesData();
}