<?php

namespace App\Exceptions;

use App\Exceptions\Traits\RenderToJson;
use Exception;

class InternalServerException extends Exception
{
    use RenderToJson;

    protected $message  = 'Internal Server Error';
    protected $code     = 500;
}