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
 * Please do not edit, use "App\Order" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoOrder
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $merchant_id
 * @property string $info
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \App\User $user
 * @property \App\Merchant $merchant
 * @property EloquentCollection $products
 */
abstract class MezzoOrder extends \App\Mezzo\BaseModel
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
    protected $table = 'orders';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'info' => "",
        'status' => "",
        'merchant_id' => "required|exists:merchants,id",
        'user_id' => 'required|exists:users,id'
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
        'user_id',
        'products',
        'info',
        'status',
        'created_at'
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
     * Attribute annotation property for user_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_user_id;

    /**
     * Attribute annotation property for merchant_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_merchant_id;

    /**
     * Attribute annotation property for info
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea", hidden="")
     * @var string
     */
    protected $_info;

    /**
     * Attribute annotation property for status
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_status;

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
     * Relation annotation property for user
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="orders")
     * @Mezzo\Relations\To(table="orders", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="orders", column="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_user;

    /**
     * Relation annotation property for merchant
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="orders", primaryKey="id", naming="merchant")
     * @Mezzo\Relations\To(table="merchants", primaryKey="id", naming="orders")
     * @Mezzo\Relations\JoinColumn(table="orders", column="merchant_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_merchant;

    /**
     * Relation annotation property for products
     * @Mezzo\Attribute(type="\MezzoLabs\Mezzo\Core\Schema\InputTypes\PivotRowsInput", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="products", primaryKey="id", naming="orders")
     * @Mezzo\Relations\To(table="orders", primaryKey="id", naming="products")
     * @Mezzo\Relations\PivotTable(name="order_product", fromColumn="product_id", toColumn="order_id")
     * @Mezzo\Relations\PivotColumn(name="amount", type="MezzoLabs\Mezzo\Core\Schema\InputTypes\NumberInput", rules="numeric|between:1,50")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_products;


}
