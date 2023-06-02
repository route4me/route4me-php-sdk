<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class TelematicsVendor extends Common
{
    public $id; // Telematics Vendor id
    public $name; // Vendor name
    public $slug; // Vendor slug
    public $description; // Vendor description
    public $logo_url; // Vendor's logo URL
    public $website_url; // Vendor's website URL
    public $api_docs_url; // API documentation URL
    public $is_integrated; // If 1, the vendor is integrated in Route4Me
    public $size; // Vendor size
    public $page; // starting page
    public $per_page; // Vendors per page in a response
    public $countries = []; // Country Alpha 2 code
    public $features = []; // Vendor's feature
    public $search; // Searched text
    public $vendors; // Comma-delimited list of the vendors IDs.

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

    /*
    public static function GetTelematicsVendor($params) {
        Route4Me::setBaseUrl(Endpoint::TELEMATICS_VENDORS);

        $allQueryFields = array('vendor_id', 'is_integrated', 'page', 'per_page', 'country', 'feature', 'search', 'vendors');

        $query = Route4Me::generateRequestParameters($allQueryFields, $params);

        $vendors = Route4Me::makeRequst(array(
            'url'    => "",
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $vendors;
    }
    */
}
