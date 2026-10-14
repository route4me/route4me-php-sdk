<?php

namespace Route4Me\V5\Members;

/**
 * Class DriverReviewsResponse.
 */
class DriverReviewsResponse extends \Route4Me\Common
{
    /** An array of the driver reviews.
     * @var DriverReview[]
     */
    public $data = [];

    /** The response pagination info.
     * @var SimplePaginationData
     */
    public $simple_pagination = [];

    /** Statistics by driver rating.
     * @var TypeQuantity[]
     */
    public $total = [];
}
