<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
 *-------------------------------------------------------------------------------------------------------------------
*
 * AUTO GENERATED - MEZZO - MODEL PARENT
 *
 *-------------------------------------------------------------------------------------------------------------------
 *
 * Please do not edit, use "App\ImageFile" instead. Thank you.
 *
 *-------------------------------------------------------------------------------------------------------------------
 * Welcome to the model parent. This file is auto generated and tells Mezzo something about
 * your model. If you feel the need to overwrite something use the child class.
 *
 * App\Mezzo\Generated\ModelParents\MezzoImageFile
 *
* @property  integer $id
* @property string $cropping
 * @property string $caption
 * @property  integer $file_id
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
 * @property \App\File $file
 * @property EloquentCollection $posts
*/
abstract class MezzoImageFile extends BaseModel
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
    * The table associated with the model.
    *
     * @var string
    */
    protected $table = 'image_files';

    /**
    * Set of rules that will be validated in resource requests.
    *
     * @var array
    */
    protected $rules = [
        'cropping' => "",
        'caption' => ""
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
     * @var array
    */
    protected $hidden = [
        "file_id",
        "file"
    ];

    /**
    * The attributes that are mass assignable.
    *
     * @var array
    */
    protected $fillable = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /*
        |-------------------------------------------------------------------------------------------------------------------
        | Attribute annotation properties
        |-------------------------------------------------------------------------------------------------------------------    |
        | In this section you will find some annotated properties.
        | They are not really important for you, but they will tell Mezzo something about
        | the attributes of this model.
        |-------------------------------------------------------------------------------------------------------------------
        */

    /**
     * Attribute annotation property for id
    *
     * @Mezzo\Attribute(type="PrimaryKeyInput", hidden="")
    * @var integer            
    */
    protected $_id;

    /**
     * Attribute annotation property for cropping
    *
     * @Mezzo\Attribute(type="TextArea", hidden="")
    * @var string            
    */
    protected $_cropping;

    /**
     * Attribute annotation property for caption
    *
     * @Mezzo\Attribute(type="TextArea", hidden="")
     * @var string
    */
    protected $_caption;

    /**
     * Attribute annotation property for file_id
     *
     * @Mezzo\Attribute(type="RelationInputSingle", hidden="")
     * @var integer
     */
    protected $_file_id;

    /**
     * Attribute annotation property for created_at
    *
     * @Mezzo\Attribute(type="DateTimeInput", hidden="")
    * @var \Carbon\Carbon            
    */
    protected $_created_at;

    /**
     * Attribute annotation property for updated_at
    *
     * @Mezzo\Attribute(type="DateTimeInput", hidden="")
    * @var \Carbon\Carbon            
    */
    protected $_updated_at;


    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Relation annotation properties
    |-------------------------------------------------------------------------------------------------------------------
    | In this section you will find some annotated properties.
    | They are not really important for you, but they will tell Mezzo something about
    | the relations of this model.
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
     * Relation annotation property for file
     * @Mezzo\Relations\OneToOne
     * @Mezzo\Relations\From(table="image_files", primaryKey="id", naming="file")
     * @Mezzo\Relations\To(table="files", primaryKey="id", naming="images")
     * @Mezzo\Relations\JoinColumn(table="image_files", column="file_id")
     */
    protected $_file;

    /**
     * Relation annotation property for posts
     * @Mezzo\Relations\OneToMany
     * @Mezzo\Relations\From(table="posts", primaryKey="id", naming="main_image")
     * @Mezzo\Relations\To(table="image_files", primaryKey="id", naming="posts")
     * @Mezzo\Relations\JoinColumn(table="posts", column="main_image_id")
     */
    protected $_posts;


}
