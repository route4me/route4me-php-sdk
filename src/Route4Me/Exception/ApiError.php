<?php

namespace Route4Me\Exception;

class ApiError extends \Exception
{
    protected string $source = '';

    public function __construct(string $message = '', int $code = 0, string $source = '', \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->source = $source;
    }

    final public function getSource() : string
    {
        return $this->source;
    }
}
