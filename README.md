# 

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Patrick Brouwer``` `````` ```http://patrickdevelopment.nl``` ```info@patrickdevelopment.nl``` `````` `````` ```swim times api connector``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```

## Requirements
- PHP 5.6+
- cURL or fsock
- An activated account on SwimTimes, with API access (<http://www.swimtimes.nl>)
- For API access send a request on <http://www.squesportz.nl/contact/>

## Install

Via Composer

``` bash
$ composer require /
```

add in config app.php
```
patrickBrouwer\SwimTimesApi\SwimTimesApiServiceProvider::class
```

## Usage

``` php
$skeleton = new patrickbrouwer/SwimTimesApi();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email info@patrickdevelopment.nl instead of using the issue tracker.

## Credits

- [Patrick Brouwer][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v//.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis///master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g//.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g//.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt//.svg?style=flat-square

[link-packagist]: https://packagist.org/packages//
[link-travis]: https://travis-ci.org//
[link-scrutinizer]: https://scrutinizer-ci.com/g///code-structure
[link-code-quality]: https://scrutinizer-ci.com/g//
[link-downloads]: https://packagist.org/packages//
[link-author]: https://github.com/
[link-contributors]: ../../contributors
