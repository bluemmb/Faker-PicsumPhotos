Picsum.photos Provider for PHP Faker
===========================================

[![Build Status](https://travis-ci.org/bluemmb/Faker-PicsumPhotos.svg?branch=master)](https://travis-ci.org/bluemmb/Faker-PicsumPhotos)

[picsum.photos](http://picsum.photos/) provider for [Faker](https://github.com/fzaninotto/Faker).


## Install

Install the PicsumPhotos Provider by adding `bluemmb/faker-picsum-photos-provider` to your composer.json or from CLI:

```
$ composer require bluemmb/faker-picsum-photos-provider
```

## Usage

```php
$faker = Faker\Factory::create();
$faker->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));

// simple usage
$url = $faker->imageUrl();              // https://picsum.photos/640/480
$url = $faker->imageUrl(500);           // https://picsum.photos/500/480
$url = $faker->imageUrl(500,500);       // https://picsum.photos/500/500

// $specific = false | int[0..1084] | true ( generates a random valid image id in [0..1084] )
$url = $faker->imageUrl(500,500, false);    // https://picsum.photos/500/500
$url = $faker->imageUrl(500,500, true);     // https://picsum.photos/500/500?image=70
$url = $faker->imageUrl(500,500, true);     // https://picsum.photos/500/500?image=413
$url = $faker->imageUrl(500,500, true);     // https://picsum.photos/500/500?image=270
$url = $faker->imageUrl(500,500, 55);       // https://picsum.photos/500/500?image=55

// Some image id's are invalid, So the package automatically replaces them
$url = $faker->imageUrl(500,500, 86);       // https://picsum.photos/500/500?image=82


/*
 *  More options :
 *  function imageUrl($width = 640, $height = 480, $specific=false, $random=false, $gray=false, $blur=false, $gravity=null)
 */
 
// https://picsum.photos/100/100?random=1
$url = $faker->imageUrl(100,100, false, true);

// https://picsum.photos/g/100/100
$url = $faker->imageUrl(100,100, false, false, true);

// https://picsum.photos/100/100?blur=1
$url = $faker->imageUrl(100,100, false, false, false, true);

// $gravity = north|east|south|west|center
// https://picsum.photos/300/100?gravity=north
$url = $faker->imageUrl(300,100, false, false, false, false, 'north');

// mixed
// https://picsum.photos/g/300/100?blur=1&gravity=west&image=88
$url = $faker->imageUrl(300,100, 88, false, true, true, 'west');
```
 