<?php

namespace Route4Me\Enum;

class OptimizationStates
{
    const NEW = 0;
    const INITIAL = 1;
    const MATRIX_PROCESSING = 2;
    const OPTIMIZING = 3;
    const OPTIMIZED = 4;
    const ERROR = 5;
    const COMPUTING_DIRECTIONS = 6;
    const IN_QUEUE = 7;
}
