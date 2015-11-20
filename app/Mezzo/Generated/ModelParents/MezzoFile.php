<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
*-------------------------------------------------------------------------------------------------------------------
*
* AUTO GENERATED - MEZZO - MODEL PARENT
*
*-------------------------------------------------------------------------------------------------------------------
*
* Please not edit, use "App\File" instead. Thank you.
*
*-------------------------------------------------------------------------------------------------------------------
* Welcome to the model parent. This file is auto generated and tells Mezzo something about
* your model. If you feel the need to overwrite something use the child class.
*
* App\Mezzo\Generated\ModelParents\MezzoFile
*
* @property  integer $id
* @property  string $title
* @property  string $disk
* @property  string $folder
* @property  string $filename
* @property  string $extension
* @property string $info
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
*/
abstract class MezzoFile extends BaseModel
{
    use IsMezzoModel;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Eloquent properties
    |-------------------------------------------------------------------------------------------------------------------
    | The properties below will influence the work of the ORM Mapper "Eloquent".
    | Do not overwrite them here. Please use the power of computer science and edit them
    | in the model which extends this model parent.
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = true;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'files';
    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array
    */
    protected $rules = [
        'title' => "unique_with: files, folder",
        'disk' => "",
        'folder' => "",
        'filename' => "",
        'extension' => "",
        'info' => ""
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [

    ];
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "title",
        "folder",
        "filename",
        "disk",
        "extension",
        "info"
    ];

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Attribute annotation properties
    |-------------------------------------------------------------------------------------------------------------------    |
    | In this section you will find some annotated properties.
    | They are not really important, but they will tell Mezzo something about
    | the attributes of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */
    /**
    * Attribute annotation property for id
    *
    * @Mezzo\Attribute(type="PrimaryKeyInput")
    * @var integer            
    */
    protected $_id;

    /**
    * Attribute annotation property for title
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_title;

    /**
    * Attribute annotation property for disk
    *
     * @Mezzo\Attribute(type="TextInput", hidden="create,edit")
     * @var string
    */
    protected $_disk;

    /**
    * Attribute annotation property for folder
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_folder;

    /**
    * Attribute annotation property for filename
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_filename;

    /**
    * Attribute annotation property for extension
    *
    * @Mezzo\Attribute(type="TextInput")
    * @var string            
    */
    protected $_extension;

    /**
    * Attribute annotation property for info
    *
    * @Mezzo\Attribute(type="TextArea")
    * @var string            
    */
    protected $_info;

    /**
    * Attribute annotation property for created_at
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_created_at;

    /**
    * Attribute annotation property for updated_at
    *
    * @Mezzo\Attribute(type="DateTimeInput")
    * @var \Carbon\Carbon            
    */
    protected $_updated_at;


    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Relation annotation properties
    |-------------------------------------------------------------------------------------------------------------------
    | In this section you will find some annotated properties.
    | They are not really important, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */


}
