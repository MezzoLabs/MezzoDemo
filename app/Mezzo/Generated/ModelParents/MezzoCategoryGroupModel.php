<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
*-------------------------------------------------------------------------------------------------------------------
*
* AUTO GENERATED - MEZZO - MODEL PARENT
*
*-------------------------------------------------------------------------------------------------------------------
*
* Please do not edit, use "App\CategoryGroupModel" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoCategoryGroupModel
*
* @property  integer $category_group_id
*/
abstract class MezzoCategoryGroupModel extends BaseModel
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
    protected $table = 'category_group_models';
    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array
    */
    protected $rules = [

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
    * Attribute annotation property for category_group_id
    *
    * @Mezzo\Attribute(type="RelationInputSingle")
    * @var integer            
    */
    protected $_category_group_id;


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
    * Relation annotation property for category_group_id
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="category_group_models", primaryKey="id", naming="group")
    * @Mezzo\Relations\To(table="category_groups", primaryKey="id", naming="models")
    * @Mezzo\Relations\JoinColumn(table="category_groups", column="id")
    */
    protected $group;


}
