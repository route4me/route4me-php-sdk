<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Enum\Endpoint;
use Route4Me\Common As Common;
use Route4Me\Route4Me As Route4Me;

/**
 * Telematics vendor's data structure.
 */
class TelematicsVendor extends Common
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
    
    /**
     * An array of the countries, the vendor is operating.
     * @var array
     */
    public $countries = [];
    
    /**
     * An array the vendor features
     * @var array
     */
    public $features = [];
    
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

    /**
     * Get vendor(s), search for vendors, compare vendors.
     * @param TelematicsVendorParameters $params
     * @return TelematicsVendorResponse or TelematicsVendorsResponse.
     */
    public static function GetTelematicsVendors($params)
    {
        Route4Me::setBaseUrl(Endpoint::TELEMATICS_VENDORS);

        $allQueryFields = ['vendor_id', 'is_integrated', 'page', 'per_page', 'country', 'feature', 'search', 'vendors'];

        $vendors = Route4Me::makeRequst([
            'url'       => '',
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $vendors;
    }

    /**
     * Returns a random telematics vendor (for tests).
     * @param $offset integer
     * @param $limit integer
     * @return object vendor
     */
    public static function GetRandomVendorID($offset, $limit)
    {
        $allVendors = self::GetTelematicsVendors(null);
        $vendorsNumber = sizeof($allVendors['vendors']);

        if ($vendorsNumber < $limit) {
            if ($vendorsNumber > $offset) {
                $limit = $vendorsNumber;
            } else {
                if ($vendorsNumber == $offset) {
                    return $allVendors['vendors'][$offset]->{'vendor_id'};
                } else {
                    echo 'The vendors numbers are less than offset';

                    return null;
                }
            }
        }

        $randNumber = rand($offset, $limit);

        return $allVendors['vendors'][$randNumber]['id'];
    }

    /**
     * Register telematics member
     * @param TelematicsVendorParameters $params contains:
     * @param integer member_id : member ID
     * @param string api_key    : API key
     * @return array from a TelematicsRegisterMemberResponse type object
     * @throws \Route4Me\Exception\ApiError
     */
    public static function RegisterTelematicsMember($params)
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $allQueryFields = ['member_id', 'api_key'];

        $vendors = Route4Me::makeRequst([
            'url'       => Endpoint::TELEMATICS_REGISTER_MEMBER,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $vendors;
    }

    /**
     * Get a vendor by ID
     * @param string $vendorId
     * @return TelematicsVendor type object
     */
    public static function getVendorById($vendorId)
    {
        if ($vendorId!=null) {
            return self::GetTelematicsVendors($vendorId);
        } else {
            return null;
        }
    }

}
