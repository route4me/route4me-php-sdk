<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Common As Common;

/**
 * Parameters for requesting the telematics vendors.
 */
class TelematicsVendorParameters extends Common
{
    /**
     * An unique ID of a telematics vendor.
     * @var integer
     */
    public $vendor_id;
    
    /**
     * If equal to 1, the vendor is integrated in the Route4Me system.
     * @var integer
     */
    public $is_integrated;
    
    /**
     * Current page in the vendors collection
     * @var integer
     */
    public $page;
    
    /**
     * Vendors number per page
     * @var integer
     */
    public $per_page;
    
    /**
     * The vendor's country
     * @var string
     */
    public $country;
    
    /**
     * Vendor's feature
     * @var string
     */
    public $feature;
    
    /**
     * A query string
     * @var string
     */
    public $search;
    
    /**
     * Comma-delimited list of the vendors IDs
     * @var string
     */
    public $vendors;
    
    /**
     * Owner of a telematicss connection.
     * @var integer
     */
    public $member_id;
    
    /**
     * Is a user real or virtual
     * @var integer
     */
    public $is_virtual;
    
    /**
     * API key
     * @var string
     */
    public $api_key;
    
    /**
     * If true, remote credentials validated.
     * @var Boolean
     */
    public $validate_remote_credentials;
    
    /**
     * API token.
     * @var string
     */
    public $api_token;

    public static function fromArray(array $params)
    {
        $thisParams = new self();

        foreach ($params as $key => $value) {
            if (property_exists($thisParams, $key)) {
                $thisParams->{$key} = $value;
            }
        }

        return $thisParams;
    }
}
