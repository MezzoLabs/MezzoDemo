<?php


namespace App\Mezzo\Generated\ModelParents;


use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

abstract class MezzoRole extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    public $timestamps = false;


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $rules = [
        'name' => 'required|max:255|alpha_dash|unique:roles',
        'label' => 'required|max:255|alpha_num|unique:roles'
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
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $label;


    /**
     * @Mezzo\Attribute(type="RelationInputMultiple")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="roles")
     * @Mezzo\Relations\To(table="roles", primaryKey="id", naming="users")
     * @Mezzo\Relations\PivotTable(name="role_user", fromColumn="user_id", toColumn="role_id")
     *
     * @var EloquentCollection
     */
    protected $users;

    /**
     * @Mezzo\Attribute(type="RelationInputMultiple")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="roles", primaryKey="id", naming="permissions")
     * @Mezzo\Relations\To(table="permissions", primaryKey="id", naming="roles")
     * @Mezzo\Relations\PivotTable(name="permissions_role", fromColumn="role_id", toColumn="permission_id")
     *
     * @var EloquentCollection
     */
    protected $permissions;
}