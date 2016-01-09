<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
 *-------------------------------------------------------------------------------------------------------------------
 *
 * AUTO GENERATED - MEZZO - MODEL PARENT
 *
 *-------------------------------------------------------------------------------------------------------------------
 *
 * Please do not edit, use "App\Address" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoAddress
 *
 * @property integer $id
 * @property string $addressee
 * @property string $organization
 * @property string $street
 * @property string $street_extra
 * @property string $zip
 * @property string $city
 * @property string $phone
 * @property string $fax
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\EventVenue $eventVenue
 */
abstract class MezzoAddress extends BaseModel
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
    protected $table = 'addresses';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'addressee' => "between:2,100",
        'organization' => "between:2,100",
        'street' => "between:2,200",
        'street_extra' => "alpha_num|between:1,10",
        'zip' => "required|between:2,12",
        'city' => "required|between:2,150",
        'phone' => "between:5,50|regex:@^[0-9 / +]+$@",
        'fax' => "between:5,50|regex:@^[0-9 / +]+$@",
        'latitude' => "required|numeric", 
        'longitude' => "required|numeric"
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
        "addressee",
        "organization",
        "street",
        "street_extra",
        "zip",
        "city",
        "phone",
        "fax",
        "latitude",
        "longitude",
        "country"
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
     * @Mezzo\Attribute(type="PrimaryKeyInput", hidden="create,edit")
     * @var integer
     */
    protected $_id;

    /**
     * Attribute annotation property for addressee
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_addressee;

    /**
     * Attribute annotation property for organization
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_organization;

    /**
     * Attribute annotation property for street
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_street;

    /**
     * Attribute annotation property for street_extra
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_street_extra;

    /**
     * Attribute annotation property for zip
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_zip;

    /**
     * Attribute annotation property for city
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_city;

    /**
     * Attribute annotation property for phone
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_phone;

    /**
     * Attribute annotation property for fax
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_fax;

    /**
     * Attribute annotation property for latitude
     *
     * @Mezzo\Attribute(type="FloatInput", hidden="")
     * @var float
     */
    protected $_latitude;

    /**
     * Attribute annotation property for longitude
     *
     * @Mezzo\Attribute(type="FloatInput", hidden="")
     * @var float
     */
    protected $_longitude;

    /**
     * Attribute annotation property for longitude
     *
     * @Mezzo\Attribute(type="CountryInput", hidden="")
     * @var string
     */
    protected $_country;

    /**
     * Attribute annotation property for created_at
     *
     * @Mezzo\Attribute(type="DateTimeInput", hidden="create")
     * @var \Carbon\Carbon
     */
    protected $_created_at;

    /**
     * Attribute annotation property for updated_at
     *
     * @Mezzo\Attribute(type="DateTimeInput", hidden="create,update")
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
     * Relation annotation property for eventVenue
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="event_venues", primaryKey="id", naming="address")
     * @Mezzo\Relations\To(table="addresses", primaryKey="id", naming="eventVenue")
     * @Mezzo\Relations\JoinColumn(table="event_venues", column="address_id")
     */
    protected $_eventVenue;


}
