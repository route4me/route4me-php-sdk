<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Enum\Endpoint;
use Route4Me\Common As Common;
use Route4Me\Route4Me As Route4Me;

/**
 * Telematics vendors' list item data structure.
 */
class TelematicsVendors extends Common
{
    /**
     * Unique ID of a telematics vendor.
     * @var string
     */
    public $id;
    
    /**
     * Vendor name
     * @var string
     */
    public $name;
    
    /**
     * Vendor slug 
     * @var string
     */
    public $slug;
    
    /**
     * Vendor description
     * @var string
     */
    public $description;
    
    /**
     * URL to the telematics vendor's logo.
     * @var string
     */
    public $logo_url;
    
    /**
     * Website URL of a telematics vendor.
     * @var string
     */
    public $website_url;
    
    /**
     * API URL of a telematics vendor.
     * @var string
     */
    public $api_docs_url;
    
    /**
     * If 1, the vendor is integrated in Route4Me
     * @var string
     */
    public $is_integrated;
    
    /**
     * Vendors size.
     * <para>Accepted values:</para>
     * <para>global, regional, local. </para>
     * @var string
     */
    public $size;
    
    public static function fromArray(array $params)
    {
        $vendorsParameters = new self();

        foreach ($params as $key => $value) {
            if (property_exists($vendorsParameters, $key)) {
                $vendorsParameters->{$key} = $value;
            }
        }

        return $vendorsParameters;
    }
}
