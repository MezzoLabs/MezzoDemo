<?php


namespace MezzoLabs\Mezzo\Http\Responses;

use Closure;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Http\Response as DingoResponse;
use Dingo\Api\Http\Response\Factory as DingoResponseFactory;
use Illuminate\Support\Collection;


class ApiResponseFactory extends DingoResponseFactory
{
    /**
     * @param $code
     * @return DingoResponse
     */
    public function result($code)
    {
        if ($code !== 1)
            throw new ResourceException();

        return $this->withArray([
            'data' => [
                'success' => true,
                'code' => $code
            ]
        ]);
    }

    /**
     * @param $array
     * @return DingoResponse
     */
    public function withArray($array)
    {
        return $this->array($array);
    }

    public function collection(Collection $collection, $transformer, array $parameters = [], Closure $after = null)
    {
        $collection = parent::collection($collection, $transformer, $parameters, $after);

        return $collection;
    }


}