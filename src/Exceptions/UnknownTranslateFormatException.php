<?php

namespace RicardoKovalski\Locale\Exceptions;

use InvalidArgumentException;

final class UnknownTranslateFormatException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Unknown translate format.');
    }
}
