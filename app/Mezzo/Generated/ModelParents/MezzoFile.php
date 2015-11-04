<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

abstract class MezzoFile extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    protected $rules = [
        'title' => "",
        'folder' => "",
        'filename' => "",
        'extension' => "",
        'info' => "",
        'created_at' => "",
        'updated_at' => ""
    ];

    /**
     *
     * @Mezzo\Attribute(inputType="PrimaryKeyInput")
     * @var integer
     */
    protected $id;

    /**
     *
     * @Mezzo\Attribute(inputType="TextInput")
     * @var string
     */
    protected $title;

    /**
     *
     * @Mezzo\Attribute(inputType="TextInput")
     * @var string
     */
    protected $folder;

    /**
     *
     * @Mezzo\Attribute(inputType="TextInput")
     * @var string
     */
    protected $filename;

    /**
     *
     * @Mezzo\Attribute(inputType="TextInput")
     * @var string
     */
    protected $extension;

    /**
     *
     * @Mezzo\Attribute(inputType="TextArea")
     * @var string
     */
    protected $info;

    /**
     *
     * @Mezzo\Attribute(inputType="DateTimeInput")
     * @var \Carbon\Carbon
     */
    protected $created_at;

    /**
     *
     * @Mezzo\Attribute(inputType="DateTimeInput")
     * @var \Carbon\Carbon
     */
    protected $updated_at;


    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="image_files", primaryKey="id", naming="file")
     * @Mezzo\Relations\To(table="files", primaryKey="id", naming="images")
     * @Mezzo\Relations\JoinColumn(table="files", column="id")
     */
    protected $images;


}
