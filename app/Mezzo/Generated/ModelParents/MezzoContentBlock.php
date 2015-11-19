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
* Please do not edit, use "App\ContentBlock" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoContentBlock
*
* @property  integer $id
 * @property  string $name
* @property  float $sort
 * @property  string $class
* @property string $options
* @property  integer $content_id
* @property  string $deleted_at
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property EloquentCollection $content
* @property EloquentCollection $fields
*/
abstract class MezzoContentBlock extends BaseModel
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
    protected $table = 'content_blocks';

    /**
    * Set of rules that will be validated in resource requests.
    *
     * @var array
    */
    protected $rules = [
        'name' => "between:2,200|alpha_num|unique_with:content_blocks,content_id",
        'sort' => "unique_with:content_blocks,content_id",
        'class' => "required|between:2,200", 
        'options' => ""
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
        "class",
        "name",
        "content_id", 
        "options"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * * @var array
     */
    protected $casts = [
        'content_id' => "integer", 
        'options' => "array"
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
    * @Mezzo\Attribute(type="PrimaryKeyInput")
    * @var integer            
    */
    protected $_id;

    /**
     * Attribute annotation property for name
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $_name;

    /**
    * Attribute annotation property for sort
    *
    * @Mezzo\Attribute(type="NumberInput")
    * @var float            
    */
    protected $_sort;

    /**
     * Attribute annotation property for class
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_class;

    /**
    * Attribute annotation property for options
    *
    * @Mezzo\Attribute(type="TextArea")
    * @var string            
    */
    protected $_options;

    /**
    * Attribute annotation property for content_id
    *
    * @Mezzo\Attribute(type="RelationInputSingle")
    * @var integer            
    */
    protected $_content_id;

    /**
    * Attribute annotation property for deleted_at
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_deleted_at;

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
    | They are not really important for you, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
     * Relation annotation property for content
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="content_blocks", primaryKey="id", naming="content")
    * @Mezzo\Relations\To(table="contents", primaryKey="id", naming="blocks")
    * @Mezzo\Relations\JoinColumn(table="content_blocks", column="content_id")
    */
    protected $_content;

    /**
     * Relation annotation property for fields
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="content_fields", primaryKey="id", naming="block")
    * @Mezzo\Relations\To(table="content_blocks", primaryKey="id", naming="fields")
     * @Mezzo\Relations\JoinColumn(table="content_fields", column="content_block_id")
    */
    protected $_fields;


}
