<?php

namespace RicardoKovalski\Locale;

use RicardoKovalski\Locale\Exceptions\UnknownFormatException;
use RicardoKovalski\Locale\Exceptions\UnknownInputFormatException;
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
     * @throws UnknownInputFormatException
     */
    public static function fromString($localeAsString)
    {
        if (! is_string($localeAsString) or ! preg_match('/^([a-zA-Z]{2})([\/_])([a-zA-Z]{2})$/', $localeAsString)) {
            throw new UnknownInputFormatException;
        }

        preg_match('/[a-zA-z]{2}(.)[a-zA-z]{2}/', $localeAsString, $match);

        list($language, $country) = explode($match[1], $localeAsString);

        return new self($language, $country);
    }

    /**
     * @param $format
     * @return string
     * @throws UnknownFormatException
     */
    public function format($format)
    {
        if (! is_string($format) or ! preg_match('/^([\%][clCL])(([\\\]+)|([\/_-]))([\%][clCL])$/', $format)) {
            throw new UnknownFormatException;
        }

        $formatted = '';

        $collection = new Collection(str_split($format));

        while ($collection->key() < $collection->count()) {

            if ($collection->current() == '\\') {
                $formatted .= $collection->current();
                $collection->next();
                continue;
            }

            if ($collection->current() == '%') {
                $collection->next();
                continue;
            }

            if (preg_match('/[clCL]/', $collection->current())) {
                $formatted .= $this->convertByCharacter($collection->current());
                $collection->next();
                continue;
            }

            $formatted .= $collection->current();
            $collection->next();
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

        return $languageCodeColleague->upperCase()->getLanguageCode();
    }
}
