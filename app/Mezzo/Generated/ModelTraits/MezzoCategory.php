<?php

namespace App\Mezzo\Generated\ModelTraits;

use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;



trait MezzoCategory
{
    use IsMezzoModel;

    /**
    * The table associated with the model.
    *
    * @var string            
    */
    protected $table = 'categories';

    protected $rules = [
        
    ];


    /**
    /*@Mezzo\Relations\ManyToMany
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='plannedCategories')
    /*@Mezzo\Relations\To(table='categories', primaryKey='id', naming='plannedTutorials')
    /*@Mezzo\Relations\PivotTable(name='planned_tutorial_category', fromColumn='tutorial_id', toColumn='category_id')
    */
    protected $plannedTutorials;

    /**
    /*@Mezzo\Relations\ManyToMany
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='plannedCategories')
    /*@Mezzo\Relations\To(table='categories', primaryKey='id', naming='plannedTutorials')
    /*@Mezzo\Relations\PivotTable(name='planned_tutorial_category', fromColumn='tutorial_id', toColumn='category_id')
    */
    protected $plannedTutorials;

    /**
    /*@Mezzo\Relations\OneToMany
    /*@Mezzo\Relations\From(table='tutorials', primaryKey='id', naming='mainCategory')
    /*@Mezzo\Relations\To(table='categories', primaryKey='id', naming='mainTutorials')
    /*@Mezzo\Relations\JoinColumn(table='categories', column='id')
    */
    protected $mainTutorials;


}
