<?php

namespace App\Mezzo\Generated\ModelParents;

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
* Please do not edit, use "App\Category" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoCategory
*
* @property integer $id
* @property string $slug
* @property string $label
* @property integer $category_group_id
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property float $_lft
* @property float $_rgt
* @property integer $parent_id
* @property \App\CategoryGroup $group
* @property \App\Category $parent
* @property EloquentCollection $tutorials
* @property EloquentCollection $posts
* @property EloquentCollection $events
*/
abstract class MezzoCategory extends \MezzoLabs\Mezzo\Core\ThirdParties\NestedSet\MezzoNestedSetNode
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
        '_rgt' => ""
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
        "label", 
        "slug", 
        "parent_id", 
        "category_group_id"
    ];

    /**
    * The attributes that should be casted to native types.
    *
    * * @var array            
    */
    protected $casts = [
        
    ];

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool            
    */
    public $timestamps = true;


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
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\PrimaryKeyInput", hidden="")
    * @var integer            
    */
    protected $_id;

    /**
    * Attribute annotation property for slug
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var string            
    */
    protected $_slug;

    /**
    * Attribute annotation property for label
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var string            
    */
    protected $_label;

    /**
    * Attribute annotation property for category_group_id
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
    * @var integer            
    */
    protected $_category_group_id;

    /**
    * Attribute annotation property for created_at
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
    * @var \Carbon\Carbon            
    */
    protected $_created_at;

    /**
    * Attribute annotation property for updated_at
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
    * @var \Carbon\Carbon            
    */
    protected $_updated_at;

    /**
    * Attribute annotation property for _lft
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\NumberInput", hidden="")
    * @var float            
    */
    protected $__lft;

    /**
    * Attribute annotation property for _rgt
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\NumberInput", hidden="")
    * @var float            
    */
    protected $__rgt;

    /**
    * Attribute annotation property for parent_id
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
    * @var integer            
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
    * Relation annotation property for group
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="category_groups", primaryKey="id", naming="categories")
    * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="group")
    * @Mezzo\Relations\JoinColumn(table="categories", column="category_group_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_group;

    /**
    * Relation annotation property for parent
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="categories", primaryKey="id", naming="parent")
    * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="parent")
    * @Mezzo\Relations\JoinColumn(table="categories", column="parent_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_parent;

    /**
    * Relation annotation property for tutorials
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
    * @Mezzo\Relations\ManyToMany
    * @Mezzo\Relations\From(table="categories", primaryKey="id", naming="tutorials")
    * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="")
    * @Mezzo\Relations\PivotTable(name="category_tutorial", fromColumn="category_id", toColumn="tutorial_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_tutorials;

    /**
    * Relation annotation property for posts
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
    * @Mezzo\Relations\ManyToMany
    * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="categories")
    * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="posts")
    * @Mezzo\Relations\PivotTable(name="category_post", fromColumn="post_id", toColumn="category_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_posts;

    /**
    * Relation annotation property for events
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
    * @Mezzo\Relations\ManyToMany
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="categories")
    * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="events")
    * @Mezzo\Relations\PivotTable(name="category_event", fromColumn="event_id", toColumn="category_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_events;


}
