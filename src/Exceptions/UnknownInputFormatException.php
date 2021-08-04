<?php

namespace RicardoKovalski\Locale\Exceptions;

use InvalidArgumentException;

final class UnknownInputFormatException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Unknown input format.');
    }
}
