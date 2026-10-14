<?php

namespace Route4Me;

/**
 * The class for a response from the address book contacts search request.
 */
class SearchResponse extends Common
{
    /**
     * An array of the AddressBookContact type objects.
     * @var AddressBookLocation[]
     */
    public $results = [];

    /**
     * Total number of the returned contacts.
     * @var int
     */
    public $total;

    /**
     * An array of the field names to be shown.
     * @var string[]
     */
    public $fields = [];

    /**
     * The contacts query in the JSON format.
     * @var string
     */
    public $index_query;
}
