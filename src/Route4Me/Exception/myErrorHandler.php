<?php

namespace Route4Me\Exception;

class myErrorHandler extends \Exception
{
    public function proc_error($errno, $errstr, $errfile, $errline)
    {
        echo "Error No: $errno,  line: $errline --- ".$errstr.'<br>';
    }
}
