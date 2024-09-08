<?php

namespace Route4Me\V5\OptimizationProfiles;

use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\V5\Enum\Endpoint;
use Route4Me\V5\OptimizationProfiles\ResponseOptimizationProfiles;
use Route4Me\V5\OptimizationProfiles\ResponseSaveOptimizationProfile;

/**
 * The Optimization profiles API
 *
 * @since 1.4.0
 *
 * @package Route4Me
 */
class OptimizationProfiles extends Common
{
    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    /**
     * Get list of optimization profiles belong to the Route4Me account.
     *
     * @since 1.4.0
     *
     * @return ResponseOptimizationProfiles
      * @throws Exception\ApiError
    */
    public function getAll() : ResponseOptimizationProfiles
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::OPTIMIZATION_PROFILES_LIST,
            'method' => 'GET'
        ]);

        if (is_array($result) && isset($result['items'])) {
            return new ResponseOptimizationProfiles($result);
        }
        throw new ApiError('Can not convert result to ResponseOptimizationProfiles object.');
    }

    /**
     * Save a OptimizationProfiles.
     *
     * @since 1.4.0
     *
     * @param  array    $params
     *   Items[]  items               - Array of items to save
     *     string  guid               - GUID
     *     string  id                 - ID
     *     Part[]  parts              - aray of Parts
     * @return ResponseSaveOptimizationProfile
     * @throws Exception\ApiError
     */
    public function save(array $params) : ResponseSaveOptimizationProfile
    {
        $allBodyFields = ['items'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::OPTIMIZATION_PROFILES_SAVE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]);

        if (is_array($result) && isset($result['items'])) {
            return new ResponseSaveOptimizationProfile($result);
        }
        throw new ApiError('Can not convert result to ResponseSaveOptimizationProfile object.');
    }

    /**
     * Delete a OptimizationProfiles.
     *
     * @since 1.4.0
     *
     * @param  array    $params
     *   Items[]  items               - Array of items to delete
     *     string  id                 - ID
     * @return ResponseSaveOptimizationProfile
     * @throws Exception\ApiError
     */
    public function delete(array $params) : ResponseSaveOptimizationProfile
    {
        $allBodyFields = ['items'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::OPTIMIZATION_PROFILES_DELETE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]);

        if (is_array($result) && isset($result['items'])) {
            return new ResponseSaveOptimizationProfile($result);
        }
        throw new ApiError('Can not convert result to ResponseSaveOptimizationProfile object.');
    }
}
