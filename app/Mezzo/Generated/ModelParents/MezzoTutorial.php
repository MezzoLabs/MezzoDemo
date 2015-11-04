<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use App\Tutorial;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

abstract class MezzoTutorial extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "tutorials";

    protected $rules = [
        "title" => "",
        "body" => "required",
        "created_at" => "",
        "updated_at" => ""
    ];

    protected $fillable = [
        'title', 'body', 'created_at', 'updated_at', 'user_id', 'main_category_id', 'parent_id'
    ];

    /**
     * @Mezzo\Attribute(type="NumberInput")
     * @var float
     */
    protected $id;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $title;

    /**
     *
     * @Mezzo\Attribute(type="TextArea")
     * @var string
     */
    protected $body;

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
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $user_id;

    /**
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $parent_id;

    /**
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $main_category;

    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="tutorials")
     * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="owner")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="user_id")
     */
    protected $owner;

    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="mainCategory")
     * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="mainTutorials")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="main_category")
     */
    protected $mainCategory;

    /**
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="parent")
     * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="parent_id")
     */
    protected $parent;

    /**
     * @Mezzo\Attribute(type="RelationInputMultiple")
     * @Mezzo\Relations\ManyToMany
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="plannedCategories")
     * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="plannedTutorials")
     * @Mezzo\Relations\PivotTable(name="planned_tutorial_category", fromColumn="tutorial_id", toColumn="category_id")
     */
    protected $plannedCategories;

    /**
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="mainImage")
     * @Mezzo\Relations\To(table="images", primaryKey="id", naming="tutorial")
     * @Mezzo\Relations\JoinColumn(table="images", column="tutorial_id")
     */
    protected $mainImage;

    /**
     * @Mezzo\Attribute(type="RelationInputMultiple")
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="comments")
     * @Mezzo\Relations\To(table="comments", primaryKey="id", naming="tutorial")
     * @Mezzo\Relations\JoinColumn(table="categories", column="tutorial_id")
     */
    protected $comments;


}
