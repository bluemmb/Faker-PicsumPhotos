<?php

namespace Bluemmb\Faker\Tests;

use Bluemmb\Faker\PicsumPhotosProvider;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Bluemmb\Faker\PicsumPhotosProvider
 */
class PicsumPhotosProviderTest extends TestCase
{
    /**
     * @covers ::imageUrl
     * @dataProvider imageUrlDataProvider
     */
    public function testImageUrl($expected, $width = 640, $height = 480, $specific=false, $random=false, $gray=false, $blur=false, $gravity=null)
    {
        $url = PicsumPhotosProvider::imageUrl($width, $height, $specific, $random, $gray, $blur, $gravity);

        $this->assertSame("https://picsum.photos/".$expected, $url);
    }

    public function imageUrlDataProvider()
    {
        // TODO: Test random outputs ( $specific = true )

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
                'g/100/100',
                100, 100, false, false, true,
            ],
            [
                '100/100?image=22',
                100, 100, 22
            ],
            [
                '100/100?random=1',
                100, 100, false, true,
            ],
            [
                'g/100/100?random=1',
                100, 100, false, true, true,
            ],
            [
                '100/100?blur=1',
                100, 100, false, false, false, true,
            ],
            [
                'g/100/100?blur=1',
                100, 100, false, false, true, true,
            ],
            [
                '100/100?gravity=north',
                100, 100, false, false, false, false, 'north',
            ],
            [
                '100/100?gravity=east',
                100, 100, false, false, false, false, 'east',
            ],
            [
                '100/100?gravity=south',
                100, 100, false, false, false, false, 'south',
            ],
            [
                '100/100?gravity=west',
                100, 100, false, false, false, false, 'west',
            ],
            [
                '100/100?gravity=center',
                100, 100, false, false, false, false, 'center',
            ],
            [
                '100/100',
                100, 100, false, false, false, false, 'wrong',
            ],
            [
                'g/100/100?random=1&blur=1&gravity=west',
                100, 100, false, true, true, true, 'west',
            ],
        ];
    }
}