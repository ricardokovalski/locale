<?php

namespace RicardoKovalski\Locale\Exceptions;

use InvalidArgumentException;

/**
 *
 */
final class FormatValueException extends InvalidArgumentException
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct('Format passed must be a string.');
    }
}
