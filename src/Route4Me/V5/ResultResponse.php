<?php


namespace Route4Me\V5;

/**
 * Class ResultResponse
 * @package Route4Me\V5
 * Response data structure. As default in the failure case,
 * sometimes - in the success case too.
 */
class ResultResponse extends \Route4Me\Common
{
    /** Status  (true/false)
     * @var boolean $status
     */
    public $status;

    /** Status code
     * @var integer $code
     */
    public $code;

    /** Exit code
     * @var integer $exit_code
     */
    public $exit_code;

    /** An array of the error messages.
     * @var Array $messages
     */
    public $messages;

    public static function fromArray(array $params)
    {
        $resultResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($resultResponse, $key)) {
                $resultResponse->{$key} = $value;
            }
        }

        return $resultResponse;
    }

}