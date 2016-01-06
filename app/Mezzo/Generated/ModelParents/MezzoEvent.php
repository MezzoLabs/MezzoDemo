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
 * Please do not edit, use "App\Event" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoEvent
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $address_id
 * @property integer $event_venue_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \App\Address $address
 * @property \App\EventVenue $venue
 * @property \App\User $user
 * @property EloquentCollection $categories
 * @property EloquentCollection $days
 */
abstract class MezzoEvent extends BaseModel
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
    protected $table = 'events';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'title' => "required|between:3,200",
        'slug' => "",
        'description' => "required|between:3,500",
        'user_id' => "required",
        'address_id' => "required"
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
        "description",
        "days",
        "categories",
        "event_venue_id",
        "address_id",
        "user_id"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * * @var array
     */
    protected $casts = [
        "locked_until" => "datetime"
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
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\PrimaryKeyInput", hidden="create,edit")
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
     * Attribute annotation property for slug
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="create,edit")
     * @var string
     */
    protected $_slug;

    /**
     * Attribute annotation property for description
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea", hidden="")
     * @var string
     */
    protected $_description;

    /**
     * Attribute annotation property for address_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Addresses\Schema\InputTypes\AddressInput", hidden="")
     * @var integer
     */
    protected $_address_id;

    /**
     * Attribute annotation property for event_venue_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_event_venue_id;

    /**
     * Attribute annotation property for user_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="create")
     * @var integer
     */
    protected $_user_id;

    /**
     * Attribute annotation property for created_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="create")
     * @var \Carbon\Carbon
     */
    protected $_created_at;

    /**
     * Attribute annotation property for updated_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="create,update")
     * @var \Carbon\Carbon
     */
    protected $_updated_at;

    /**
     * Attribute annotation property for deleted_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="create,update")
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
     * Relation annotation property for address
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="events", primaryKey="id", naming="address")
     * @Mezzo\Relations\To(table="addresses", primaryKey="id", naming="event")
     * @Mezzo\Relations\JoinColumn(table="events", column="address_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_address;

    /**
     * Relation annotation property for venue
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="event_venues", primaryKey="id", naming="events")
     * @Mezzo\Relations\To(table="events", primaryKey="id", naming="venue")
     * @Mezzo\Relations\JoinColumn(table="events", column="event_venue_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_venue;

    /**
     * Relation annotation property for user
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="events")
     * @Mezzo\Relations\To(table="events", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="events", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_user;

    /**
     * Relation annotation property for categories
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Categories\Schema\InputTypes\CategoriesInput", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="events", primaryKey="id", naming="categories")
     * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="events")
     * @Mezzo\Relations\PivotTable(name="category_event", fromColumn="event_id", toColumn="category_id")
     * @Mezzo\Relations\Scopes("inGroup:content")
     */
    protected $_categories;

    /**
     * Relation annotation property for days
     * @Mezzo\Attribute(type="\App\Magazine\Events\Schema\InputTypes\EventDaysInput", hidden="")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="event_days", primaryKey="id", naming="event")
     * @Mezzo\Relations\To(table="events", primaryKey="id", naming="days")
     * @Mezzo\Relations\JoinColumn(table="event_days", column="event_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_days;


}
