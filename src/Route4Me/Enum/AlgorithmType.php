<?php

namespace Route4Me\Enum;

class AlgorithmType
{
    const TSP = 1;
    const VRP = 2;
    const CVRP_TW_SD = 3;
    const CVRP_TW_MD = 4;
    const TSP_TW = 5;
    const TSP_TW_CR = 6;
    const ADVANCED_CVRP_TW = 9;
    const ALG_NONE = 100;
    const ALG_LEGACY_DISTRIBUTED = 101;
}
