<?php

namespace RicardoKovalski\Locale\Mediator;

/**
 * Class CountryCodeColleague
 * @package RicardoKovalski\Locale\Mediator
 */
final class CountryCodeColleague extends Colleague
{
    /**
     * @var string
     */
    protected $countryCode;

    /**
     * CountryCodeColleague constructor.
     * @param $countryCode
     */
    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param $countryCode
     * @return $this
     */
    public function resetCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}
