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
 * Please do not edit, use "App\Post" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoPost
 *
 * @property integer $id
 * @property string $title
 * @property string $teaser
 * @property string $slug
 * @property string $state
 * @property integer $user_id
 * @property integer $content_id
 * @property integer $main_image_id
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property float $clicks
 * @property integer $locked_by_id
 * @property \Carbon\Carbon $locked_until
 * @property \App\User $user
 * @property \App\Content $content
 * @property \App\ImageFile $main_image
 * @property \App\User $lockedBy
 * @property EloquentCollection $categories
 */
abstract class MezzoPost extends \App\Mezzo\BaseModel
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
        'title' => "required|between:2,200",
        'teaser' => "between:2,1500",
        'slug' => "",
        'state' => "required|between:2,20|alpha_num|in:published,draft,deleted",
        'published_at' => "",
        'clicks' => "",
        'locked_until' => ""
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
        "published_at",
        "slug",
        "state",
        "main_image_id",
        "categories",
        "content_id",
        "user_id"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * * @var array
     */
    protected $casts = [
        'published_at' => "date",
        'locked_until' => "datetime"
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
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_slug;

    /**
     * Attribute annotation property for state
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Posts\Schema\InputTypes\PostStateInput", hidden="")
     * @var string
     */
    protected $_state;

    /**
     * Attribute annotation property for user_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_user_id;

    /**
     * Attribute annotation property for content_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Contents\Schema\InputTypes\ContentInput", hidden="")
     * @var integer
     */
    protected $_content_id;

    /**
     * Attribute annotation property for main_image_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\ImageInput", hidden="")
     * @var integer
     */
    protected $_main_image_id;

    /**
     * Attribute annotation property for published_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_published_at;

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
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_deleted_at;

    /**
     * Attribute annotation property for clicks
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\NumberInput", hidden="")
     * @var float
     */
    protected $_clicks;

    /**
     * Attribute annotation property for locked_by_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_locked_by_id;

    /**
     * Attribute annotation property for locked_until
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_locked_until;


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
     * @Mezzo\Relations\Scopes("backend")
     */
    protected $_user;

    /**
     * Relation annotation property for content
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="content")
     * @Mezzo\Relations\To(table="contents", primaryKey="id", naming="post")
     * @Mezzo\Relations\JoinColumn(table="posts", column="content_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_content;

    /**
     * Relation annotation property for main_image
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="main_image")
     * @Mezzo\Relations\To(table="image_files", primaryKey="id", naming="posts")
     * @Mezzo\Relations\JoinColumn(table="posts", column="main_image_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_main_image;

    /**
     * Relation annotation property for lockedBy
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="lockedPosts")
     * @Mezzo\Relations\To(table="posts", primaryKey="id", naming="lockedBy")
     * @Mezzo\Relations\JoinColumn(table="posts", column="locked_by_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_lockedBy;

    /**
     * Relation annotation property for categories
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Categories\Schema\InputTypes\CategoriesInput", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="categories")
     * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="posts")
     * @Mezzo\Relations\PivotTable(name="category_post", fromColumn="post_id", toColumn="category_id")
     * @Mezzo\Relations\Scopes("inGroup:content")
     */
    protected $_categories;


}
