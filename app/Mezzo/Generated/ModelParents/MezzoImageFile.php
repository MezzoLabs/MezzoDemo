<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
* App\ImageFile
*
* @property  integer $id
* @property string $cropping
* @property  float $file_id
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/
abstract class MezzoImageFile extends BaseModel
{
    use IsMezzoModel;

    /**
    * Indicates if the model should be timestamped.
    *
    * @var  bool
    */
    public $timestamps = true;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'image_files';
    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var  array
    */
    protected $rules = [
        'cropping' => "",
        'file_id' => ""
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var  array
    */
    protected $hidden = [
        "file_id", "file"
    ];
    /**
    * The attributes that are mass assignable.
    *
    * @var  array
    */
    protected $fillable = [

    ];
    /**
    *
    * @Mezzo\Attribute(type="PrimaryKeyInput")
    * @var integer            
    */
    protected $_id;

    /**
    *
    * @Mezzo\Attribute(type="TextArea")
    * @var string            
    */
    protected $_cropping;

    /**
    *
    * @Mezzo\Attribute(type="NumberInput")
    * @var float            
    */
    protected $_file_id;

    /**
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_created_at;

    /**
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_updated_at;



}
