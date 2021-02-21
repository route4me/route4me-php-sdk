<?php


namespace Route4Me\V5\Members;

/**
 * Class DriverReviewsResponse
 * @package Route4Me\V5\Members
 * The data structure of a retrieved driver reviews list.
 */
class DriverReviewsResponse extends \Route4Me\Common
{
    /** An array of the driver reviews.
     * @var DriverReview[] $data
     */
    public $data = [];

    /** The response pagination info.
     * @var SimplePaginationData $simple_pagination
     */
    public $simple_pagination = [];

    /** Statistics by driver rating.
     * @var TypeQuantity[] $total
     */
    public $total = [];
}