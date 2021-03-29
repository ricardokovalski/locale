<?php

namespace RicardoKovalski\Locale;

final class Locale
{
    private $languageCode;

    private $countryCode;

    private function __construct($languageCode, $countryCode)
    {
        $this->languageCode = strtolower($languageCode);
        $this->countryCode = strtoupper($countryCode);
    }

    public function __toString()
    {
        return sprintf('%s_%s', $this->languageCode, $this->countryCode);
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    public function isSameValueAs(Locale $other)
    {
        return $this->isLanguageCodeSameValueAs($other) && $this->isCountryCodeSameValueAs($other);
    }

    public function isLanguageCodeSameValueAs(Locale $other)
    {
        return $this->getLanguageCode() == $other->getLanguageCode();
    }

    public function isCountryCodeSameValueAs(Locale $other)
    {
        return $this->getCountryCode() == $other->getCountryCode();
    }

    public static function fromString($localeAsString)
    {
        list($prefix, $suffix) = explode('_', $localeAsString);
        return new self($prefix, $suffix);
    }

    public static function fromCountrySlashLanguage($countrySlashLanguage)
    {
        list($prefix, $suffix) = explode('/', $countrySlashLanguage);
        return new self($prefix, $suffix);
    }

    public function format($format)
    {
        if (! is_string($format)) {
            throw new FormatValueException;
        }

        $translateNext = false;
        $escNext = false;
        $formatted = '';

        foreach (str_split($format) as $char) {
            if ($escNext) {
                $formatted .= $char;
                $escNext = false;
                continue;
            }

            if ($translateNext) {

                $translated = $this->convertTranslated($char);

                $formatted .= $translated;
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
    private function convertTranslated($char)
    {
        if ('c' == $char) {
            return strtolower($this->getCountryCode());
        }

        if ('C' == $char) {
            return strtoupper($this->getCountryCode());
        }

        if ('l' == $char) {
            return strtolower($this->getLanguageCode());
        }

        if ('L' == $char) {
            return strtoupper($this->getLanguageCode());
        }

        throw new UnknownFormatException;
    }
}
