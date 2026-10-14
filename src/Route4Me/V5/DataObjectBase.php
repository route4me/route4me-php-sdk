<?php

namespace Route4Me\V5;

class DataObjectBase extends \Route4Me\Common
{
    /** @var string
     * Optimization problem ID
     */
    public $optimization_problem_id;

    /** @var string
     * Smart Optimization Problem ID
     */
    public $smart_optimization_id;

    /** @var long
     * When the optimization problem was created.
     */
    public $created_timestamp;

    /** @var RouteParameters
     * Route Parameters.
     */
    public $parameters = [];

    /** @var Address[]
     * An array ot the Address type objects.
     */
    public $addresses = [];

    /** @var string[]
     * The links to the GET operations for the optimization problem.
     */
    public $links = [];
}
