<?php

namespace RicardoKovalski\Locale\Mediator;

/**
 * Interface Mediator
 * @package RicardoKovalski\Locale\Mediator
 */
interface Mediator
{
    /**
     * @param $state
     * @param Colleague $colleague
     * @return mixed
     */
    public function change($state, Colleague $colleague);
}
