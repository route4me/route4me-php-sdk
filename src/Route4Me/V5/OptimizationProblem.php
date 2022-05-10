<?php

namespace Route4Me\V5;

use Route4Me\V5\OptimizationProblemParams;
use Route4Me\V5\Addresses\Address as Address;
use Route4Me\Common as Common;
use Route4Me\V5\Routes\AddonRoutesApi\Route as Route;
use Route4Me\V5\Enum\Endpoint as Endpoint;
use Route4Me\Enum\Endpoint as EndpointV4;
use Route4Me\Route4Me as Route4me;
use Route4Me\V5\Routes\RouteParameters as RouteParameters;

class OptimizationProblem extends Common
{
    /** @var int $state
     * An optimization problem state.
     * Available values:
     * OptimizationStateNew = 0,
     * Initial = 1,
     * MatrixProcessing = 2,
     * Optimizing = 3,
     * Optimized = 4,
     * Error = 5,
     * ComputingDirections = 6,
     * OptimizationStateInQueue = 7
     */
    public $state;

    /** @var string[] $user_errors
     * An array of the user errors.
     */
    public $user_errors;

    /** @var string[] $optimization_errors
     * An array of the optimization errors.
     */
    public $optimization_errors;

    /** @var boolean $sent_to_background
     * If true it means the solution was not returned (it is being computed in the background).
     */
    public $sent_to_background;

    /** @var integer $scheduled_for
     * An Unix Timestamp the Optimization Problem was scheduled for.
     */
    public $scheduled_for;

    /** @var Route[] $routes
     * An array ot the DataObjectRoute type objects.
     * The routes included in the optimization problem.
     */
    public $routes;

    /** @var integer $total_addresses
     * Total number of the addresses in the optimization problem.
     */
    public $total_addresses;

    public function __construct()
    {
        /**
         * TO DO: Replace endpoint after finishing Optimization Wrapper in API 5
         */
        \Route4Me\Route4Me::setBaseUrl(EndpointV4::BASE_URL);
        $this->parameters = new RouteParameters();
    }

    public static function fromArray(array $params)
    {
        $problem = new self();
        $routeClass = new Route();


        $problem->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $problem->user_errors = Common::getValue($params, 'user_errors', []);
        $problem->state = Common::getValue($params, 'state', []);
        $problem->sent_to_background = Common::getValue($params, 'sent_to_background', []);
        $problem->links = Common::getValue($params, 'links', []);

        if (isset($params['parameters'])) {
            $problem->parameters = RouteParameters::fromArray($params['parameters']);
        }

        if (isset($params['addresses'])) {
            $addresses = [];

            foreach ($params['addresses'] as $address) {
                $addresses[] = Address::fromArray($address);
            }

            $problem->addresses = $addresses;
        }

        if (isset($params['routes'])) {
            $routes = [];

            foreach ($params['routes'] as $route) {
                $routes[] = $routeClass::fromArray($route);
            }

            $problem->routes = $routes;
        }

        return $problem;
    }

    public static function optimize(OptimizationProblemParams $params)
    {
        $allQueryFields = ['redirect', 'directions', 'format', 'route_path_output', 'optimized_callback_url'];

        $optimize = Route4Me::makeRequst([
            'url'       => \Route4Me\Enum\Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'POST',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => [
                'addresses'     => $params->getAddressesArray(),
                'depots'        => $params->getDepotsArray(),
                'parameters'    => $params->getParametersArray(),
            ],
        ]);

        return self::fromArray($optimize);
    }

    public static function get($params)
    {
        $allQueryFields = ['state', 'limit', 'format', 'offset',
            'optimization_problem_id', 'wait_for_final_state','start_date','end_date', ];

        $result = Route4Me::makeRequst([
            'url'       => \Route4Me\Enum\Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'GET',
            'query'     => \Route4Me\Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        if (isset($result['optimizations'])) {
            $problems = [];

            foreach ($result['optimizations'] as $problem) {
                $problems[] = self::fromArray($problem);
            }

            return $problems;
        } else {
            return self::fromArray($result);
        }
    }

    public function removeOptimization($params)
    {
        $allQueryFields = ['redirect'];
        $allBodyFields = ['optimization_problem_ids'];

        $response = Route4Me::makeRequst([
            'url'       => \Route4Me\Enum\Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'DELETE',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

}