{!! $PHP_OPENING_TAG !!}

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;


trait {{ $trait->name() }} extends Migration
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = {{ $trait->table() }};


@foreach($trait->attributes() as $attribute)
    /**
    *
    @annotation('inputType', $attribute->type()->name())
    @annotation('var', $attribute->type()->variableType())
    */
    protected ${{ $attribute->name() }};

@endforeach

}
