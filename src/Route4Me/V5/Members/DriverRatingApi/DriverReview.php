<?php

namespace Route4Me\V5\Members;

/**
 * Class DriverReview.
 */
class DriverReview extends \Route4Me\Common
{
    /** Driver Rating ID.
     * @var string
     */
    public $rating_id;

    /** The tracking number of the route destination.
     * @var string
     */
    public $tracking_number;

    /**  review the driver got.
     * @var string
     */
    public $review;

    /** The rating assigned to the driver.
     * Available values: 1,2,3,4.
     * @var int
     */
    public $rating;

    /** When the review was created.
     * @var string
     */
    public $added_at;
}
