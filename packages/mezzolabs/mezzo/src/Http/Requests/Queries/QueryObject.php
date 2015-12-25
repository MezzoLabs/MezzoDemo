<?php


namespace MezzoLabs\Mezzo\Http\Requests\Queries;


use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;

class QueryObject
{
    /**
     * @var SearchQuery
     */
    protected $searchQuery;

    /**
     * @var Filters
     */
    protected $filters;

    /**
     * @var Sortings
     */
    protected $sortings;

    public function __construct()
    {
        $this->searchQuery = new SearchQuery('', []);
        $this->filters = new Filters();
        $this->sortings = new Sortings();
    }

    /**
     * Method for creating a query object out of the current resource request.
     *
     * @param ResourceRequest $request
     * @return QueryObject
     */
    public static function makeFromResourceRequest(ResourceRequest $request) : QueryObject
    {
        $searchQuery = new SearchQuery($request->get('q', ''), $request->modelReflection()->searchable());
        $sortings = Sortings::makeByString($request->get('sort', ''));
        $filters = Filters::makeByArray($request->all(), $request->modelReflection());

        return (new static())
            ->withSearch($searchQuery)
            ->withSortings($sortings)
            ->withFilters($filters);
    }

    /**
     * @return SearchQuery
     */
    public function searchQuery()
    {
        return $this->searchQuery;
    }

    /**
     * @return Filters
     */
    public function filters()
    {
        return $this->filters;
    }

    /**
     * @return Sortings
     */
    public function sortings()
    {
        return $this->sortings;
    }

    public function hasSortings()
    {
        return !$this->sortings()->isEmpty();
    }

    public function hasFilters()
    {
        return !$this->filters()->isEmpty();
    }

    public function hasSearchQuery()
    {
        return !$this->searchQuery()->isEmpty();
    }

    /**
     * @param SearchQuery $searchQuery
     * @return QueryObject
     */
    public function withSearch(SearchQuery $searchQuery) : QueryObject
    {
        $this->searchQuery = $searchQuery;
        return $this;
    }

    /**
     * @param Filters $filters
     * @return QueryObject
     */
    public function withFilters(Filters $filters) : QueryObject
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @param Sortings $sortings
     * @return QueryObject
     */
    public function withSortings(Sortings $sortings) : QueryObject
    {
        $this->sortings = $sortings;
        return $this;
    }
}