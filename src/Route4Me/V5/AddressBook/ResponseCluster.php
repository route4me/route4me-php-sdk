<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Exception\ApiError;
use Route4Me\Common;
use Route4Me\V5\AddressBook\Cluster;

/**
 * Address Book API ResponseCluster structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class ResponseCluster extends Common
{
    /**
     * Cluster of addresses
     */
    public ?Cluster $cluster = null;

    /**
     * A number of the returned addresses.
     * @example 1
     */
    public ?int $address_count = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'cluster') {
                        if (is_array($params[$key])) {
                            $this->{$key} = new Cluster($params[$key]);
                        } elseif (is_object($params[$key]) && $params[$key] instanceof Cluster) {
                            $this->{$key} = $params[$key];
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
