<?php

namespace Bluemmb\Faker\Tests;

use Bluemmb\Faker\PicsumPhotosProvider;
use PHPUnit\Framework\TestCase;

class SpecificAsIdTest extends TestCase
{
    /**
     * Test if $specific=true|int returns a valid id and url
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

        $regex = "<https://picsum.photos/id/([0-9]+)/{$width}/{$height}>";

        $this->assertRegExp($regex, $url);

        $matchs_array = [];
        $matchs = preg_match($regex, $url, $matchs_array);

        $min = PicsumPhotosProvider::$picsumPhotosMinImageID;
        $max = PicsumPhotosProvider::$picsumPhotosMaxImageID;
        $this->assertTrue(
            $matchs_array[1] >= $min && $matchs_array[1] <= $max,
            "Specific number {$matchs_array[1]} is not in range 0..1084"
        );

        $this->assertFalse(
            array_key_exists($matchs_array[1], PicsumPhotosProvider::$picsumPhotosInvalidImageIDs)
        );
    }


    public function dataProvider()
    {
        return [
            [
                100, 100, true,
            ],
            [
                200, 200, true,
            ],
            [
                400, 100, true,
            ],
            [
                400, 100, 86,
            ],
            [
                400, 100, 0,
            ],
            [
                400, 100, -500,
            ],
            [
                400, 100, 3513133,
            ],
        ];
    }
}
