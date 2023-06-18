<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

/**
 * The class for a response from the address book contacts search request.
 * @package Route4Me
 */
class SearchResponse extends Common
{
    /**
     * An array of the AddressBookContact type objects.
     * @var AddressBookLocation[]
     */
    public $results=[];

    /**
     * Total number of the returned contacts
     * @var integer
     */
    public $total;

    /**
     * An array of the field names to be shown
     * @var string[]
     */
    public $fields=[];

    /**
     * The contacts query in the JSON format
     * @var string
     */
    public $index_query;
}
