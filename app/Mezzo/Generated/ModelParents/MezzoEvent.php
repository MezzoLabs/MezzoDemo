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
* @property float $clicks
* @property integer $locked_by_id
* @property \Carbon\Carbon $locked_until
* @property integer $event_provider_id
* @property \App\Address $address
* @property \App\EventVenue $venue
* @property \App\User $user
* @property \App\User $lockedBy
* @property \App\EventProvider $eventProvider
* @property EloquentCollection $days
* @property EloquentCollection $images
* @property EloquentCollection $categories
*/
abstract class MezzoEvent extends \App\Mezzo\BaseModel
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
        'description' => "required|between:3,50000",
        'clicks' => "",
        'locked_until' => "",
        'days' => "days_not_overlapping"
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
        "user_id", 
        "event_provider_id",
        'images'
    ];

    /**
    * The attributes that should be casted to native types.
    *
    * * @var array            
    */
    protected $casts = [
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
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RichTextArea", hidden="index")
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
    * @Mezzo\Attribute(type="App\Magazine\Events\Schema\InputTypes\EventVenueInput", hidden="index")
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

    /**
    * Attribute annotation property for event_provider_id
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
    * @var integer            
    */
    protected $_event_provider_id;


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
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="venue")
    * @Mezzo\Relations\To(table="event_venues", primaryKey="id", naming="events")
    * @Mezzo\Relations\JoinColumn(table="events", column="event_venue_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_venue;

    /**
    * Relation annotation property for user
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="user")
    * @Mezzo\Relations\To(table="users", primaryKey="id", naming="events")
    * @Mezzo\Relations\JoinColumn(table="events", column="user_id")
    * @Mezzo\Relations\Scopes("backend")
    */
    protected $_user;

    /**
    * Relation annotation property for lockedBy
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="lockedBy")
    * @Mezzo\Relations\To(table="users", primaryKey="id", naming="lockedEvents")
    * @Mezzo\Relations\JoinColumn(table="events", column="locked_by_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_lockedBy;

    /**
    * Relation annotation property for eventProvider
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="eventProvider")
    * @Mezzo\Relations\To(table="event_providers", primaryKey="id", naming="events")
    * @Mezzo\Relations\JoinColumn(table="events", column="event_provider_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_eventProvider;

    /**
    * Relation annotation property for days
    * @Mezzo\Attribute(type="App\Magazine\Events\Schema\InputTypes\EventDaysInput", hidden="index")
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="days")
    * @Mezzo\Relations\To(table="event_days", primaryKey="id", naming="event")
    * @Mezzo\Relations\JoinColumn(table="event_days", column="event_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_days;

    /**
    * Relation annotation property for images
    * @Mezzo\Attribute(type="\MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\ImagesInput", hidden="")
    * @Mezzo\Relations\ManyToMany
    * @Mezzo\Relations\From(table="events", primaryKey="id", naming="images")
    * @Mezzo\Relations\To(table="image_files", primaryKey="id", naming="events")
    * @Mezzo\Relations\PivotTable(name="event_image_file", fromColumn="event_id", toColumn="image_file_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_images;

    /**
    * Relation annotation property for categories
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Categories\Schema\InputTypes\CategoriesInput", hidden="")
    * @Mezzo\Relations\ManyToMany
    * @Mezzo\Relations\From(table="categories", primaryKey="id", naming="events")
    * @Mezzo\Relations\To(table="events", primaryKey="id", naming="categories")
    * @Mezzo\Relations\PivotTable(name="category_event", fromColumn="category_id", toColumn="event_id")
    * @Mezzo\Relations\Scopes("inGroup:content")
    */
    protected $_categories;


}
