<?php


namespace MezzoLabs\Mezzo\Core\Validation;


use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

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
     * @param array $dirtyKeys
     * @return array
     */
    public function rulesForUpdating(array $dirtyKeys)
    {
        return $this->ruleStrings->map(function ($rule, $key) use ($dirtyKeys) {
            return $this->transformRuleForUpdate($key, $rule, in_array($key, $dirtyKeys));
        })->toArray();
    }

    protected function transformRuleForUpdate($key, $rule, $isDirty = true)
    {
        //Do not touch rules if the according model attribute is dirty or if the rule is nested.
        if ($isDirty || str_contains($key, '.')) {
            return $rule;
        }

        $rule = static::removeRequired($rule);
        $rule = static::removeUnique($rule);

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
     * @param $rule
     * @return array
     * @throws MezzoException
     * @internal param $rulesArray
     */
    public static function removeRequired($rule)
    {
        return static::removeRulesType('required', $rule);
    }

    public static function removeUnique($rule)
    {
        $rule = static::removeRulesType('unique', $rule);
        $rule = static::removeRulesType('unique_with', $rule);

        return $rule;
    }

    /**
     * Removes a rule from a rule string
     *
     * @param string $typeToRemove
     * @param string $rule
     * @return array
     * @throws MezzoException
     */
    protected static function removeRulesType($typeToRemove, $rule)
    {
        if(is_array($rule)) {
            throw new MezzoException('Cannot transform a rule array.');
        }

        $changedRule = preg_replace("/(" . $typeToRemove . "[^|]*)/", "", $rule);
        $changedRule = trim(str_replace('||', '', $changedRule), '|');

        return $changedRule;
    }

}