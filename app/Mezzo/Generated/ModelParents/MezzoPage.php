<?php

namespace App\Mezzo\Generated\ModelParents;

use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
*-------------------------------------------------------------------------------------------------------------------
*
* AUTO GENERATED - MEZZO - MODEL PARENT
*
*-------------------------------------------------------------------------------------------------------------------
*
* Please do not edit, use "App\Page" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoPage
*
* @property integer $id
* @property string $title
* @property string $teaser
* @property string $slug
* @property integer $content_id
* @property float $_lft
* @property float $_rgt
* @property float $parent_id
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property \Carbon\Carbon $deleted_at
* @property \App\Content $content
*/
abstract class MezzoPage extends \MezzoLabs\Mezzo\Core\ThirdParties\NestedSet\MezzoNestedSetNode
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
    protected $table = 'pages';

    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array            
    */
    protected $rules = [
        'title' => "required|between:3,255|unique:pages", 
        'teaser' => "between:5,2500", 
        'slug' => "", 
        '_lft' => "", 
        '_rgt' => "", 
        'parent_id' => ""
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
        "title", 
        "teaser", 
        "slug", 
        "content_id"
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
    * Attribute annotation property for title
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var string            
    */
    protected $_title;

    /**
    * Attribute annotation property for teaser
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea", hidden="")
    * @var string            
    */
    protected $_teaser;

    /**
    * Attribute annotation property for slug
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="create,edit")
    * @var string            
    */
    protected $_slug;

    /**
    * Attribute annotation property for content_id
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Contents\Schema\InputTypes\ContentInput", hidden="index")
    * @var integer            
    */
    protected $_content_id;

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
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\NumberInput", hidden="")
    * @var float            
    */
    protected $_parent_id;

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
    * Attribute annotation property for deleted_at
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var \Carbon\Carbon            
    */
    protected $_deleted_at;


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
    * Relation annotation property for content
    * @Mezzo\Relations\OneToOne
    * @Mezzo\Relations\From(table="pages", primaryKey="id", naming="content")
    * @Mezzo\Relations\To(table="contents", primaryKey="id", naming="page")
    * @Mezzo\Relations\JoinColumn(table="pages", column="content_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_content;


}
