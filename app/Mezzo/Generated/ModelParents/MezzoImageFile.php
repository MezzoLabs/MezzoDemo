<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

abstract class MezzoImageFile extends BaseModel
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'image_files';

    protected $rules = [
        'cropping' => ""
    ];

    /**
    *
    * @Mezzo\Attribute(type="PrimaryKeyInput")
    * @var integer            
    */
    protected $id;

    /**
    *
    * @Mezzo\Attribute(type="TextArea")
    * @var string            
    */
    protected $cropping;

    /**
    *
    * @Mezzo\Attribute(type="RelationInputSingle")
    * @var integer            
    */
    protected $file_id;

    /**
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $created_at;

    /**
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $updated_at;


    /**
    * @Mezzo\Relations\OneToOne
    * @Mezzo\Relations\From(table="image_files", primaryKey="id", naming="file")
    * @Mezzo\Relations\To(table="files", primaryKey="id", naming="images")
    * @Mezzo\Relations\JoinColumn(table="files", column="id")
    */
    protected $file;


}
