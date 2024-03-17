<?php

namespace Route4Me\V5\Orders;

use Route4Me\Common;
use Route4Me\V5\Orders\ResponseOrder;

/**
 * The Response search structure
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class ResponseSearch extends Common
{
    /**
     * Total number of orders found.
     */
    public ?int $total = null;

    /**
     * An array of field names asked in the request.
     * If null then field names were not asked.
     */
    public ?array $fields = null;

    /**
     * An array of orders received from the server.
     */
    public ?array $results = null;

    public function __construct(array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'results') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $r_key => $r_value) {
                            if (is_array($r_value)) {
                                array_push($this->{$key}, new ResponseOrder($r_value));
                            } elseif (is_object($r_value) && $r_value instanceof ResponseOrder) {
                                array_push($this->{$key}, $r_value);
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
