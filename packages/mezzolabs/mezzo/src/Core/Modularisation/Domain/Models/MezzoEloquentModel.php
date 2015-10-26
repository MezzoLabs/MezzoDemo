<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Models;


use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class MezzoEloquentModel extends EloquentModel implements MezzoModel
{
    protected $rules = [];

    public function getRules()
    {
        return $this->rules;
    }
}