<?php


namespace Route4Me\V5;


class DataObjectBase extends \Route4Me\Common
{
    /** @var string $optimization_problem_id
     * Optimization problem ID
     */
    public $optimization_problem_id;

    /** @var string $smart_optimization_id
     * Smart Optimization Problem ID
     */
    public $smart_optimization_id;

    /** @var long $created_timestamp
     * When the optimization problem was created.
     */
    public $created_timestamp;

    /** @var RouteParameters $parameters
     * Route Parameters.
     */
    public $parameters = [];

    /** @var Address[] $addresses
     * An array ot the Address type objects.
     */
    public $addresses = [];

    /** @var string[] $links
     * The links to the GET operations for the optimization problem.
     */
    public $links = [];
}