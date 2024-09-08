<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

class OptimizationProblemParams extends Common
{
    public $optimization_problem_id;
    public $reoptimize;
    public $addresses = [];
    public $depots = [];
    public $parameters;
    public $directions;
    public $format;
    public $route_path_output;
    public $optimized_callback_url;
    public $redirect = true;
    public $optimization_profile_id;

    public static function fromArray($params)
    {
        $param = new self();
        if (!isset($params['addresses'])) {
            throw new BadParam('addresses must be provided.');
        }

        if (!isset($params['parameters'])) {
            throw new BadParam('parameters must be provided.');
        }

        if ($params['parameters'] instanceof RouteParameters) {
            $param->setParameters($params['parameters']);
        } else {
            $param->setParameters(RouteParameters::fromArray($params['parameters']));
        }

        foreach ($params['addresses'] as $address) {
            if (!($address instanceof Address)) {
                $address = Address::fromArray($address);
            }

            $param->addAddress($address);
        }

        if (isset($params['depots'])) {
            foreach ($params['depots'] as $depot) {
                if (!($depot instanceof Address)) {
                    $depot = Address::fromArray($depot);
                }

                $param->addAddress($address);
            }
        }

        $param->directions = self::getValue($params, 'directions');
        $param->format = self::getValue($params, 'format');
        $param->route_path_output = self::getValue($params, 'route_path_output');
        $param->optimized_callback_url = self::getValue($params, 'optimized_callback_url');
        $param->optimization_problem_id = self::getValue($params, 'optimization_problem_id');
        $param->reoptimize = self::getValue($params, 'reoptimize');
        $param->redirect = filter_var(self::getValue($params, 'redirect', true), FILTER_VALIDATE_BOOLEAN);
        $param->optimization_profile_id = self::getValue($params, 'optimization_profile_id');

        return $param;
    }

    public function __construct()
    {
        $this->parameters = new RouteParameters();
    }

    public function setParameters(RouteParameters $params)
    {
        $this->parameters = $params;

        return $this;
    }

    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    public function addDepot(Address $depot)
    {
        $this->depots[] = $depot;

        return $this;
    }

    public function getAddressesArray()
    {
        $addresses = [];

        foreach ($this->addresses as $address) {
            $addresses[] = $address->toArray();
        }

        return $addresses;
    }

    public function getDepotsArray()
    {
        $depots = [];

        foreach ($this->depots as $depot) {
            $depots[] = $depot->toArray();
        }

        return $depots;
    }

    public function getParametersArray()
    {
        return $this->parameters->toArray();
    }

    public function setAddresses(array $addresses)
    {
        foreach ($addresses as $address) {
            $this->addAddress($address);
        }

        return $this;
    }

    public function setDepots(array $depots)
    {
        foreach ($depots as $depot) {
            $this->addDepot($depot);
        }

        return $this;
    }
}
