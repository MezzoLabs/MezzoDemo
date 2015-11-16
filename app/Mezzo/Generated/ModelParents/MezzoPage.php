<?php

namespace App\Mezzo\Generated\ModelParents;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
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
 * Please do not edit, use "App\Page" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoPage
 *
 * @property  integer $id
 * @property  string $title
 * @property  string $teaser
 * @property  string $slug
 * @property  integer $content_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property  string $deleted_at
 * @property EloquentCollection $content
 */
abstract class MezzoPage extends MezzoNestedSetNode
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
        'title' => "required|between:3,255",
        'teaser' => "between:5,2500",
        'slug' => ""
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
        "title", "teaser", "slug", "content_id"
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
     * Attribute annotation property for title
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $_title;

    /**
     * Attribute annotation property for teaser
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $_teaser;

    /**
     * Attribute annotation property for slug
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $_slug;

    /**
     * Attribute annotation property for content_id
     *
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $_content_id;

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
     * Attribute annotation property for deleted_at
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $_deleted_at;

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
     * Relation annotation property for content
     *
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="pages", primaryKey="id", naming="content")
     * @Mezzo\Relations\To(table="contents", primaryKey="id", naming="page")
     * @Mezzo\Relations\JoinColumn(table="pages", column="content_id")
     */
    protected $_content;


}
