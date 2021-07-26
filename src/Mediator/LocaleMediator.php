<?php

namespace RicardoKovalski\Locale\Mediator;

/**
 * Class LocaleMediator
 * @package RicardoKovalski\Locale\Mediator
 */
final class LocaleMediator implements Mediator
{
    /**
     * @var CountryCodeColleague
     */
    protected $countryCodeColleague;
    /**
     * @var LanguageCodeColleague
     */
    protected $languageCodeColleague;

    /**
     * LocaleMediator constructor.
     * @param LanguageCodeColleague $languageCodeColleague
     * @param CountryCodeColleague $countryCodeColleague
     */
    public function __construct(
        LanguageCodeColleague $languageCodeColleague,
        CountryCodeColleague $countryCodeColleague
    )
    {
        $this->languageCodeColleague = $languageCodeColleague;
        $this->languageCodeColleague->setMediator($this);

        $this->countryCodeColleague = $countryCodeColleague;
        $this->countryCodeColleague->setMediator($this);
    }

    /**
     * @param $state
     * @param Colleague $colleague
     * @return void
     */
    public function change($state, Colleague $colleague)
    {
        if ($colleague instanceof CountryCodeColleague) {

            $countryCode = strtoupper($this->countryCodeColleague->getCountryCode());

            if ($state == 'lower') {
                $countryCode = strtolower($this->countryCodeColleague->getCountryCode());
            }

            $this->countryCodeColleague->resetCountryCode($countryCode);
        }

        if ($colleague instanceof LanguageCodeColleague) {

            $languageCode = strtoupper($this->languageCodeColleague->getLanguageCode());

            if ($state == 'lower') {
                $languageCode = strtolower($this->languageCodeColleague->getLanguageCode());
            }

            $this->languageCodeColleague->resetLanguageCode($languageCode);
        }
    }

    /**
     * @return CountryCodeColleague
     */
    public function getCountryCodeColleague()
    {
        return $this->countryCodeColleague;
    }

    /**
     * @return LanguageCodeColleague
     */
    public function getLanguageCodeColleague()
    {
        return $this->languageCodeColleague;
    }
}
