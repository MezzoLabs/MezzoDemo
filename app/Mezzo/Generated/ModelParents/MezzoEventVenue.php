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
 * Please do not edit, use "App\EventVenue" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoEventVenue
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property float $address_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Address $address
 */
abstract class MezzoEventVenue extends BaseModel
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
    protected $table = 'event_venues';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'title' => "required|between:3,150",
        'slug' => "",
        'description' => "between:5,1500",
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
        'title', 'description', 'address_id'
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
     * Attribute annotation property for title
     *
     * @Mezzo\Attribute(type="TextInput", hidden="")
     * @var string
     */
    protected $_title;

    /**
     * Attribute annotation property for slug
     *
     * @Mezzo\Attribute(type="TextInput", hidden="create,edit")
     * @var string
     */
    protected $_slug;

    /**
     * Attribute annotation property for description
     *
     * @Mezzo\Attribute(type="TextArea", hidden="")
     * @var string
     */
    protected $_description;

    /**
     * Attribute annotation property for address_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Modules\Addresses\Schema\InputTypes\AddressInput", hidden="")
     * @var float
     */
    protected $_address_id;

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
     * Relation annotation property for address
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="event_venues", primaryKey="id", naming="address")
     * @Mezzo\Relations\To(table="addresses", primaryKey="id", naming="event_venues")
     * @Mezzo\Relations\JoinColumn(table="event_venues", column="address_id")
     */
    protected $_address;


}
