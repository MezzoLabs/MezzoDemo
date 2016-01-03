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
 * Please do not edit, use "App\Product" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoProduct
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property float $premium_price
 * @property boolean $premium_only
 * @property integer $merchant_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Merchant $merchant
 * @property EloquentCollection $orders
 * @property EloquentCollection $shoppingBaskets
 */
abstract class MezzoProduct extends \App\Mezzo\BaseModel
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
    protected $table = 'products';

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'title' => "",
        'description' => "",
        'price' => "",
        'premium_price' => "",
        'premium_only' => ""
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
     * Attribute annotation property for description
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextArea", hidden="")
     * @var string
     */
    protected $_description;

    /**
     * Attribute annotation property for price
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\FloatInput", hidden="")
     * @var float
     */
    protected $_price;

    /**
     * Attribute annotation property for premium_price
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\FloatInput", hidden="")
     * @var float
     */
    protected $_premium_price;

    /**
     * Attribute annotation property for premium_only
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\CheckboxInput", hidden="")
     * @var boolean
     */
    protected $_premium_only;

    /**
     * Attribute annotation property for merchant_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_merchant_id;

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
     * Relation annotation property for merchant
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="products", primaryKey="id", naming="merchant")
     * @Mezzo\Relations\To(table="merchants", primaryKey="id", naming="products")
     * @Mezzo\Relations\JoinColumn(table="products", column="merchant_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_merchant;

    /**
     * Relation annotation property for orders
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="products", primaryKey="id", naming="orders")
     * @Mezzo\Relations\To(table="orders", primaryKey="id", naming="products")
     * @Mezzo\Relations\PivotTable(name="order_product", fromColumn="product_id", toColumn="order_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_orders;

    /**
     * Relation annotation property for shoppingBaskets
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="shopping_baskets", primaryKey="id", naming="products")
     * @Mezzo\Relations\To(table="products", primaryKey="id", naming="shoppingBaskets")
     * @Mezzo\Relations\PivotTable(name="product_shopping_basket", fromColumn="shopping_basket_id", toColumn="product_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_shoppingBaskets;


}
