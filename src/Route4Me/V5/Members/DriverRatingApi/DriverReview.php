<?php

namespace Route4Me\V5\Members;

/**
 * Class DriverReview
 * @package Route4Me\V5\Members
 * The data structure of a retrieved driver review.
 */
class DriverReview extends \Route4Me\Common
{
    /** Driver Rating ID
     * @var string $rating_id
     */
    public $rating_id;

    /** The tracking number of the route destination
     * @var string $tracking_number
     */
    public $tracking_number;

    /**  review the driver got
     * @var string $review
     */
    public $review;

    /** The rating assigned to the driver.
     * Available values: 1,2,3,4
     * @var integer $rating
     */
    public $rating;

    /** When the review was created.
     * @var string $added_at
     */
    public $added_at;
}
