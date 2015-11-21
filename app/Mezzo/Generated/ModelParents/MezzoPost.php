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
 * Please do not edit, use "App\Post" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoPost
 *
 * @property  integer $id
 * @property  string $title
 * @property string $teaser
 * @property  string $slug
 * @property  string $state
 * @property  string $published_at
 * @property  integer $user_id
 * @property  integer $content_id
 * @property  integer $main_image_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property  string $deleted_at
 * @property EloquentCollection $user
 * @property EloquentCollection $content
 * @property EloquentCollection $main_image
 */
abstract class MezzoPost extends BaseModel
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
    protected $table = 'posts';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'title' => "",
        'teaser' => "",
        'slug' => "",
        'state' => "",
        'published_at' => ""
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
     * @Mezzo\Attribute(type="PrimaryKeyInput", hidden="")
     * @var integer
     */
    protected $_id;

    /**
     * Attribute annotation property for title
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_title;

    /**
     * Attribute annotation property for teaser
     *
     * @Mezzo\Attribute(type="TextArea", hidden="")
     * @var string
     */
    protected $_teaser;

    /**
     * Attribute annotation property for slug
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_slug;

    /**
     * Attribute annotation property for state
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_state;

    /**
     * Attribute annotation property for published_at
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_published_at;

    /**
     * Attribute annotation property for user_id
     *
     * @Mezzo\Attribute(type="RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_user_id;

    /**
     * Attribute annotation property for content_id
     *
     * @Mezzo\Attribute(type="RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_content_id;

    /**
     * Attribute annotation property for main_image_id
     *
     * @Mezzo\Attribute(type="RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_main_image_id;

    /**
     * Attribute annotation property for created_at
     *
     * @Mezzo\Attribute(type="DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_created_at;

    /**
     * Attribute annotation property for updated_at
     *
     * @Mezzo\Attribute(type="DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_updated_at;

    /**
     * Attribute annotation property for deleted_at
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
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
     * Relation annotation property for user
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="posts")
     * @Mezzo\Relations\To(table="posts", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="posts", column="user_id")
     */
    protected $_user;

    /**
     * Relation annotation property for content
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="content")
     * @Mezzo\Relations\To(table="contents", primaryKey="id", naming="post")
     * @Mezzo\Relations\JoinColumn(table="posts", column="content_id")
     */
    protected $_content;

    /**
     * Relation annotation property for main_image
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="main_image")
     * @Mezzo\Relations\To(table="image_files", primaryKey="id", naming="post")
     * @Mezzo\Relations\JoinColumn(table="posts", column="main_image_id")
     */
    protected $_main_image;


}
