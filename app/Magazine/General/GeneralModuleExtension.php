<?php


namespace App\Magazine\General;


use MezzoLabs\Mezzo\Modules\General\GeneralModule;

class GeneralModuleExtension
{
    /**
     * @var GeneralModule
     */
    protected $generalModule;

    public function __construct(GeneralModule $generalModule)
    {
        $this->generalModule = $generalModule;
    }

    /**
     * @return GeneralModule
     */
    public function module()
    {
        return $this->generalModule;
    }


}