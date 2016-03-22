<?php

namespace Route4me;

use Route4me\Address;
use Route4me\Common;
use Route4me\RouteParameters;
use Route4me\OptimizationProblemParams;
use Route4me\Route;
use Route4me\Route4me;
use GuzzleHttp\Client;

class OptimizationProblem extends Common
{
    static public $apiUrl = '/api.v4/optimization_problem.php';

    public $optimization_problem_id;
    public $user_errors = array();
    public $state;
    public $parameters;
    public $sent_to_background;
    public $addresses = array();
    public $routes = array();
    public $links = array();

    function __construct()
    {
        $this->parameters = new RouteParameters;
    }

    public static function fromArray(array $params)
    {
        $problem = new OptimizationProblem;
        $problem->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $problem->user_errors = Common::getValue($params, 'user_errors', array());
        $problem->state = Common::getValue($params, 'state', array());
        $problem->sent_to_background = Common::getValue($params, 'sent_to_background', array());
        $problem->links = Common::getValue($params, 'links', array());

        if (isset($params['parameters'])) {
            $problem->parameters = RouteParameters::fromArray($params['parameters']);
        }

        if (isset($params['addresses'])) {
            $addresses = array();
            foreach ($params['addresses'] as $address) {
                $addresses[] = Address::fromArray($address);
            }
            $problem->addresses = $addresses;
        }

        if (isset($params['routes'])) {
            $routes = array();
            foreach ($params['routes'] as $route) {
                $routes[] = Route::fromArray($address);
            }
            $problem->routes = $routes;
        }

        return $problem;
    }

    public static function optimize(OptimizationProblemParams $params)
    {
        $optimize = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'POST',
            'query'  => array(
                'directions'             => $params->directions,
                'format'                 => $params->format,
                'route_path_output'      => $params->route_path_output,
                'optimized_callback_url' => $params->optimized_callback_url
            ),
            'body'   => array(
                'addresses'  => $params->getAddressesArray(),
                'parameters' => $params->getParametersArray()
            )
        ));

        return OptimizationProblem::fromArray($optimize);
    }

    public static function get($params)
    {
        $optimize = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
                'state' => isset($params['state']) ? $params['state'] : null,
                'limit' => isset($params['limit']) ? $params['limit'] : null,
                'offset' => isset($params['offset']) ? $params['offset'] : null,
                'optimization_problem_id' => isset($params['optimization_problem_id']) 
                    ? $params['optimization_problem_id'] : null,
                'wait_for_final_state' => isset($params['wait_for_final_state']) 
                    ? $params['wait_for_final_state'] : null,
            )
        ));

        if (isset($optimize['optimizations'])) {
            $problems = array();
            foreach($optimize['optimizations'] as $problem) {
                $problems[] = OptimizationProblem::fromArray($problem);
            }
            return $problems;
        } else {
            return OptimizationProblem::fromArray($optimize);
        }
    }

    public static function reoptimize($problemId)
    {
        $param = new OptimizationProblemParams;
        $param->optimization_problem_id = $problemId;
        $param->reoptimize = 1;

        return self::update($param);
    }

    public static function update($params)
    {
		$optimize = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
                'optimization_problem_id' => isset($params['optimization_problem_id']) ? $params['optimization_problem_id'] : null,
                'addresses' => isset($params['addresses']) ? $params['addresses'] : null,
                'reoptimize' => isset($params['reoptimize']) ? $params['reoptimize'] : null,
            )
        ));
		
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
}
