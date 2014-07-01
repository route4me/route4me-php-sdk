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
    static public $apiUrl = 'http://route4me.com/api.v4/optimization_problem.php';

    private $optimization_problem_id;
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

    public static function optimize($param)
    {
        $params = array(
            'addresses' => $param->getAddressesArray(),
            'parameters' => $param->getParametersArray()
        );

        $query = array(
            'directions'             => $param->directions,
            'format'                 => $param->format,
            'route_path_output'      => $param->route_path_output,
            'optimized_callback_url' => $param->optimized_callback_url,
            'api_key'                => Route4me::getApiKey()
        );

        try {
            $client = new Client;
            $response = $client->post(self::$apiUrl, array(
                'query'   => array_filter($query),
                'body'    => json_encode($params),
                'headers' => array(
                    'User-Agent' => 'Route4me php sdk'
                )
            ));

            return OptimizationProblem::fromArray($response->json());
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return null;
        }
    }

    public static function reoptimize($problemId)
    {
        $param = new OptimizationProblemParams;
        $param->optimization_problem_id = $problemId;
        $param->reoptimize = 1;

        return self::update($param);
    }

    public static function update($param)
    {
        $params = array(
            'addresses' => $param->getAddressesArray(),
            'parameters' => $param->getParametersArray()
        );

        $query = array(
            'directions'              => $param->directions,
            'format'                  => $param->format,
            'route_path_output'       => $param->route_path_output,
            'optimized_callback_url'  => $param->optimized_callback_url,
            'reoptimize'              => $param->reoptimize,
            'optimization_problem_id' => $param->optimization_problem_id,
            'api_key'                 => Route4me::getApiKey()
        );

        try {
            $client = new Client;
            $response = $client->put(self::$apiUrl, array(
                'query'   => array_filter($query),
                'body'    => json_encode($params),
                'headers' => array(
                    'User-Agent' => 'Route4me php sdk'
                )
            ));

            return (bool)$response->json();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return null;
        }
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
