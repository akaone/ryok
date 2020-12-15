<?php


namespace App\Utils;


use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;


class HashUuid
{
    public static function forArrayCollection($collection, $objectKeys)
    {

        $short = new ShortUuid();
        $temp = $collection;

        $temp->each(function($item, $key) use ($short, &$temp, $objectKeys ) {
            foreach ($objectKeys as $el => $value) {
                $temp[$key]->$value = $short->encode(Uuid::fromString($item->$value));
            }
        });

        return $temp;
    }

    public static function forCollection($collection, $objectKeys)
    {

        $short = new ShortUuid();
        $temp = $collection;

        foreach ($objectKeys as $key => $value) {
            $temp->$value = $short->encode(Uuid::fromString($temp->$value));
        }

        return $temp;
    }
}
