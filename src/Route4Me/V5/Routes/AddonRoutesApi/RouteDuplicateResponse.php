<?php


namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RouteDuplicateResponse
 * @package Route4Me\V5\Routes\AddonRoutesApi
 * The response from the route delete process.
 */
class RouteDuplicateResponse extends \Route4Me\Common
{
    /** If true, the route duplicated successfully.
     * @var boolean $status
     */
    public $status;

    /** If true, the route duplication process was asynchronous.
     * @var boolean $async
     */
    public $async;

    /** An array of the duplicated route IDs.
     * @var string[] $route_ids
     */
    public $route_ids = [];

    public static function fromArray(array $params)
    {
        $duplicateResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($duplicateResponse, $key)) {
                $duplicateResponse->{$key} = $value;
            }
        }

        return $duplicateResponse;
    }
}