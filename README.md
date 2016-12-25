# Compare two Images, Texts or Files.

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Compare two Images, Texts or Files.

## Install

Via Composer

``` bash
$ composer require karakhanyans/comparison
```

## Usage
Add Service provider into providers array in config/app.php

```
Karakhanyans\Comparison\ComparisonServiceProvider::class,
```

``` php
$compare = new Compare();
echo $compare->images('path_to_first_image','path_to_second_image'); // will print difference percent
echo $compare->files('path_to_first_file','path_to_second_file'); // after this you can use following actions

echo $compare->differentWords(); // array with different words between two files
echo $compare->differentWordsCount(); // count of different words
echo $compare->differencePercent(); // difference in percent
echo $compare->sameWords(); // array with same words
echo $compare->sameWordsCount(); // count of same words
echo $compare->showFormattedText(); // will print different words highlighted in text


To compare texts you can use $compare->files() or $compare->texts();

```
##Configs

```
You can configure formatted styles, tags etc.

By default for highlighting plugin using <b> tag and #00BB00 color

To change that you should add configs before $compare->files();

$compare->tag('pre'); // will set tag to <pre>
$compare->style('color:#cccccc'); // will change highlighted color
$compare->class('className'); // class name

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

If you discover any security related issues, please email karakhanyansa@gmail.com instead of using the issue tracker.

## Credits

- [Sergey Karakhanyan][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/karakhanyans/comparison.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/karakhanyans/comparison/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/karakhanyans/comparison.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/karakhanyans/comparison.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/karakhanyans/comparison.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/karakhanyans/comparison
[link-travis]: https://travis-ci.org/karakhanyans/comparison
[link-scrutinizer]: https://scrutinizer-ci.com/g/karakhanyans/comparison/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/karakhanyans/comparison
[link-downloads]: https://packagist.org/packages/karakhanyans/comparison
[link-author]: https://github.com/karakhanyans
[link-contributors]: ../../contributors
