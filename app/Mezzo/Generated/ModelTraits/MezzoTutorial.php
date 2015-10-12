<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

trait MezzoTutorial
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $mezzoTable = "tutorials";

    protected $mezzoRules = [
        "id" => "",
        "title" => "",
        "body" => "",
        "creator" => "",
        "created_at" => "",
        "updated_at" => ""
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
     * @Mezzo\Attribute(type="NumberInput")
     * @var float
     */
    protected $creator;

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

    /**
     *
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $main_category;


    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="tutorials")
     * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="owner")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="id")
     */
    protected $owner;

    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="mainCategory")
     * @Mezzo\Relations\To(table="categories", primaryKey="id", naming="mainTutorials")
     * @Mezzo\Relations\JoinColumn(table="categories", column="id")
     */
    protected $mainCategory;

    /**
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="parent")
     * @Mezzo\Relations\To(table="tutorials", primaryKey="id", naming="")
     * @Mezzo\Relations\JoinColumn(table="tutorials", column="id")
     */
    protected $parent;

    /**
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
     * @Mezzo\Relations\JoinColumn(table="images", column="id")
     */
    protected $mainImage;


}
