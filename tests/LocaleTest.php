<?php

namespace RicardoKovalski\Locale\Tests;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\Locale\Exceptions\UnknownFormatException;
use RicardoKovalski\Locale\Exceptions\UnknownInputFormatException;
use RicardoKovalski\Locale\Locale;

class LocaleTest extends TestCase
{
    public function testExpectedExceptionUnknownFormatExceptionByFromString()
    {
        $this->expectException(UnknownInputFormatException::class);
        Locale::fromString('en:US');
    }

    public function testExpectedExceptionUnknownFormatExceptionByMethodFormat()
    {
        $locale = Locale::fromString('en_US');
        $this->expectException(UnknownFormatException::class);
        $locale->format('%c:%l');
    }

    public function testExpectedExceptionUnknownFormatExceptionWhenFormatCharInvalid()
    {
        $locale = Locale::fromString('en_US');
        $this->expectException(UnknownFormatException::class);
        $locale->format('%g/%l');
    }

    public function testFromString()
    {
        $locale = Locale::fromString('en_US');

        $this->assertSame('US', $locale->getCountryCode());
        $this->assertSame('en', $locale->getLanguageCode());
    }

    public function testToString()
    {
        $locale = Locale::fromString('eN_uS');

        $this->assertSame('en_US', (string) $locale);
    }

    public function testIsSameValueAs()
    {
        $locale = Locale::fromString('eN_uS');
        $other = Locale::fromString('EN_Us');
        $yetAnother = Locale::fromString('Es_Us');

        $this->assertTrue($locale->isSameValueAs($other));
        $this->assertFalse($locale->isSameValueAs($yetAnother));
    }

    /**
     * @dataProvider formatProvider
     * @param $locale
     * @param $format
     * @param $expected
     */
    public function testFormat($locale, $format, $expected)
    {
        $this->assertSame($expected, $locale->format($format));
    }

    public static function formatProvider()
    {
        return [
            [Locale::fromString('en_us'), '%c_%L', 'us_EN'],
            [Locale::fromString('en_CA'), '%C_%L', 'CA_EN'],
            [Locale::fromString('en_US'), '%c_%l', 'us_en'],
            [Locale::fromString('EN_US'), '%c/%L', 'us/EN'],
            [Locale::fromString('en_us'), '%C\\%L', 'US\EN'],
            [Locale::fromString('en_Gb'), '%C\\\%L', 'GB\\\EN'],
        ];
    }
}
