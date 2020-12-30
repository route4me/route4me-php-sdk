<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

class SearchResponse
{
    public $results=[];
    public $total;
    public $fields=[];

    public static function fromArray(array $params)
    {
        $searchResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($searchResponse, $key)) {
                $searchResponse->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $searchResponse;
    }
}
