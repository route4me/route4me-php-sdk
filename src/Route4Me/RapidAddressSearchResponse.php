<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

class RapidAddressSearchResponse
{
    public $zipcode;
    public $street_name;
    public $county_no;

    public static function fromArray(array $params)
    {
        $rapidSearch = new self();

        foreach ($params as $key => $value) {
            if (property_exists($rapidSearch, $key)) {
                $rapidSearch->{$key} = $value;
            }
        }

        return $rapidSearch;
    }
}