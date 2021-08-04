# Locale Value Object

A simple locale value object.

<h1 align="center">ricardokovalski/locale</h1>

<p align="center">
    <strong>Um simples Locale Value Object.</strong>
</p>

<p align="center">
    <a href="https://github.com/ricardokovalski/locale"><img src="http://img.shields.io/badge/source-ricardokovalski/locale-blue.svg" alt="Source Code"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/php-%3E=5.6-777bb3.svg" alt="PHP Programming Language"></a>
    <a href="https://github.com/ricardokovalski/locale/releases"><img src="https://img.shields.io/github/release/ricardokovalski/locale.svg" alt="Source Code"></a>
    <a href="https://github.com/ricardokovalski"><img src="http://img.shields.io/badge/author-@ricardokovalski-blue.svg" alt="Author"></a>
    <a href="https://github.com/ricardokovalski/locale/blob/main/LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg" alt="Read License"></a>
</p>

<h2>Sobre</h2>

ricardokovalski/locale é um simples Locale Value Object desenvolvido em PHP.

<h2>Instalação</h2>

Instale este pacote como uma dependência usando [Composer](https://getcomposer.org).

```bash
composer require ricardokovalski/locale
```

<h2>Uso básico</h2>

```php
use RicardoKovalski\Locale\Locale;

Locale::fromString('en_US');
```

<h3>Formatando</h3>

```php
use RicardoKovalski\Locale\Locale;

Locale::fromString('en/US')->format('%L_%c');

//EN_us
```

<h3>Formatos permitidos</h3>

<table>
    <thead align="center">
        <tr>
            <td>Character</td>
            <td>Result</td>
        </tr>
    </thead>
    <tbody align="center">
        <tr>
            <td>c</td>
            <td>Country Code Lowercase</td>
        </tr>
        <tr>
            <td>C</td>
            <td>Country Code Uppercase</td>
        </tr>
        <tr>
            <td>l</td>
            <td>Language Code Lowercase</td>
        </tr>
        <tr>
            <td>L</td>
            <td>Language Code Uppercase</td>
        </tr>        
    </tbody>
</table>

<h2>Copyright and License</h2>

The ricardokovalski/locale library is copyright © [Ricardo Kovalski](https://github.com/ricardokovalski) and licensed for use under the terms of the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
