<?php

namespace RicardoKovalski\Locale;

use RicardoKovalski\Locale\Exceptions\FormatValueException;
use RicardoKovalski\Locale\Exceptions\UnknownFormatException;
use RicardoKovalski\Locale\Mediator\CountryCodeColleague;
use RicardoKovalski\Locale\Mediator\LanguageCodeColleague;
use RicardoKovalski\Locale\Mediator\LocaleMediator;

/**
 * Class Locale
 * @package RicardoKovalski\Locale
 */
final class Locale
{
    /**
     * @var string
     */
    private $languageCode;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var LocaleMediator
     */
    private $mediator;

    /**
     * Locale constructor.
     * @param $languageCode
     * @param $countryCode
     */
    private function __construct($languageCode, $countryCode)
    {
        $this->languageCode = strtolower($languageCode);
        $this->countryCode = strtoupper($countryCode);
        $this->mediator = new LocaleMediator(
            new LanguageCodeColleague($this->languageCode),
            new CountryCodeColleague($this->countryCode)
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s_%s', $this->languageCode, $this->countryCode);
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param Locale $object
     * @return bool
     */
    public function isSameValueAs(Locale $object)
    {
        return $this->getLanguageCode() == $object->getLanguageCode() &&
            $this->getCountryCode() == $object->getCountryCode();
    }

    /**
     * @param $localeAsString
     * @return Locale
     */
    public static function fromString($localeAsString)
    {
        if (! preg_match('/^([a-zA-Z]{2})([\_\/])([a-zA-Z]{2})$/', $localeAsString)) {
            throw new UnknownFormatException;
        }

        if (! preg_match('/[a-zA-z]{2}(.)[a-zA-z]{2}/', $localeAsString, $match)) {
            throw new UnknownFormatException;
        }

        list($language, $country) = explode($match[1], $localeAsString);
        return new self($language, $country);
    }

    /**
     * @param $format
     * @return string
     */
    public function format($format)
    {
        if (! is_string($format)) {
            throw new FormatValueException;
        }

        $translateNext = false;
        $escNext = false;
        $formatted = '';

        /*$collection = new Collection(str_split($format));

        echo "<pre>";
        var_dump($collection);
        die("<-----");*/

        foreach (str_split($format) as $char) {
            if ($escNext) {
                $formatted .= $char;
                $escNext = false;
                continue;
            }

            if ($translateNext) {
                $formatted .= $this->convertByCharacter($char);
                $translateNext = false;
                continue;
            }

            if ('\\' == $char) {
                $escNext = true;
                continue;
            }

            if ('%' == $char) {
                $translateNext = true;
                continue;
            }

            $formatted .= $char;
        }

        return $formatted;
    }

    /**
     * @param $char
     * @return string
     */
    private function convertByCharacter($char)
    {
        $countryCodeColleague = $this->mediator->getCountryCodeColleague();

        if ('c' == $char) {
            return $countryCodeColleague->lowerCase()->getCountryCode();
        }

        if ('C' == $char) {
            return $countryCodeColleague->upperCase()->getCountryCode();
        }

        $languageCodeColleague = $this->mediator->getLanguageCodeColleague();

        if ('l' == $char) {
            return $languageCodeColleague->lowerCase()->getLanguageCode();
        }

        if ('L' == $char) {
            return $languageCodeColleague->upperCase()->getLanguageCode();
        }

        throw new UnknownFormatException;
    }
}
