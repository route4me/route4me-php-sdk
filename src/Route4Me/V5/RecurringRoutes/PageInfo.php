<?php

namespace Route4Me\V5\RecurringRoutes;

use Route4Me\Common as Common;

/**
 * The PageInfo structure
 *
 * @since 1.2.3
 *
 * @package Route4Me
 */
class PageInfo extends Common
{
    /**
     * URL of first page
     */
    public ?string $url_of_first_page = null;

    /**
     * URL of last page
     */
    public ?string $url_of_last_page = null;

    /**
     * URL of previous page
     */
    public ?string $url_of_previous_page = null;

    /**
     * URL of next page
     */
    public ?string $url_of_next_page = null;

    /**
     * Number of current page
     */
    public ?int $number_of_current_page = null;

    /**
     * Number of last page
     */
    public ?int $number_of_last_page = null;

    /**
     * Items per page
     */
    public ?int $items_per_page = null;

    /**
     * Index of first item on page
     */
    public ?int $index_of_first = null;

    /**
     * Index of last item on page
     */
    public ?int $index_of_last = null;

    /**
     * Total items
     */
    public ?int $total_items = null;

    public function __construct(array $links = null, array $meta = null)
    {
        if ($links !== null && is_array($links)) {
            $this->url_of_first_page = Common::getValue($links, 'first');
            $this->url_of_last_page = Common::getValue($links, 'last');
            $this->url_of_previous_page = Common::getValue($links, 'prev');
            $this->url_of_next_page = Common::getValue($links, 'next');
        }

        if ($meta !== null && is_array($meta)) {
            $this->number_of_current_page = Common::getValue($meta, 'current_page');
            $this->number_of_last_page = Common::getValue($meta, 'last_page');
            $this->items_per_page = Common::getValue($meta, 'per_page');
            $this->index_of_first = Common::getValue($meta, 'from');
            $this->index_of_last = Common::getValue($meta, 'to');
            $this->total_items = Common::getValue($meta, 'total');
        }
    }
}
