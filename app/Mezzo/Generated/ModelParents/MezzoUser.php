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
* Please not edit, use "App\User" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoUser
*
* @property  integer $id
* @property  string $name
* @property  string $email
* @property  string $password
* @property  string $remember_token
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/
abstract class MezzoUser extends BaseModel
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
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = true;
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
        'name' => "required|max:255",
        'email' => "required|email|max:255|unique:users",
        'password' => "required|confirmed|min:6",
        'remember_token' => ""
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        "remember_token",
        "password"
    ];
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "name",
        "email",
        "password",
        "roles"
    ];

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Attribute annotation properties
    |-------------------------------------------------------------------------------------------------------------------    |
    | In this section you will find some annotated properties.
    | They are not really important, but they will tell Mezzo something about
    | the attributes of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */
    /**
    * Attribute annotation property for id
    *
    * @Mezzo\Attribute(type="PrimaryKeyInput")
    * @var integer            
    */
    protected $_id;

    /**
    * Attribute annotation property for name
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_name;

    /**
    * Attribute annotation property for email
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_email;

    /**
    * Attribute annotation property for password
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_password;

    /**
    * Attribute annotation property for remember_token
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_remember_token;

    /**
    * Attribute annotation property for created_at
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_created_at;

    /**
    * Attribute annotation property for updated_at
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_updated_at;


    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Relation annotation properties
    |-------------------------------------------------------------------------------------------------------------------
    | In this section you will find some annotated properties.
    | They are not really important, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */


    /**
     * @Mezzo\Attribute(type="RelationInputMultiple")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="roles")
     * @Mezzo\Relations\To(table="roles", primaryKey="id", naming="users")
     * @Mezzo\Relations\PivotTable(name="role_user", fromColumn="user_id", toColumn="role_id")
     *
     * @var EloquentCollection
     */
    protected $roles;

    /**
     * @Mezzo\Attribute(type="RelationInputMultiple")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="tutorials")
     * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="parent")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="user_id")
     *
     * @var EloquentCollection
     */
    protected $tutorials;


}
