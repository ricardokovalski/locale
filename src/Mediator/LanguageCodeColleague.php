<?php

namespace RicardoKovalski\Locale\Mediator;

/**
 * Class LanguageCodeColleague
 * @package RicardoKovalski\Locale\Mediator
 */
final class LanguageCodeColleague extends Colleague
{
    /**
     * @var string
     */
    protected $languageCode;

    /**
     * LanguageCodeColleague constructor.
     * @param $languageCode
     */
    public function __construct($languageCode)
    {
        $this->languageCode = $languageCode;
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param $languageCode
     * @return $this
     */
    public function resetLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;
        return $this;
    }
}
