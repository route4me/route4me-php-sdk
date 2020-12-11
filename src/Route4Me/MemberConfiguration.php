<?php

namespace Route4Me;

/*
 * The member's configuration data structure
 */

use Route4Me\Enum\Endpoint;
use Route4Me\Exception\BadParam;
use Unirest\Exception;

class MemberConfiguration extends Common
{
    /*
     * The member ID
     */
    public $member_id;

    /*
     * The member's config key
     */
    public $config_key;

    /*
     * The member's config value
     */
    public $config_value;

    /*
     * True, if the value is hidden.
     */
    public $is_hidden_value;

    /*
     * If true, the value is showable.
     */
    public $can_unhide_value;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $memberConfiguration = new Self();

        foreach ($params as $key => $value) {
            if (property_exists($memberConfiguration, $key)) {
                $memberConfiguration->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $memberConfiguration;
    }

    /*
    * Create new member configuration key-value pair.
    * @param array $params
     *       Contains key-value pair:  'config_key': 'config_value'
     * @param string $errorText
     *        Error message text
    */
    public function CreateNewConfigurationData($params, &$errorText)
    {
        $allBodyFields = ['config_key', 'config_value'];

        $response = null;

        try {
            $response = Route4Me::makeRequst([
                'url' => Endpoint::CONFIGURATION_SETTINGS,
                'method' => 'POST',
                'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            ]);
        } catch (Exception $ex) {
            $errorText = $ex->getMessage();
        } finally {
            return $response;
        }
    }

    /*
     * Update the value of the specified key.
     * @param array $params
     *       Contains key-value pair:  'config_key': 'config_value'.
     * @param string $errorText
     *        Error message text
     */
    public function UpdateConfigurationData($params, &$errorText)
    {
        $allBodyFields = ['config_key', 'config_value'];

        $response = null;

        try {
            $response = Route4Me::makeRequst([
                'url' => Endpoint::CONFIGURATION_SETTINGS,
                'method' => 'PUT',
                'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
            ]);
        } catch (Exception $ex) {
            $errorText = $ex->getMessage();
        } finally {
            return $response;
        }
    }

    /*
     * Removes specified member configuration key.
     * @param array $params
     *       Contains key-value pair:  'config_key': 'config_value'.
     * @param string $errorText
     *        Error message text
     */
    public function RemoveConfigurationData($params, &$errorText)
    {
        if (!isset($params['config_key'])) {
            $errorText = 'The parameter config_key is not specified';
            return null;
        }

        $response = null;

        try {
            $response = Route4Me::makeRequst([
                'url' => Endpoint::CONFIGURATION_SETTINGS,
                'method' => 'DELETE',
                'body' => [
                    'config_key' => isset($params['config_key']) ? $params['config_key'] : null
                ],
            ]);
        } catch (Exception $ex) {
            $errorText = $ex->getMessage();
        } finally {
            return $response;
        }
    }

    /*
     * Retrieves configuration data from a member account.
     * param array $params
     *       If specified, it contains the key 'config_key' and retrieved only corresponding configuration data,
     *       if not, all member configuration data retrieved.
     */
    public function GetConfigurationData($params=null)
    {
        $allQueryFields = ['config_key'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::CONFIGURATION_SETTINGS,
            'method' => 'GET',
            'query' => [
                'config_key' => isset($params['config_key']) ? $params['config_key'] : null
            ],
        ]);

        return $response;
    }
}