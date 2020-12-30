<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

class AddressBookLocationSearchResponse
{
    public $results=[];
    public $total;
    public $fields=[];

    public static function fromArray(array $params)
    {
        $ablSearchResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($ablSearchResponse, $key)) {
                $ablSearchResponse->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $ablSearchResponse;
    }
}