<?php


namespace Route4Me\Tracking;

/**
 * Response from the asset finding request
 */
class FindAssetResponse extends \Route4Me\Common
{
    /**
    * Tracking number
    * @var type string
    */
    public $tracking_number;
    
    /**
    * A link to a large logo
    * @var type string
    */
    public $large_logo_uri;
    
    /**
    * A link to a large logo (2x)
    * @var type string
    */
    public $large_logo_uri_2x;
    
    /**
    * A link to a mobile logo
    * @var type string
    */
    public $mobile_logo_uri;
    
    /**
    * A link to a mobile logo (2x)
    * @var type string
    */
    public $mobile_logo_uri_2x;
    
    /**
    * The asset color on a map
    * @var type string
    */
    public $map_color;
    
    /**
    * An alignment of a large logo
    * @var type string
    */
    public $large_logo_alignment;
    
    /**
    * An alignment of a mobile logo
    * @var type string
    */
    public $mobile_logo_alignment;
    
    /**
    * Show map zoom controls
    * @var type Boolean
    */
    public $show_map_zoom_controls;
    
    /**
    * Customer service phone
    * @var type string
    */
    public $customer_service_phone;
    
    /**
    * If true, Covid19 warning hidden
    * @var type
    */
    public $hide_covid19_warning;
    
    /**
    * Driver phone number
    * @var type string
    */
    public $driver_phone;
    
    /**
    * If true, the route started
    * @var type Boolean
    */
    public $route_started;
    
    /**
    * Driver name
    * @var type string
    */
    public $driver_name;
    
    /**
    * A link to a driver picture file
    * @var type string
    */
    public $driver_picture;
    
    /**
    * A sub-headline of a tracking page
    * @var type string
    */
    public $tracking_page_subheadline;
    
    /**
    * A first destination address
    * @var type string
    */
    public $destination_address_1;
    
    /**
    * A second destination address
    * @var type string
    */
    public $destination_address_2;
    
    /**
    * True if the asset was delivered
    * @var type Boolean
    */
    public $delivered;
    
    /**
     * Asset status history
     * @var type array
     */
    public $status_history = [];
    
    /**
     * An array of the asset locations
     * @var type array
     */
    public $locations = [];
    
    /**
     * Custom data
     * @var type array
     */
    public $custom_data;
    
    /**
     * An array of the asset arrival times
     * @var type array
     */
    public $arrival = [];
}
