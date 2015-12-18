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

    public function __construct(SearchQuery $searchQuery = null, Filters $filters = null, Sortings $sortings = null)
    {
        $this->searchQuery = ($searchQuery) ? $searchQuery : new SearchQuery('');
        $this->filters = ($filters) ? $filters : new Filters();
        $this->sortings = ($sortings) ? $sortings : new Sortings();
    }

    public static function makeFromResourceRequest(ResourceRequest $request)
    {
        $searchQuery = new SearchQuery($request->get('q', ''));

        $sortings = Sortings::makeByString($request->get('sort', ''));
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
}