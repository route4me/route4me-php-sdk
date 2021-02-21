<?php


namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RoutesDeleteResponse
 * @package Route4Me\V5\Routes\AddonRoutesApi
 * The response from the endpoint R4MEInfrastructureSettingsV5.Routes Delete.
 */
class RoutesDeleteResponse extends \Route4Me\Common
{
    /** If true, the route duplicated successfully.
     * @var boolean $deleted
     */
    public $deleted;

    /** If true, the route duplication process was asynchronous.
     * @var bool $async
     */
    public $async;

    /** Route ID
     * @var string $route_id
     */
    public $route_id;

    /** An array of the duplicated route IDs.
     * @var string[] $route_ids
     */
    public $route_ids;

    public static function fromArray(array $params)
    {
        $deleteResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($deleteResponse, $key)) {
                $deleteResponse->{$key} = $value;
            }
        }

        return $deleteResponse;
    }
}