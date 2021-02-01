<?php

namespace Bluemmb\Faker;

use Faker\Provider\Base as BaseProvider;

class PicsumPhotosProvider extends BaseProvider
{
    protected static $baseUrl = "https://picsum.photos/";

    public static function imageUrl(
        int $width = 640, int $height = 480, $specificOrSeed=null,
        $grayscale=null, $blur=null, $file_ending=null
    )
    {
        // Default $specificOrSeed == false|null
        $id = null;
        $seed = null;
        $args = [];

        // id | seed
        if ( $specificOrSeed === true ) {
            $id = static::validPicsumPhotosImageID();
        }
        else if ( is_int($specificOrSeed) ) {
            $id = static::validPicsumPhotosImageID($specificOrSeed);
        }
        else if ( is_string($specificOrSeed) ) {
            $seed = $specificOrSeed;
        }

        // grayscale
        if ( $grayscale ) {
            $args["grayscale"] = 'true';
        }

        // blur
        if ( !is_null($blur) ) {
            if ( $blur === true ) {
                $args["blur"] = 'true';
            }
            else if ( is_int($blur) ) {
                $blur = static::sureBetween($blur, 1, 10);
                $args["blur"] = $blur;
            }
        }

        // url
        $url = "{$width}/{$height}" . ($file_ending ? '.'.$file_ending : '');
        if      ( !is_null($id)   ) $url = "id/{$id}/" . $url;
        else if ( !is_null($seed) ) $url = "seed/{$seed}/" . $url;

        if ( count($args) > 0 ) {
            $url .= "?" . http_build_query($args);
        }

        return static::$baseUrl . $url;
    }


    /*
     * The following variables are generated by the scripts/InvalidImagesListGenerator.php
     *
     * $picsumPhotosMinImageID
     * $picsumPhotosMaxImageID
     * $picsumPhotosInvalidImageIDs : Some image id's are invalid between [min,max], this array suggests valid replacements for them
     */

    public static $picsumPhotosMinImageID = 0;
    public static $picsumPhotosMaxImageID = 1084;

    public static $picsumPhotosInvalidImageIDs = [
        86=>82, 97=>39, 105=>96, 138=>103, 148=>16, 150=>23, 205=>116, 207=>173, 224=>37, 226=>52,
        245=>127, 246=>165, 262=>36, 285=>169, 286=>47, 298=>146, 303=>273, 332=>82, 333=>127, 346=>200,
        359=>42, 394=>356, 414=>269, 422=>131, 438=>254, 462=>114, 463=>419, 470=>198, 489=>104, 540=>249,
        561=>549, 578=>571, 587=>212, 589=>424, 592=>528, 595=>249, 597=>495, 601=>80, 624=>404, 632=>317,
        636=>533, 644=>556, 647=>237, 673=>447, 697=>614, 706=>271, 707=>529, 708=>53, 709=>372, 710=>323,
        711=>18, 712=>403, 713=>425, 714=>488, 720=>30, 725=>264, 734=>81, 745=>251, 746=>437, 747=>158,
        748=>113, 749=>175, 750=>111, 751=>291, 752=>388, 753=>424, 754=>28, 759=>289, 761=>247, 762=>161,
        763=>99, 771=>31, 792=>340, 801=>617, 812=>672, 843=>385, 850=>234, 854=>130, 895=>562, 897=>75,
        899=>594, 917=>445, 920=>501, 934=>485, 956=>886, 963=>371, 968=>913, 1007=>30, 1017=>683,
        1030=>649, 1034=>538, 1046=>47
    ];

    protected static function validPicsumPhotosImageID($id=null)
    {
        if ( is_int($id) ) {
            $id = static::sureBetween($id, static::$picsumPhotosMinImageID, static::$picsumPhotosMaxImageID);
        }

        if ( is_null($id) ) {
            $id = static::numberBetween(static::$picsumPhotosMinImageID, static::$picsumPhotosMaxImageID);
        }

        if ( array_key_exists($id, static::$picsumPhotosInvalidImageIDs) ) {
            return static::$picsumPhotosInvalidImageIDs[$id];
        }

        return $id;
    }


    /*
     * Helpers
     */

    protected static function sureBetween($value, $min, $max)
    {
        return min( max($value, $min), $max );
    }
}
