{!! $php->openingTag() !!}

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;


trait {{ $trait->name() }}
{
use IsMezzoModel;

/**
* The table associated with the model.
*
@annotation('var', 'string')
*/
protected $mezzoTable = '{{ $trait->table() }}';

protected $mezzoRules = {!! $php->rulesArray($trait->modelSchema()) !!}

@foreach($trait->attributes() as $attribute)
    /**
    *
    {!! $annotation->attribute($attribute) !!}
    @annotation('var', $attribute->type()->variableType())
    */
    protected ${{ $attribute->name() }};

@endforeach

@foreach($trait->relationSides() as $relationSide)
    /**
    {!! $annotation->relation($relationSide) !!}
    */
    protected ${{ $relationSide->naming() }};

@endforeach

}
