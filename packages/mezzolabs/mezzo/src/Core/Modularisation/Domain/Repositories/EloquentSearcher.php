<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use MezzoLabs\Mezzo\Http\Requests\Queries\Filter;
use MezzoLabs\Mezzo\Http\Requests\Queries\Filters;
use MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject;
use MezzoLabs\Mezzo\Http\Requests\Queries\SearchQuery;
use MezzoLabs\Mezzo\Http\Requests\Queries\Sorting;
use MezzoLabs\Mezzo\Http\Requests\Queries\Sortings;

class EloquentSearcher implements SearcherContract
{
    /**
     * @var EloquentBuilder
     */
    protected $eloquentBuilder;

    /**
     * @var QueryObject
     */
    protected $queryObject;

    /**
     * EloquentSearcher constructor.
     * @param QueryObject $queryObject
     * @param EloquentBuilder $eloquentBuilder
     */
    public function __construct(QueryObject $queryObject, EloquentBuilder $eloquentBuilder)
    {
        $this->eloquentBuilder = $eloquentBuilder;
        $this->queryObject = $queryObject;
    }

    public function run() : EloquentBuilder
    {
        $this->applySearchQuery($this->queryObject->searchQuery());
        $this->applyFilters($this->queryObject->filters());
        $this->applySortings($this->queryObject->sortings());

        return $this->eloquentBuilder;
    }

    protected function applySearchQuery(SearchQuery $searchQuery)
    {
        if ($searchQuery->isEmpty())
            return;

        //TODO: Improve this please

        foreach ($searchQuery->columns() as $column) {
            $this->eloquentBuilder->orWhere($column, 'LIKE', '%' . $searchQuery->value() . '%');
        }

    }

    protected function applyFilters(Filters $filters)
    {
        $filters->each(function (Filter $filter) {
            $this->eloquentBuilder->where($filter->column(), '=', $filter->value());
        });
    }

    protected function applySortings(Sortings $sortings)
    {
        $sortings->each(function (Sorting $sorting) {
            $this->eloquentBuilder->orderBy($sorting->by(), $sorting->mysqlDirection());
        });
    }


    public function setQueryObject(QueryObject $queryObject) : QueryObject
    {
        $this->queryObject = $queryObject;
    }

    public function getQueryObject() : QueryObject
    {
        return $this->queryObject;
    }
}