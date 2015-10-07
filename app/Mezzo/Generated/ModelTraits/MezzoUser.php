<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;



trait MezzoUser
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'users';

    protected $rules = [
        
    ];


    /**
    /*@Mezzo\Relations\OneToMany
    /*@Mezzo\Relations\From(table='users', primaryKey='id', naming='tutorials')
    /*@Mezzo\Relations\To(table='tutorials', primaryKey='id', naming='owner')
    /*@Mezzo\Relations\JoinColumn(table='tutorials', column='id')
    */
    protected $tutorials;


}
