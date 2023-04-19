<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Common;
use Route4Me\V5\AddressBook\Cluster;

/**
 * Address Book API ResponseClustering structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class ResponseClustering extends Common
{
    /**
     * An array of the address clusters.
     * @var Cluster[]
     */
    public ?array $clusters = null;

    /**
     * Total quantity of the address Clusters that match the query.
     * @example 1
     */
    public ?int $total = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'clusters') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $clst_key => $clst_value) {
                            if (is_array($clst_value)) {
                                array_push($this->{$key}, new Cluster($clst_value));
                            } elseif (is_object($clst_value) && $clst_value instanceof Cluster) {
                                array_push($this->{$key}, $clst_value);
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
