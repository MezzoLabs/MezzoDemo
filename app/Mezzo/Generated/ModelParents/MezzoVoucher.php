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
* Please do not edit, use "App\Voucher" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoVoucher
*
 * @property integer $id
 * @property string $voucher_key
 * @property string $type
 * @property integer $only_for_id
 * @property boolean $is_global
 * @property \Carbon\Carbon $active_until
 * @property string $options
 * @property \Carbon\Carbon $redeemed_at
* @property integer $redeemed_by_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\User $onlyFor
* @property \App\User $redeemedBy
 * @property EloquentCollection $redeemedByUsers
*/
abstract class MezzoVoucher extends \App\Mezzo\BaseModel
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
    protected $table = 'vouchers';

    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array            
    */
    protected $rules = [
        'voucher_key' => "alpha_space_dash",
        'type' => "in:default,subscription,coupon",
        'is_global' => "",
        'active_until' => "", 
        'options' => "", 
        'redeemed_at' => ""
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
        "voucher_key",
        "type",
        "is_global",
        "active_until",
        "only_for_id",
        "options",
        "redeemed_at", 
        "redeemed_by_id"
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
     * Attribute annotation property for voucher_key
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\TextInput", hidden="")
     * @var string
     */
    protected $_voucher_key;

    /**
     * Attribute annotation property for type
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\SelectInput", hidden="")
     * @var string
     */
    protected $_type;

    /**
     * Attribute annotation property for only_for_id
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_only_for_id;

    /**
     * Attribute annotation property for is_global
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\CheckboxInput", hidden="")
     * @var boolean
     */
    protected $_is_global;

    /**
     * Attribute annotation property for active_until
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_active_until;

    /**
     * Attribute annotation property for options
     *
     * @Mezzo\Attribute(type="App\Magazine\Shop\Schema\InputTypes\VoucherOptionsInput", hidden="index")
     * @var string
     */
    protected $_options;

    /**
     * Attribute annotation property for redeemed_at
     *
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\DateTimeInput", hidden="")
     * @var \Carbon\Carbon
     */
    protected $_redeemed_at;

    /**
    * Attribute annotation property for redeemed_by_id
    *
    * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle", hidden="")
    * @var integer            
    */
    protected $_redeemed_by_id;

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
     * Relation annotation property for onlyFor
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="vouchers", primaryKey="id", naming="onlyFor")
     * @Mezzo\Relations\To(table="users", primaryKey="id", naming="personalVouchers")
     * @Mezzo\Relations\JoinColumn(table="vouchers", column="only_for_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_onlyFor;

    /**
    * Relation annotation property for redeemedBy
    * @Mezzo\Relations\OneToMany
    * @Mezzo\Relations\From(table="vouchers", primaryKey="id", naming="redeemedBy")
     * @Mezzo\Relations\To(table="users", primaryKey="id", naming="redeemedPersonalVouchers")
    * @Mezzo\Relations\JoinColumn(table="vouchers", column="redeemed_by_id")
    * @Mezzo\Relations\Scopes("")
    */
    protected $_redeemedBy;

    /**
     * Relation annotation property for redeemedByUsers
     * @Mezzo\Attribute(type="MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputMultiple", hidden="")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="vouchers", primaryKey="id", naming="redeemedByUsers")
     * @Mezzo\Relations\To(table="users", primaryKey="id", naming="redeemedGlobalVouchers")
     * @Mezzo\Relations\PivotTable(name="redeemed_vouchers", fromColumn="voucher_id", toColumn="user_id")
     * @Mezzo\Relations\Scopes("")
     */
    protected $_redeemedByUsers;


}
