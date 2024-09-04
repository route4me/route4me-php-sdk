<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class OptimizationProblem extends Common
{
    /**
     * Optimization problem ID
     * @var string
     */
    public $optimization_problem_id;

    /**
     * Smart Optimization Problem ID
     * @var string
     */
    public $smart_optimization_id;

    /**
     * An array of the user errors.
     * @var string[]
     */
    public $user_errors = [];

    /**
     * An optimization problem state.<br>
     * Available values:
     * - OptimizationStateNew = 0,
     * - Initial = 1,
     * - MatrixProcessing = 2,
     * - Optimizing = 3,
     * - Optimized = 4,
     * - Error = 5,
     * - ComputingDirections = 6,
     * - OptimizationStateInQueue = 7
     * @var int
     */
    public $state;

    /**
     * An array of the optimization errors.
     * @var string[]
     */
    public $optimization_errors = [];

    /**
     * Route Parameters.
     * @var RouteParameters
     */
    public $parameters;

    /**
     * If true it means the solution was not returned (it is being computed in the background).
     * @var boolean
     */
    public $sent_to_background;

    /**
     * When the optimization problem was created.
     * @var long
     */
    public $created_timestamp;

    /**
     * An Unix Timestamp the Optimization Problem was scheduled for.
     * @var long
     */
    public $scheduled_for;

    /**
     * When the optimization completed.
     * @var long
     */
    public $optimization_completed_timestamp;

    /**
     * An array ot the Address type objects.
     * @var Address[]
     */
    public $addresses = [];

    /**
     * An array ot the DataObjectRoute type objects.<br>
     * The routes included in the optimization problem.
     * @var Route[]
     */
    public $routes = [];

    /** @var string[] $links
     * The links to the GET operations for the optimization problem.
     */
    public $links = [];

    /**
     * Optimization profile ID
     * @var string
     */
    public $optimization_profile_id;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
        $this->parameters = new RouteParameters();
    }

    public static function fromArray(array $params)
    {
        $problem = new self();
        $problem->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $problem->optimization_profile_id = Common::getValue($params, 'optimization_profile_id');
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
                $routes[] = Route::fromArray($route);
            }

            $problem->routes = $routes;
        }

        return $problem;
    }

    public static function optimize(OptimizationProblemParams $params)
    {
        $allQueryFields = ['redirect', 'directions', 'format', 'route_path_output', 'optimized_callback_url'];

        $optimize = Route4Me::makeRequst([
            'url'       => Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'POST',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => [
                'addresses'               => $params->getAddressesArray(),
                'depots'                  => $params->getDepotsArray(),
                'parameters'              => $params->getParametersArray(),
                'optimization_profile_id' => $params->optimization_profile_id
            ],
        ]);

        return self::fromArray($optimize);
    }

    public static function get($params)
    {
        $allQueryFields = ['state', 'limit', 'format', 'offset',
        'optimization_problem_id', 'wait_for_final_state','start_date','end_date', ];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
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

    public function reoptimize($params)
    {
        $param['reoptimize'] = 1;

        return self::update($params);
    }

    /*
     * Updates an existing optimization problem.<br>
     * @param array $params with items:
     * - optimization_problem_id   : query parameter. ID of an updated optimization;
     * - reoptimize                : query parameter. If true, the optimization re-optimized;
     * - addresses                 : body parameter. An array of the addresses to add;
     * - parameters                : body parameter. Modified route parameters;
     * @return Optimization problem
     */
    public static function update($params)
    {
        $allQueryFields = ['optimization_problem_id', 'reoptimize'];
        $allBodyFields = ['addresses', 'parameters'];
        $query = null;
        $body = null;

        if (is_array($params)) {
            if (isset($params['optimization_problem_id']) || isset($params['parameters'])) {
                $query = Route4Me::generateRequestParameters($allQueryFields, $params);
            }

            if ((isset($params['addresses']) && sizeof($params['addresses']) > 0)
                || (isset($params['parameters']) && sizeof($params['parameters']) > 0)
            ) {
                $body = Route4Me::generateRequestParameters($allBodyFields, $params);
            }
        } else {
            if (isset($params->optimization_problem_id) || isset($params->parameters)) {
                $query = Route4Me::generateRequestParameters($allQueryFields, $params);
            }

            if ((isset($params->addresses) && sizeof($params->addresses) > 0)
                || (isset($params->parameters) && sizeof($params->parameters) > 0)
            ) {
                $body = Route4Me::generateRequestParameters($allBodyFields, $params);
            }
        }

        $optimize = Route4Me::makeRequst([
            'url'       => Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'PUT',
            'query'     => $query,
            'body'      => $body,
        ]);

        return $optimize;
    }

    public function getOptimizationId()
    {
        return $this->optimization_problem_id;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRandomOptimizationId($offset, $limit)
    {
        $optimizations = self::get(['offset' => $offset, 'limit' => $limit]);

        $rOptimization = $optimizations[rand(0, sizeof($optimizations) - 1)];

        if (!isset($rOptimization->optimization_problem_id)) {
            if (sizeof($optimizations) > 9) {
                $this->getRandomOptimizationId($offset, $limit);
            } else {
                return null;
            }
        }

        return $rOptimization->optimization_problem_id;
    }

    public function getAddresses($opt_id)
    {
        if (null == $opt_id) {
            return null;
        }

        $params = ['optimization_problem_id' => $opt_id];

        $optimization = (array) $this->get($params);

        $addresses = $optimization['addresses'];

        return $addresses;
    }

    public function getRandomAddressFromOptimization($opt_id)
    {
        $addresses = (array) $this->getAddresses($opt_id);

        if (null == $addresses) {
            echo 'There are no addresses in this optimization!.. Try again.';

            return null;
        }

        $num = rand(0, sizeof($addresses) - 1);

        $rAddress = $addresses[$num];

        return $rAddress;
    }

    public function removeAddress($params)
    {
        $allQueryFields = ['optimization_problem_id', 'route_destination_id'];

        $response = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_V4,
            'method'    => 'DELETE',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $response;
    }

    public function removeOptimization($params)
    {
        $allQueryFields = ['redirect'];
        $allBodyFields = ['optimization_problem_ids'];

        $response = Route4Me::makeRequst([
            'url'       => Endpoint::OPTIMIZATION_PROBLEM,
            'method'    => 'DELETE',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

    public function getHybridOptimization($params)
    {
        $allQueryFields = ['target_date_string', 'timezone_offset_minutes'];

        $optimize = Route4Me::makeRequst([
            'url'       => Endpoint::HYBRID_DATE_OPTIMIZATION,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $optimize;
    }

    public function addDepotsToHybrid($params)
    {
        $allQueryFields = ['optimization_problem_id'];
        $allBodyFields = ['optimization_problem_id', 'delete_old_depots', 'new_depots'];

        $depots = Route4Me::makeRequst([
            'url'       => Endpoint::CHANGE_HYBRID_OPTIMIZATION_DEPOT,
            'method'    => 'POST',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $depots;
    }
}
