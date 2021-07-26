<?php

namespace RicardoKovalski\Locale\Mediator;

/**
 * Class Colleague
 * @package RicardoKovalski\Locale\Mediator
 */
abstract class Colleague
{
    /**
     * @var Mediator
     */
    protected $mediator;

    /**
     * @param Mediator $mediator
     */
    public function setMediator(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

    /**
     * @return $this
     */
    public function upperCase()
    {
        $this->mediator->change('upper', $this);
        return $this;
    }

    /**
     * @return $this
     */
    public function lowerCase()
    {
        $this->mediator->change('lower', $this);
        return $this;
    }
}
