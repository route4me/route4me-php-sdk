<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Common;

/**
 * Address Book API StatusChecker structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class StatusChecker extends Common
{
    /**
     * HTTP code.
     * @example 200, 202
     */
    public ?int $code = null;

    /**
     * Requested data if request was handled synchronously.
     * @example ['status' => 1] - Successful operation
     */
    public ?array $data = null;

    /**
     * Path to the status checker if request was handled asynchronously.
     */
    public ?string $location = null;

    /**
     * Job Id to check status if request was handled asynchronously.
     */
    public ?string $x_job_id = null;

    /**
     * Job running time in seconds.
     */
    public ?string $x_r4m_async_job_running_time = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
