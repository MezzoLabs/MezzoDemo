<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;



trait MezzoComment
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'comments';

    protected $rules = [
        
    ];

    /**
    *
    /*@Mezzo\InputType(type='RelationInputSingle')
    * @var integer            
    */
    protected $tutorial_id;


    /**
    /*@Mezzo\Relations\OneToMany
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='comments')
    /*@Mezzo\Relations\To(table='comments', primaryKey='id', naming='tutorial')
    /*@Mezzo\Relations\JoinColumn(table='comments', column='id')
    */
    protected $tutorial;


}
