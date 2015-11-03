<?php


namespace App\Mezzo\Generated\ModelParents;


use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

abstract class MezzoPermission extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "permissions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['model', 'name', 'label'];

    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $rules = [
        'model' => 'max:255|alpha_num',
        'name' => 'required|max:255|alpha_dash',
        'label' => 'required|max:255|unique:permissions',
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
    protected $model;

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
     * @Mezzo\Relations\From(table="permissions", primaryKey="id", naming="roles")
     * @Mezzo\Relations\To(table="roles", primaryKey="id", naming="permissions")
     * @Mezzo\Relations\PivotTable(name="permission_role", fromColumn="permission_id", toColumn="user_id")
     *
     * @var EloquentCollection
     */
    protected $roles;
}