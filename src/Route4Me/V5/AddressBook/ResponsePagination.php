<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\V5\AddressBook\ResponseAll;

/**
 * Address Book API ResponsePagination structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class ResponsePagination extends ResponseAll
{
    /**
     * Current page in the adddress book collection.
     * @example 1
     */
    public ?int $current_page = null;

    /**
     * Last page in the adddress book collection.
     * @example 3
     */
    public ?int $last_page = null;

    /**
     * Adddress book number per page.
     * @example 30
     */
    public ?int $per_page = null;

    public function __construct(?array $params = null)
    {
        parent::__construct($params);
    }
}
