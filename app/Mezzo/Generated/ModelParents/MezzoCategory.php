<?php

namespace App\Mezzo\Generated\ModelParents;

use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\NestedSet\MezzoNestedSetNode;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
 *-------------------------------------------------------------------------------------------------------------------
 *
 * AUTO GENERATED - MEZZO - MODEL PARENT
 *
 *-------------------------------------------------------------------------------------------------------------------
 *
 * Please do not edit, use "App\Category" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoCategory
 *
 * @property  integer $id
 * @property  string $slug
 * @property  string $label
 * @property  integer $category_group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property  float $_lft
 * @property  float $_rgt
 * @property  float $parent_id
 */
abstract class MezzoCategory extends MezzoNestedSetNode
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
    protected $table = 'categories';
    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'slug' => "unique",
        'label' => "required|unique_with:categories, category_group_id",
        '_lft' => "",
        '_rgt' => "",
        'parent_id' => "",
        'category_group_id' => 'required|exists:category_groups,id'
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
        'label', 'slug', 'category_group_id', 'parent_id'
    ];

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Attribute annotation properties
    |-------------------------------------------------------------------------------------------------------------------    |
    | In this section you will find some annotated properties.
    | They are not really important for you, but they will tell Mezzo something about
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
     * Attribute annotation property for category_group_id
     *
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $_category_group_id;

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

    /**
     * Attribute annotation property for _lft
     *
     * @Mezzo\Attribute(type="NumberInput")
     * @var float
     */
    protected $__lft;

    /**
     * Attribute annotation property for _rgt
     *
     * @Mezzo\Attribute(type="NumberInput")
     * @var float
     */
    protected $__rgt;

    /**
     * Attribute annotation property for parent_id
     *
     * @Mezzo\Attribute(type="NumberInput")
     * @var float
     */
    protected $_parent_id;


    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Relation annotation properties
    |-------------------------------------------------------------------------------------------------------------------
    | In this section you will find some annotated properties.
    | They are not really important for you, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
     * Relation annotation property for parent_id
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="category_groups", primaryKey="id", naming="categories")
     * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="group")
     * @Mezzo\Relations\JoinColumn(table="categories", column="category_group_id")
     */
    protected $_group;


}
