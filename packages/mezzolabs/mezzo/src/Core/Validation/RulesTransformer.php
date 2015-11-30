<?php


namespace MezzoLabs\Mezzo\Core\Validation;


use Illuminate\Support\Collection;

class RulesTransformer
{
    /**
     * @var Collection
     */
    protected $ruleStrings;

    /**
     * @param array|Collection $ruleStrings
     */
    public function __construct($ruleStrings)
    {
        $this->ruleStrings = new Collection($ruleStrings);
    }

    /**
     * @return array
     */
    public function rulesForUpdating()
    {
        return $this->ruleStrings->toArray();
    }

    /**
     * @return array
     */
    public function rulesForStoring()
    {
        return $this->ruleStrings->toArray();
    }
}