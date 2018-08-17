<?php

namespace Bluemmb\Faker;

use Faker\Provider\Base as BaseProvider;

/**
 * picsum.photos provider for Faker
 *
 * @author Mohammad Eftekhari <bluemmb22@gmail.com>
 *
 * @link http://picsum.photos/
 */
class PicsumPhotosProvider extends BaseProvider
{
    protected static $baseUrl = "https://picsum.photos/";

    protected static $gravities = ["north", "east", "south", "west", "center"];

    // $specific = false|true|int
    public static function imageUrl($width = 640, $height = 480, $specific=false, $random=false, $gray=false, $blur=false, $gravity=null)
    {
        $url = "{$width}/{$height}/";
        $args = [];

        if ( $gray ) {
            $url = "g/" . $url;
        }

        if ( $random ) {
            $args["random"] = true;
        }

        if ( $blur ) {
            $args["blur"] = true;
        }

        if ( $gravity && in_array($gravity, static::$gravities) ) {
            $args["gravity"] = $gravity;
        }

        if ( $specific === true ) {
            // TODO: Some image id's are not valid
            $args["image"] = static::numberBetween(0, 1084);
        }
        else if ( is_int($specific) ) {
            $args["image"] = $specific;
        }

        if ( count($args) > 0 ) {
            $url .= "?" . http_build_query($args);
        }

        return $url;
    }
}
