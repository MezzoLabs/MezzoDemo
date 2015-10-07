<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;



trait MezzoImage
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'images';

    protected $rules = [
        
    ];

    /**
    *
    /*@Mezzo\InputType(type='RelationInputSingle')
    * @var integer            
    */
    protected $tutorial_id;


    /**
    /*@Mezzo\Relations\OneToOne
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='mainImage')
    /*@Mezzo\Relations\To(table='images', primaryKey='id', naming='tutorial')
    /*@Mezzo\Relations\JoinColumn(table='images', column='id')
    */
    protected $tutorial;


}
