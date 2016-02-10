<?php

namespace App\Mezzo\Generated\ModelParents;

use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
*-------------------------------------------------------------------------------------------------------------------
*
* AUTO GENERATED - MEZZO - MODEL PARENT
*
*-------------------------------------------------------------------------------------------------------------------
*
* Please do not edit, use "App\Merchant" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoMerchant
*
* @property integer $id
* @property string $name
* @property string $email
* @property integer $user_id
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property \App\User $user
* @property EloquentCollection $products
* @property EloquentCollection $orders
*/
abstract class MezzoMerchant extends \App\Mezzo\BaseModel
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
    protected $table = 'merchants';

    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array            
    */
    protected $rules = [
        'name' => "required|between:3,255", 
        'email' => "required|email"
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
        "name", 
        "email", 
        "user_id"
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
    * Attribute annotation property for name
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var string            
    */
    protected $_name;

    /**
    * Attribute annotation property for email
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
    * @var string            
    */
    protected $_email;

    /**
    * Attribute annotation property for user_id
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
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
    * @Mezzo\Relations\OneToOne
    * @Mezzo\Relations\From(table="users", primaryKey="id", naming="merchant")
    * @Mezzo\Relations\To(table="merchants", primaryKey="id", naming="user")
    * @Mezzo\Relations\JoinColumn(table="merchants", column="user_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_user;

    /**
    * Relation annotation property for products
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="products", primaryKey="id", naming="merchant")
    * @Mezzo\Relations\To(table="merchants", primaryKey="id", naming="products")
    * @Mezzo\Relations\JoinColumn(table="products", column="merchant_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_products;

    /**
    * Relation annotation property for orders
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="orders", primaryKey="id", naming="merchant")
    * @Mezzo\Relations\To(table="merchants", primaryKey="id", naming="orders")
    * @Mezzo\Relations\JoinColumn(table="orders", column="merchant_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_orders;


}
