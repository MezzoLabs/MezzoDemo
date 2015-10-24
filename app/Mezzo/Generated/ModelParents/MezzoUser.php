<?php


namespace App\Mezzo\Generated\ModelParents;


use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

abstract class MezzoUser extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6'
    ];

    /**
     * @Mezzo\Attribute(type="NumberInput")
     * @var int
     */
    protected $id;

    /**
     * @Mezzo\Attribute(type="TextInput")
     * @var int
     */
    protected $name;

    /**
     * @Mezzo\Attribute(type="EmailInput")
     * @var int
     */
    protected $email;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $created_at;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $updated_at;
}