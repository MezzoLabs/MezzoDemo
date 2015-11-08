<?php

namespace App\Mezzo\Generated\ModelParents;

use App\Mezzo\BaseModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
* App\Comment
*
* @property  integer $id
* @property string $content
* @property  float $tutorial_id
* @property  float $user_id
*/
abstract class MezzoComment extends BaseModel
{
    use IsMezzoModel;

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
    protected $table = 'comments';
    /**
    * Set of rules that will be validated in resource requests.
    *
    * @var array
    */
    protected $rules = [
        'content' => "required|between:10,1000",
        'tutorial_id' => "",
        'user_id' => ""
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
    protected $_content;

    /**
    *
    * @Mezzo\Attribute(type="NumberInput")
    * @var float            
    */
    protected $_tutorial_id;

    /**
    *
    * @Mezzo\Attribute(type="NumberInput")
    * @var float            
    */
    protected $_user_id;



}
