<?php

namespace Bluemmb\Faker\Tests;

use Bluemmb\Faker\PicsumPhotosProvider;
use PHPUnit\Framework\TestCase;

class SpecificAsSeedTest extends TestCase
{
    /**
     * Test if $specific=string returns valid seed and url
     *
     * @dataProvider dataProvider
     */
    public function test(
        $width = 640, $height = 480, $specificOrSeed=null,
        $grayscale=null, $blur=null, $file_ending=null
    )
    {
        $url = PicsumPhotosProvider::imageUrl(
            $width, $height, $specificOrSeed,
            $grayscale, $blur, $file_ending
        );

        $regex = "<https://picsum.photos/seed/([0-9a-zA-Z]+)/{$width}/{$height}>";

        $this->assertRegExp($regex, $url);

        $matchs_array = [];
        $matchs = preg_match($regex, $url, $matchs_array);
        $this->assertSame($specificOrSeed, $matchs_array[1]);
    }


    public function dataProvider()
    {
        return [
            [
                100, 100, '22',
            ],
            [
                200, 200, 'hello',
            ],
            [
                400, 100, 'picsum',
            ],
        ];
    }
}
