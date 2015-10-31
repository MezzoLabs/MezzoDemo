<?php


namespace App\Mezzo\Generated\ModelParents;


use App\Mezzo\BaseModel;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
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
    protected $hidden = [ 'remember_token'];

    /**
     * @var array
     */
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
     * @var string
     */
    protected $name;

    /**
     * @Mezzo\Attribute(type="PasswordInput")
     * @var string
     */
    protected $password;

    /**
     * @Mezzo\Attribute(type="EmailInput")
     * @var string
     */
    protected $email;

    /**
     *
     * @Mezzo\Attribute(type="DateTimeInput")
     * @var string
     */
    protected $created_at;

    /**
     *
     * @Mezzo\Attribute(type="DateTimeInput")
     * @var string
     */
    protected $updated_at;

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
}