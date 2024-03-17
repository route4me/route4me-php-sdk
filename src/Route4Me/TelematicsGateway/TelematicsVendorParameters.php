<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Common as Common;

/**
 * Parameters for requesting the telematics vendors.
 */
class TelematicsVendorParameters extends Common
{
    /**
     * An unique ID of a telematics vendor.
     * @var type integer
     */
    public $vendor_id;
    
    /**
     * If equal to 1, the vendor is integrated in the Route4Me system.
     * @var type integer
     */
    public $is_integrated;
    
    /**
     * Current page in the vendors collection
     * @var type integer
     */
    public $page;
    
    /**
     * Vendors number per page
     * @var type integer
     */
    public $per_page;
    
    /**
     * The vendor's country
     * @var type string
     */
    public $country;
    
    /**
     * Vendor's feature
     * @var type string
     */
    public $feature;
    
    /**
     * A query string
     * @var type string
     */
    public $search;
    
    /**
     * Comma-delimited list of the vendors IDs
     * @var type string
     */
    public $vendors;
    
    /**
     * Owner of a telematicss connection.
     * @var type integer
     */
    public $member_id;
    
    /**
     * Is a user real or virtual
     * @var type integer
     */
    public $is_virtual;
    
    /**
     * API key
     * @var type string
     */
    public $api_key;
    
    /**
     * If true, remote credentials validated.
     * @var type Boolean
     */
    public $validate_remote_credentials;
    
    /**
     * API token.
     * @var type string
     */
    public $api_token;
}
