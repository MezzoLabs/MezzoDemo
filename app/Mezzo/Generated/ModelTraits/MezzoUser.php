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
        'id' => '', 
        'name' => '', 
        'email' => '', 
        'password' => '', 
        'remember_token' => '', 
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
    protected $name;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $email;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $password;

    /**
    *
    /*@Mezzo\InputType(type='TextInput')
    * @var string            
    */
    protected $remember_token;

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


    /**
    /*@Mezzo\Relations\OneToMany
    /*@Mezzo\Relations\From(table='users', primaryKey='id', naming='tutorials')
    /*@Mezzo\Relations\To(table='tutorials', primaryKey='id', naming='owner')
    /*@Mezzo\Relations\JoinColumn(table='tutorials', column='id')
    */
    protected $tutorials;


}
