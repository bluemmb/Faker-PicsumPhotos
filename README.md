Picsum.photos Provider for PHP Faker
===========================================

[![Build Status](https://travis-ci.org/bluemmb/Faker-PicsumPhotos.svg?branch=master)](https://travis-ci.org/bluemmb/Faker-PicsumPhotos)

*Build gives error for old php7 version only because of phpunit version*

[picsum.photos](http://picsum.photos/) provider for [Faker](https://github.com/fzaninotto/Faker).

## Versions
- [Version 2](#version-2)
- [Version 1 (old)](https://github.com/bluemmb/Faker-PicsumPhotos/tree/v1)


## Version 2

**Notice: This is documentation for new version, for older version go to [Version v1](https://github.com/bluemmb/Faker-PicsumPhotos/tree/v1)**

### Install

Install the PicsumPhotos Provider by adding `bluemmb/faker-picsum-photos-provider: "^2.0"` to your composer.json or from CLI:

```
$ composer require bluemmb/faker-picsum-photos-provider ^2.0
```

### Usage

```php
$faker = Faker\Factory::create();
$faker->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));

// simple usage
$url = $faker->imageUrl();              // https://picsum.photos/640/480
$url = $faker->imageUrl(500);           // https://picsum.photos/500/480
$url = $faker->imageUrl(500,500);       // https://picsum.photos/500/500

/*
 * $specificOrSeed
 *      - false | null : create simple url with no id or seed
 *      - true         : create id/{random id} url
 *      - int          : create id/{int} url
 *      - string       : create seed/{seed} url
 */
$url = $faker->imageUrl(500,500, false);    // https://picsum.photos/500/500
$url = $faker->imageUrl(500,500, true);     // https://picsum.photos/id/70/500/500
$url = $faker->imageUrl(500,500, true);     // https://picsum.photos/id/413/500/500
$url = $faker->imageUrl(500,500, 33);       // https://picsum.photos/id/33/500/500
$url = $faker->imageUrl(500,500, '33');     // https://picsum.photos/seed/33/500/500
$url = $faker->imageUrl(500,500, 'wow');    // https://picsum.photos/seed/wow/500/500

// Some image id's are invalid, So the package automatically replaces them
$url = $faker->imageUrl(500,500, 86);       // https://picsum.photos/id/82/500/500


/*
 *  More options :
 *  function imageUrl(
 *      $width = 640, $height = 480, $specificOrSeed=null, 
 *      $grayscale=null, $blur=null, $file_ending=null
 * )
 */
 
// https://picsum.photos/100/100?grayscale=true
$url = $faker->imageUrl(
    100,100, false, 
    true
);

// https://picsum.photos/g/100/100?blur=true
$url = $faker->imageUrl(
    100,100, false, 
    false, true
);

// https://picsum.photos/100/100?blur=5
$url = $faker->imageUrl(
    100,100, false, 
    false, 5
);

// https://picsum.photos/300/100.jpg
$url = $faker->imageUrl(
    300,100, false, 
    false, false, 'jpg'
);

// https://picsum.photos/id/88/300/100.webp?grayscale=true&blur=3
$url = $faker->imageUrl(
    300,100, 88,
    true, 3, 'webp'
);
```
 