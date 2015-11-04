<?php


namespace App\Mezzo\Generated\ModelParents;


use App\Mezzo\BaseModel;
use Carbon\Carbon;
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
    protected $fillable = ['name', 'email', 'password', 'roles'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token', 'password'];

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
     * @var Carbon
     */
    protected $created_at;

    /**
     *
     * @Mezzo\Attribute(type="DateTimeInput")
     * @var Carbon
     */
    protected $updated_at;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var String
     */
    protected $remember_token;

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