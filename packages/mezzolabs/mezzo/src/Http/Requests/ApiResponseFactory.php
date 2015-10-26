<?php


namespace MezzoLabs\Mezzo\Http\Requests;

use Dingo\Api\Http\Response as DingoResponse;
use Dingo\Api\Http\Response\Factory as DingoResponseFactory;


class ApiResponseFactory extends DingoResponseFactory
{
    /**
     * @param $code
     * @return DingoResponse
     */
    public function result($code)
    {
        return $this->withArray([
            'result' => $code
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
}