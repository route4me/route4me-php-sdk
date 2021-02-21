<?php


namespace Route4Me\V5\Members;

/**
 * Class DriverReview
 * @package Route4Me\V5\Members
 * Data structure of the response pagination info.
 */
class SimplePaginationData extends \Route4Me\Common
{
    /** Driver reviews number per page.
     * @var integer $per_page
     */
    public $per_page;

    /** Current page number in the driver reviews collection.
     * @var integer $current_page
     */
    public $current_page;

    /** Path to the driver review addon.
     * @var string $path
     */
    public $path;

    /** Path to the first page of the driver reviews collection.
     * @var string $first
     */
    public $first;

    /** Path to the previous page of the driver reviews collection.
     * @var string $prev
     */
    public $prev;

    /** Path to the next page of the driver reviews collection.
     * @var string $next
     */
    public $next;

    public static function fromArray(array $params)
    {
        $spData = new self();

        foreach ($params as $key => $value) {
            if (property_exists($spData, $key)) {
                $spData->{$key} = $value;
            }
        }

        return $spData;
    }
}