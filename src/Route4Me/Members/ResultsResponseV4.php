<?php

namespace Route4Me\Members;

/**
 * Class ResultsResponseV4
 * @package Route4Me\Members
 * The response to the process of retrieving the users' list.
 */
class ResultsResponseV4 extends \Route4Me\Common
{
    /** @var MemberResponseV4[] $results */
    public $results;

    /** @var int $total */
    public $total;

    public static function fromArray(array $params)
    {
        $resultsResponseV4 = new self();

        foreach ($params as $key => $value) {
            if (property_exists($resultsResponseV4, $key)) {
                $resultsResponseV4->{$key} = $value;
            }
        }

        return $resultsResponseV4;
    }
}