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
}
