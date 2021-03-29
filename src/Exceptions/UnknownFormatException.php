<?php

namespace RicardoKovalski\Locale\Exceptions;

use InvalidArgumentException;

final class UnknownFormatException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Unknown format.');
    }
}
