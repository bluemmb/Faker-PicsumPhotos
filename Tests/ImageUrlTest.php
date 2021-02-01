<?php

namespace Bluemmb\Faker\Tests;

use Bluemmb\Faker\PicsumPhotosProvider;
use PHPUnit\Framework\TestCase;

class ImageUrlTest extends TestCase
{
    /**
     * @dataProvider imageUrlDataProvider
     */
    public function testImageUrl(
        $expected,
        $width = 640, $height = 480, $specificOrSeed=null,
        $grayscale=null, $blur=null, $file_ending=null
    )
    {
        $url = PicsumPhotosProvider::imageUrl(
            $width, $height, $specificOrSeed,
            $grayscale, $blur, $file_ending
        );

        $this->assertSame("https://picsum.photos/".$expected, $url);
    }

    public function imageUrlDataProvider()
    {
        return [
            [
                '640/480',

            ],
            [
                '100/480',
                100,
            ],
            [
                '100/100',
                100, 100,
            ],
            [
                '100/100',
                100, 100, false
            ],
            [
                'id/0/100/100',
                100, 100, 0
            ],
            [
                'id/22/100/100',
                100, 100, 22
            ],
            [
                'seed/22/100/100',
                100, 100, '22'
            ],
            [
                'seed/easteregg/42/42',
                42, 42, 'easteregg'
            ],
            [
                '100/100?grayscale=true',
                100, 100, false, true,
            ],
            [
                '100/100?blur=true',
                100, 100, false, false, true,
            ],
            [
                '100/100?blur=7',
                100, 100, false, false, 7,
            ],
            [
                '100/100?blur=10',
                100, 100, false, false, 12,
            ],
            [
                '100/100?grayscale=true&blur=true',
                100, 100, false, true, true,
            ],
            [
                '100/100.jpg',
                100, 100, false, false, false, 'jpg',
            ],
            [
                '100/100',
                100, 100, false, false, false, 'png',
            ],
            [
                'id/22/100/100.webp?grayscale=true&blur=5',
                100, 100, 22, true, 5, 'webp',
            ],
        ];
    }
}