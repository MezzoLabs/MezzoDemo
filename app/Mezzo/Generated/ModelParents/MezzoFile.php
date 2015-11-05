<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Traits\HasAnExtension;

abstract class MezzoFile extends BaseModel
{
    use IsMezzoModel;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    protected $fillable = ['title', 'folder', 'filename', 'disk', 'extension', 'info'];

    public $timestamps = true;

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
     * @Mezzo\Attribute(type="PrimaryKeyInput")
     * @var integer
     */
    protected $id;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $disk;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $title;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $folder;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $filename;

    /**
     *
     * @Mezzo\Attribute(type="TextInput")
     * @var string
     */
    protected $extension;

    /**
     *
     * @Mezzo\Attribute(type="TextArea")
     * @var string
     */
    protected $info;

    /**
     *
     * @Mezzo\Attribute(type="DateTimeInput")
     * @var \Carbon\Carbon
     */
    protected $created_at = false;

    /**
     *
     * @Mezzo\Attribute(type="DateTimeInput")
     * @var \Carbon\Carbon
     */
    protected $updated_at = false;


    /**
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="image_files", primaryKey="id", naming="file")
     * @Mezzo\Relations\To(table="files", primaryKey="id", naming="images")
     * @Mezzo\Relations\JoinColumn(table="files", column="id")
     */
    protected $images;


}
