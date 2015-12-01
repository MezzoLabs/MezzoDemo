<?php


namespace MezzoLabs\Mezzo\Core\Validation;


use Illuminate\Support\Arr;
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
        $this->ruleStrings = new Collection(Arr::dot($ruleStrings));
    }

    /**
     * @param array $dirty
     * @return array
     */
    public function rulesForUpdating(array $dirty)
    {
        return $this->ruleStrings->map(function ($rule, $key) use ($dirty) {
            return $this->transformRuleForUpdate($key, $rule, in_array($key, $dirty));
        })->toArray();
    }

    protected function transformRuleForUpdate($key, $rule, $isDirty = true)
    {
        if(!$isDirty)
            return "";

        //TODO: remove required and unique rules if needed

        return $rule;
    }

    /**
     * @return array
     */
    public function rulesForStoring()
    {
        return $this->ruleStrings->toArray();
    }

    /**
     * @param $rulesArray
     * @return array
     */
    public static function removeRequiredRules($rulesArray, array $forColumns = [])
    {
        return static::removeRulesType('required', $rulesArray, $forColumns);
    }

    public static function removeUniqueRules($rulesArray, array $forColumns = [])
    {
        return static::removeRulesType('unique', $rulesArray, $forColumns);
    }

    /**
     * @param $ruleType
     * @param array $rulesArray
     * @param array $forColumns
     * @return array
     */
    protected static function removeRulesType($ruleType, array $rulesArray, array $forColumns = [])
    {
        $updateRules = [];
        foreach ($rulesArray as $column => &$rule) {
            if (!in_array($column, $forColumns)) {
                $updateRules[$column] = $rule;
                continue;
            }

            $changedRule = preg_replace("/(" . $ruleType . "[^|]*)/", "", $rule);
            $changedRule = trim(str_replace('||', '', $changedRule), '|');

            $updateRules[$column] = $changedRule;
        }

        return $updateRules;
    }
}