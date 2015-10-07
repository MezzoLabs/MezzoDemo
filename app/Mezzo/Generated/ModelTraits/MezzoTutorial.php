<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;



trait MezzoTutorial
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'tutorials';

    protected $rules = [
        
    ];

    /**
    *
    /*@Mezzo\InputType(type='RelationInputSingle')
    * @var integer            
    */
    protected $main_category;

    /**
    *
    /*@Mezzo\InputType(type='RelationInputSingle')
    * @var integer            
    */
    protected $parent;

    /**
    *
    /*@Mezzo\InputType(type='RelationInputSingle')
    * @var integer            
    */
    protected $user_id;


    /**
    /*@Mezzo\Relations\OneToMany
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='mainCategory')
    /*@Mezzo\Relations\To(table='categories', primaryKey='id', naming='mainTutorials')
    /*@Mezzo\Relations\JoinColumn(table='categories', column='id')
    */
    protected $mainCategory;

    /**
    /*@Mezzo\Relations\OneToOne
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='parent')
    /*@Mezzo\Relations\To(table='tutorials', primaryKey='id', naming='')
    /*@Mezzo\Relations\JoinColumn(table='tutorials', column='id')
    */
    protected $parent;

    /**
    /*@Mezzo\Relations\OneToMany
    /*@Mezzo\Relations\From(table='users', primaryKey='id', naming='tutorials')
    /*@Mezzo\Relations\To(table='tutorials', primaryKey='id', naming='owner')
    /*@Mezzo\Relations\JoinColumn(table='tutorials', column='id')
    */
    protected $owner;

    /**
    /*@Mezzo\Relations\ManyToMany
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='plannedCategories')
    /*@Mezzo\Relations\To(table='categories', primaryKey='id', naming='plannedTutorials')
    /*@Mezzo\Relations\PivotTable(name='planned_tutorial_category', fromColumn='tutorial_id', toColumn='category_id')
    */
    protected $plannedCategories;

    /**
    /*@Mezzo\Relations\OneToOne
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='mainImage')
    /*@Mezzo\Relations\To(table='images', primaryKey='id', naming='tutorial')
    /*@Mezzo\Relations\JoinColumn(table='images', column='id')
    */
    protected $mainImage;


}
