<?php


namespace MezzoLabs\Mezzo\Core\Schema\ValidationRules;


use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class Rules extends Collection
{
    /**
     * Add a rule to the rule set for an attribute.
     *
     * @param Rule $rule
     * @throws MezzoException
     */
    public function addRule(Rule $rule)
    {
        if ($this->has($rule->name()))
            throw new MezzoException('This rule already exists ' . $rule->name());

        $this->put($rule->name(), $rule);
    }


    public function addRuleFromString($string)
    {
        $rules = $this->parseRule($string);

        return Rule::makeFromRuleArray($rules);
    }

    /**
     * @return string
     */
    public function toString()
    {
        $ruleStrings = array();

        $this->each(function (Rule $rule) use ($ruleStrings) {
            $ruleStrings[] = $rule->toString();
        });

        return implode('|', $ruleStrings);
    }

    /**
     * Extract the rule name and parameters from a rule.
     *
     * @param  array|string $rules
     * @return array
     */
    protected function parseRule($rules)
    {
        if (is_array($rules)) {
            return $this->parseArrayRule($rules);
        }

        return $this->parseStringRule($rules);
    }

    /**
     * Parse an array based rule.
     *
     * @param  array $rules
     * @return array
     */
    protected function parseArrayRule(array $rules)
    {
        return [Str::studly(trim(Arr::get($rules, 0))), array_slice($rules, 1)];
    }

    /**
     * Parse a string based rule.
     *
     * @param  string $rules
     * @return array
     */
    protected function parseStringRule($rules)
    {
        $parameters = [];

        // The format for specifying validation rules and parameters follows an
        // easy {rule}:{parameters} formatting convention. For instance the
        // rule "Max:3" states that the value may only be three letters.
        if (strpos($rules, ':') !== false) {
            list($rules, $parameter) = explode(':', $rules, 2);

            $parameters = $this->parseParameters($rules, $parameter);
        }

        return [Str::studly(trim($rules)), $parameters];
    }

    /**
     * Parse a parameter list.
     *
     * @param  string $rule
     * @param  string $parameter
     * @return array
     */
    protected function parseParameters($rule, $parameter)
    {
        if (strtolower($rule) == 'regex') {
            return [$parameter];
        }

        return str_getcsv($parameter);
    }
}