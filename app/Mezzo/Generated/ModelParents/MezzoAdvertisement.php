<?php

namespace App\Mezzo\Generated\ModelParents;

use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
*-------------------------------------------------------------------------------------------------------------------
*
* AUTO GENERATED - MEZZO - MODEL PARENT
*
*-------------------------------------------------------------------------------------------------------------------
*
* Please do not edit, use "App\Advertisement" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoAdvertisement
*
* @property integer $id
* @property string $type
* @property boolean $active
* @property string $url
* @property string $imageUrl
 * @property string $label
* @property string $description
* @property float $priority
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/
abstract class MezzoAdvertisement extends \App\Mezzo\BaseModel
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
    protected $table = 'advertisements';

    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array            
    */
    protected $rules = [
        'type' => "required", 
        'active' => "",
        'url' => "required|url",
        'imageUrl' => "url",
        'label' => "",
        'description' => "between:2,2000", 
        'priority' => "between:0,10"
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
        "label",
        "description",
        "type",
        "url",
        "imageUrl",
        "active",
        "priority"
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
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\PrimaryKeyInput", hidden="create,edit")
    * @var integer            
    */
    protected $_id;

    /**
    * Attribute annotation property for type
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var string            
    */
    protected $_type;

    /**
    * Attribute annotation property for active
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\CheckboxInput", hidden="")
    * @var boolean            
    */
    protected $_active;

    /**
    * Attribute annotation property for url
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\UrlInput", hidden="")
    * @var string            
    */
    protected $_url;

    /**
    * Attribute annotation property for imageUrl
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\UrlInput", hidden="")
    * @var string            
    */
    protected $_imageUrl;

    /**
     * Attribute annotation property for label
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_label;

    /**
    * Attribute annotation property for description
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea", hidden="")
    * @var string            
    */
    protected $_description;

    /**
    * Attribute annotation property for priority
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\NumberInput", hidden="")
    * @var float            
    */
    protected $_priority;

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


    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Relation annotation properties
    |-------------------------------------------------------------------------------------------------------------------
    | In this section you will find some annotated properties.
    | They are not really important for you, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */


}
