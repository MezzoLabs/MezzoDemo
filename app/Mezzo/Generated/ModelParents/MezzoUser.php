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
 * Please do not edit, use "App\User" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoUser
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $backend
 * @property boolean $confirmed
 * @property string $confirmation_code
 * @property integer $address_id
 * @property string $gender
 * @property string $first_name
 * @property string $last_name
 * @property \App\Address $address
 * @property EloquentCollection $comments
 * @property EloquentCollection $events
 * @property EloquentCollection $lockedEvents
 * @property EloquentCollection $likedCategories
 * @property EloquentCollection $orders
 * @property EloquentCollection $posts
 * @property EloquentCollection $lockedPosts
 * @property \App\ShoppingBasket $shoppingBasket
 * @property EloquentCollection $subscriptions
 * @property EloquentCollection $tutorials
 * @property EloquentCollection $roles
 */
abstract class MezzoUser extends \App\Mezzo\BaseModel
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
    protected $table = 'users';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'email' => "required|email|max:255|unique:users",
        'password' => "sometimes|confirmed|min:6",
        'remember_token' => "",
        'backend' => "", 
        'confirmed' => "",
        'confirmation_code' => "",
        'gender' => "required|max:1|in:m,f,n",
        'first_name' => "required|between:2,255",
        'last_name' => "required|between:2,255"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "remember_token", 
        "password", 
        "confirmation_code"
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "gender",
        "first_name",
        "last_name",
        "email",
        "password",
        "roles",
        "confirmation_code",
        "confirmed",
        "backend",
        "created_at", 
        "subscriptions"
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
     * Attribute annotation property for email
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\EmailInput", hidden="")
     * @var string
     */
    protected $_email;

    /**
     * Attribute annotation property for gender
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\SelectInput", hidden="")
     * @var string
     */
    protected $_gender;

    /**
     * Attribute annotation property for first_name
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_first_name;

    /**
     * Attribute annotation property for last_name
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_last_name;


    /**
     * Attribute annotation property for password
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\PasswordInput", hidden="index")
     * @var string
     */
    protected $_password;

    /**
     * Attribute annotation property for remember_token
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_remember_token;

    /**
     * Attribute annotation property for created_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="create,edit")
     * @var \Carbon\Carbon
     */
    protected $_created_at;

    /**
     * Attribute annotation property for updated_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="index")
     * @var \Carbon\Carbon
     */
    protected $_updated_at;

    /**
     * Attribute annotation property for backend
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\CheckboxInput", hidden="")
     * @var boolean
     */
    protected $_backend;

    /**
     * Attribute annotation property for confirmed
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\CheckboxInput", hidden="")
     * @var boolean
     */
    protected $_confirmed;

    /**
     * Attribute annotation property for confirmation_code
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="create,index,edit")
     * @var string
     */
    protected $_confirmation_code;

    /**
     * Attribute annotation property for address_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_address_id;


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
     * Relation annotation property for address
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="address")
     * @Mezzo\Relations\To(table="addresses", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="users", column="address_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_address;

    /**
     * Relation annotation property for comments
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="comments")
     * @Mezzo\Relations\To(table="comments", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="comments", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_comments;

    /**
     * Relation annotation property for events
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="events")
     * @Mezzo\Relations\To(table="events", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="events", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_events;

    /**
     * Relation annotation property for lockedEvents
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="lockedEvents")
     * @Mezzo\Relations\To(table="events", primaryKey="id", naming="lockedBy")
     * @Mezzo\Relations\JoinColumn(table="events", column="locked_by_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_lockedEvents;

    /**
     * Relation annotation property for likedCategories
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="likedCategories")
     * @Mezzo\Relations\To(table="liked_categories", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="liked_categories", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_likedCategories;

    /**
     * Relation annotation property for orders
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="orders")
     * @Mezzo\Relations\To(table="orders", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="orders", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_orders;

    /**
     * Relation annotation property for posts
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="posts")
     * @Mezzo\Relations\To(table="posts", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="posts", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_posts;

    /**
     * Relation annotation property for lockedPosts
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="lockedPosts")
     * @Mezzo\Relations\To(table="posts", primaryKey="id", naming="lockedBy")
     * @Mezzo\Relations\JoinColumn(table="posts", column="locked_by_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_lockedPosts;

    /**
     * Relation annotation property for shoppingBasket
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="shoppingBasket")
     * @Mezzo\Relations\To(table="shopping_baskets", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="shopping_baskets", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_shoppingBasket;

    /**
     * Relation annotation property for subscriptions
     * @Mezzo\Attribute(type="App\Magazine\Subscriptions\Schema\SubscriptionInput", hidden="create,edit")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="subscriptions")
     * @Mezzo\Relations\To(table="subscriptions", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="subscriptions", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_subscriptions;

    /**
     * Relation annotation property for tutorials
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="tutorials")
     * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="owner")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_tutorials;

    /**
     * Relation annotation property for roles
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="roles")
     * @Mezzo\Relations\To(table="roles", primaryKey="id", naming="")
     * @Mezzo\Relations\PivotTable(name="role_user", fromColumn="user_id", toColumn="role_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_roles;


}
