<?php

namespace Route4Me\V5\Orders;

use Route4Me\Common;

/**
 * The Order custom field structure
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class CustomField extends Common
{
    /**
     * HEX-String.
     */
    public ?string $order_custom_field_uuid = null;

    /**
     * Name, max 128 characters.
     */
    public ?string $order_custom_field_name = null;

    /**
     * Type, max 128 characters.
     */
    public ?string $order_custom_field_type = null;

    /**
     * Label, max 128 characters.
     */
    public ?string $order_custom_field_label = null;

    /**
     * Info, as JSON Object max 4096 characters.
     */
    public ?array $order_custom_field_type_info = null;

    /**
     * Value of Custom Fields.
     */
    public ?string $order_custom_field_value = null;

    public function __construct(array $params = null)
    {
        if ($params != null) {
            $this->fillFromArray($params);
        }
    }
}
