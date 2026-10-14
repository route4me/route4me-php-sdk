<?php

namespace Route4Me\V5;

/**
 * Class ResultResponse.
 */
class ResultResponse extends \Route4Me\Common
{
    /** Status  (true/false).
     * @var bool
     */
    public $status;

    /** Status code.
     * @var int
     */
    public $code;

    /** Exit code.
     * @var int
     */
    public $exit_code;

    /** An array of the error messages.
     * @var array
     */
    public $messages;
}
