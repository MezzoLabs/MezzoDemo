{!! $php->openingTag() !!}

namespace App\Mezzo\Generated\ModelParents;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use App\Mezzo\BaseModel;

abstract class {{ $parent->name() }} extends BaseModel
{
use IsMezzoModel;

/**
* The table associated with the model.
*
@annotation('var', 'string')
*/
protected $table = '{{ $parent->table() }}';

protected $rules = {!! $php->rulesArray($parent->modelSchema()) !!}

@foreach($parent->attributeAnnotatinos() as $attribute)
    /**
    *
    {!! $annotation->attribute($attribute) !!}
    @annotation('var', $attribute->type()->variableType())
    */
    protected ${{ $attribute->name() }};

@endforeach

@foreach($parent->relationSides() as $relationSide)
    /**
    {!! $annotation->relation($relationSide) !!}
    */
    protected ${{ $relationSide->naming() }};

@endforeach

}
