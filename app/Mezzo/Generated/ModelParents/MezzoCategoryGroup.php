<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
*-------------------------------------------------------------------------------------------------------------------
*
* AUTO GENERATED - MEZZO - MODEL PARENT
*
*-------------------------------------------------------------------------------------------------------------------
*
* Please do not edit, use "App\CategoryGroup" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoCategoryGroup
*
* @property  integer $id
* @property  string $slug
* @property  string $label
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/
abstract class MezzoCategoryGroup extends BaseModel
{
    use IsMezzoModel;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Eloquent properties
    |-------------------------------------------------------------------------------------------------------------------
    | The properties below will influence the work of the ORM Mapper "Eloquent".
    | Do not overwrite them here. Please use the power of computer science and edit them
    | in the model which extends this model parent.
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = true;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'category_groups';
    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array
    */
    protected $rules = [
        'slug' => "",
        'label' => ""
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    ];
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'label'
    ];

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Attribute annotation properties
    |-------------------------------------------------------------------------------------------------------------------    |
    | In this section you will find some annotated properties.
    | They are not really important, but they will tell Mezzo something about
    | the attributes of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */
    /**
    * Attribute annotation property for id
    *
    * @Mezzo\Attribute(type="PrimaryKeyInput")
    * @var integer            
    */
    protected $_id;

    /**
    * Attribute annotation property for slug
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_slug;

    /**
    * Attribute annotation property for label
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_label;

    /**
    * Attribute annotation property for created_at
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_created_at;

    /**
    * Attribute annotation property for updated_at
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_updated_at;


    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Relation annotation properties
    |-------------------------------------------------------------------------------------------------------------------
    | In this section you will find some annotated properties.
    | They are not really important, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
    * Relation annotation property for updated_at
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="category_group_models", primaryKey="id", naming="group")
    * @Mezzo\Relations\To(table="category_groups", primaryKey="id", naming="models")
    * @Mezzo\Relations\JoinColumn(table="category_groups", column="id")
     *
     * @var EloquentCollection
    */
    protected $models;


}
