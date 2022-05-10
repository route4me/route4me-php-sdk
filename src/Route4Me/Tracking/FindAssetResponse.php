<?php


namespace Route4Me\Tracking;

/**
 * Response from the asset finding request
 */
class FindAssetResponse extends \Route4Me\Common
{
    /**
    * Tracking number
    * @var string
    */
    public $tracking_number;
    
    /**
    * A link to a large logo
    * @var string
    */
    public $large_logo_uri;
    
    /**
    * A link to a large logo (2x)
    * @var string
    */
    public $large_logo_uri_2x;
    
    /**
    * A link to a mobile logo
    * @var string
    */
    public $mobile_logo_uri;
    
    /**
    * A link to a mobile logo (2x)
    * @var string
    */
    public $mobile_logo_uri_2x;
    
    /**
    * The asset color on a map
    * @var string
    */
    public $map_color;
    
    /**
    * An alignment of a large logo
    * @var string
    */
    public $large_logo_alignment;
    
    /**
    * An alignment of a mobile logo
    * @var string
    */
    public $mobile_logo_alignment;
    
    /**
    * Show map zoom controls
    * @var Boolean
    */
    public $show_map_zoom_controls;
    
    /**
    * Customer service phone
    * @var string
    */
    public $customer_service_phone;
    
    /**
    * If true, Covid19 warning hidden 
    * @var Boolean
    */
    public $hide_covid19_warning;
    
    /**
    * Driver phone number
    * @var string
    */
    public $driver_phone;
    
    /**
    * If true, the route started
    * @var Boolean
    */
    public $route_started;
    
    /**
    * Driver name
    * @var string
    */
    public $driver_name;
    
    /**
    * A link to a driver picture file
    * @var string
    */
    public $driver_picture;
    
    /**
    * A sub-headline of a tracking page
    * @var string
    */
    public $tracking_page_subheadline;
    
    /**
    * A first destination address
    * @var string
    */
    public $destination_address_1;
    
    /**
    * A second destination address
    * @var string
    */
    public $destination_address_2;
    
    /**
    * True if the asset was delivered
    * @var Boolean
    */
    public $delivered;
    
    /**
     * Asset status history
     * @var array
     */
    public $status_history = [];
    
    /**
     * An array of the asset locations
     * @var array
     */
    public $locations = [];
    
    /**
     * Custom data
     * @var array
     */
    public $custom_data;
    
    /**
     * An array of the asset arrival times 
     * @var array
     */
    public $arrival = [];

    public static function fromArray(array $params)
    {
        $findAssetResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($findAssetResponse, $key)) {
                $findAssetResponse->{$key} = $value;
            }
        }

        return $findAssetResponse;
    }
}