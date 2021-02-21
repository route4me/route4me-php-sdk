<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RouteDataTableConfigResponse
 * @package Route4Me\V5\Routes
 * Route datatable configuration
 */
class RouteDataTableConfigResponse extends \Route4Me\Common
{
    /** API Capabilities
     * @var ApiCapabilities $api_capabilities
     */
    public $api_capabilities = [];

    /** API Preferences
     * @var ApiPreferences $api_preferences
     */
    public $api_preferences = [];

    public static function fromArray(array $params)
    {
        $configResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($configResponse, $key)) {
                $configResponse->{$key} = $value;
            }
        }

        return $configResponse;
    }
}
