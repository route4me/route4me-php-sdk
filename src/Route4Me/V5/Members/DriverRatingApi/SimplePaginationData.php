<?php

namespace Route4Me\V5\Members;

/**
 * Class DriverReview.
 */
class SimplePaginationData extends \Route4Me\Common
{
    /** Driver reviews number per page.
     * @var int
     */
    public $per_page;

    /** Current page number in the driver reviews collection.
     * @var int
     */
    public $current_page;

    /** Path to the driver review addon.
     * @var string
     */
    public $path;

    /** Path to the first page of the driver reviews collection.
     * @var string
     */
    public $first;

    /** Path to the previous page of the driver reviews collection.
     * @var string
     */
    public $prev;

    /** Path to the next page of the driver reviews collection.
     * @var string
     */
    public $next;
}
