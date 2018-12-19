<?php
namespace Route4Me;

use Route4Me\Address;
use Route4Me\Common;
use Route4Me\RouteParameters;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\Enum\Endpoint;

class OptimizationProblem extends Common
{
    public $optimization_problem_id;
    public $user_errors = array();
    public $state;
    public $optimization_errors = array();
    public $parameters;
    public $sent_to_background;
    public $created_timestamp;
    public $scheduled_for;
    public $optimization_completed_timestamp;
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
                $routes[] = Route::fromArray($route);
            }
            
            $problem->routes = $routes;
        }

        return $problem;
    }

    public static function optimize(OptimizationProblemParams $params)
    {
        $allQueryFields = array('redirect', 'directions', 'format', 'route_path_output', 'optimized_callback_url');
        
        $optimize = Route4Me::makeRequst(array(
            'url'    => Endpoint::OPTIMIZATION_PROBLEM,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => array(
                'addresses'  => $params->getAddressesArray(),
                'parameters' => $params->getParametersArray()
            )
        ));

        return OptimizationProblem::fromArray($optimize);
    }

    public static function get($params)
    {
        $allQueryFields = array('state', 'limit', 'format', 'offset', 
        'optimization_problem_id', 'wait_for_final_state');
        
        $optimize = Route4Me::makeRequst(array(
            'url'    => Endpoint::OPTIMIZATION_PROBLEM,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        if (isset($optimize['optimizations'])) {
            $problems = array();
            
            foreach ($optimize['optimizations'] as $problem) {
                $problems[] = OptimizationProblem::fromArray($problem);
            }
            
            return $problems;
        } else {
            return OptimizationProblem::fromArray($optimize);
        }
    }

    public static function reoptimize($params)
    {
        $param = new OptimizationProblemParams;
        $param->optimization_problem_id = isset($params['optimization_problem_id']) ? $params['optimization_problem_id'] : null;
        $param->reoptimize = 1;

        return self::update((array)$param);
    }

    public static function update($params)
    {
        $allQueryFields = array('optimization_problem_id', 'reoptimize');
        $allBodyFields = array('addresses');
        
        $optimize = Route4Me::makeRequst(array(
            'url'    => Endpoint::OPTIMIZATION_PROBLEM,
            'method' => 'PUT',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'  => Route4Me::generateRequestParameters($allBodyFields, $params)
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
    
    public function getRandomOptimizationId($offset, $limit)
    {
        $optimizations = self::get(array('offset' => $offset, 'limit' => $limit));
            
        $rOptimization = $optimizations[rand(0,sizeof($optimizations)-1)];
        
        if(!isset($rOptimization->optimization_problem_id)) {
            if (sizeof($optimizations)>9) {
                $this->getRandomOptimizationId($offset, $limit);
            } else {
                return null;
            }
        }
                
        return $rOptimization->optimization_problem_id;
    }
    
    public function getAddresses($opt_id)
    {
        if ($opt_id==null) {
            return null;
        }
        
        $params = array("optimization_problem_id" => $opt_id );
        
        $optimization = (array)$this->get($params);
        
        $addresses = $optimization["addresses"];
        
        return $addresses;
    }
    
    public function getRandomAddressFromOptimization($opt_id)
    {
        $addresses = (array)$this->getAddresses($opt_id);
        
        if ($addresses==null) {
            echo "There are no addresses in this optimization!.. Try again.";
            return null;
        }
        
        $num = rand(0, sizeof($addresses)-1);
        
        $rAddress = $addresses[$num];
        
        return $rAddress;
    }
    
    public function removeAddress($params)
    {
        $allQueryFields = array('optimization_problem_id', 'route_destination_id');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'DELETE',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));
        
        return $response;
    }
    
    public function removeOptimization($params)
    {
        $allQueryFields = array('redirect');
        $allBodyFields = array('optimization_problem_ids');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::OPTIMIZATION_PROBLEM,
            'method' => 'DELETE',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
    
    public function getHybridOptimization($params)
    {
        $allQueryFields = array('target_date_string', 'timezone_offset_minutes');
        
        $optimize = Route4Me::makeRequst(array(
            'url'    => Endpoint::HYBRID_DATE_OPTIMIZATION,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $optimize;
    }
    
    Public function addDepotsToHybrid($params)
    {
        $allQueryFields = array('optimization_problem_id');
        $allBodyFields = array('optimization_problem_id', 'delete_old_depots', 'new_depots');
        
        $depots = Route4Me::makeRequst(array( 
            'url'    => Endpoint::CHANGE_HYBRID_OPTIMIZATION_DEPOT,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $depots;
    }
}
