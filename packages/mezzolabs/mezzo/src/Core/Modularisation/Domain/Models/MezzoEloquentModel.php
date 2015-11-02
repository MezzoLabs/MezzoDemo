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

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function attributeSchemas()
    {
        return $this->schema()->attributes();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\ModelSchema
     */
    public function schema()
    {
        return $this->reflection()->schema();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function reflection()
    {
        return mezzo()->makeReflectionManager()->mezzoReflection(get_class($this));
    }


}