<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use App\Tutorial;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

abstract class MezzoComment extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "comments";

    public $timestamps = false;

    protected $rules = [
        "content" => "required|between:10,1000",
        "user_id" => "",
        "tutorial_id" => ""
    ];

    protected $fillable = [
        'content', 'user_id', 'tutorial_id'
    ];

    /**
     * @Mezzo\Attribute(type="PrimaryKeyInput")
     * @var float
     */
    protected $id;

    /**
     *
     * @Mezzo\Attribute(type="TextArea")
     * @var string
     */
    protected $content;


    /**
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $user_id;

    /**
     * @Mezzo\Attribute(type="RelationInputSingle")
     * @var integer
     */
    protected $tutorial_id;

    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="users", primaryKey="id", naming="tutorials")
     * @Mezzo\Relations\To(table="comments", primaryKey="id", naming="user")
     * @Mezzo\Relations\JoinColumn(table="comments", column="user_id")
     */
    protected $user;

    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="tutorials", primaryKey="id", naming="comments")
     * @Mezzo\Relations\To(table="comments", primaryKey="id", naming="tutorial")
     * @Mezzo\Relations\JoinColumn(table="comments", column="tutorial_id")
     */
    protected $tutorial;


}
