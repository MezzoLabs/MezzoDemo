<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;



trait MezzoTag
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'tags';

    protected $rules = [
        'id' => '', 
        'slug' => '', 
        'title' => '', 
        'created_at' => '', 
        'updated_at' => ''
    ];

    /**
    *
    /*@Mezzo\InputType(type='NumberInput')
    * @var float            
    */
    protected $id;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $slug;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $title;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $created_at;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $updated_at;



}
