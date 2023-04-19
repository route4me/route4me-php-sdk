<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Common;
use Route4Me\V5\AddressBook\ResponseAddress;

/**
 * Address Book API ResponseAll structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class ResponseAll extends Common
{
    /**
     * Array of ResponceAddresses.
     * @var ResponceAddress[]
     */
    public ?array $results = null;

    /**
     * Total quantity of ResponceAddresses that match the query.
     * @example 1
     */
    public ?int $total = null;

    /**
     * An array of valid fields name in results array.
     * @var string[]
     */
    public ?array $fields = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'results') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $ra_key => $ra_value) {
                            if (is_array($ra_value)) {
                                array_push($this->{$key}, new ResponseAddress($ra_value));
                            } elseif (is_object($ra_value) && $ra_value instanceof ResponseAddress) {
                                array_push($this->{$key}, $ra_value);
                            }
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
