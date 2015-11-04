<?php


namespace MezzoLabs\Mezzo\Core\Helpers;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\MezzoException;
use MezzoLabs\Mezzo\Exceptions\UnexpectedException;

class Slug
{

    /**
     * @param string $name
     * @param string[] $neighbors
     * @param array $options
     * @return string
     * @throws UnexpectedException
     */
    public static function findNext($name, $neighbors, $options = ['separator' => '_'])
    {
        $options = new Collection($options);
        $neighbors = new Collection($neighbors);

        $separator = $options->get('seperator', '_');

        $i = 1;
        while ($i < 9999) {

            if ($i == 1)
                $possibleName = $name;
            else
                $possibleName = $name . $separator . ($i);

            if (!$neighbors->contains($possibleName))
                return $possibleName;

            $i++;
        }

        throw new UnexpectedException('Thats a hell of a lot similar strings.');

    }
}