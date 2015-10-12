<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


abstract class PropertyAnnotations
{
    /**
     * @var string
     */
    protected $attributeName;
    
    /**
     * @var ModelAnnotations
     */
    private $modelAnnotations;

    public function __construct()
    {
        
    }
}