<?php


namespace MezzoLabs\Mezzo\Http\Requests\Queries;


class SearchQuery
{
    /**
     * @var string
     */
    private $value;

    /**
     * SearchQuery constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    public function isEmpty()
    {
        return empty($this->value);
    }
}