<?php

/*
 * This script goes through the images list at https://picsum.photos/list
 *    and discovers the image id's that are invalid in range [0..?].
 *    Also for each image id that is invalid, it suggests a random valid image id to replace with.
 *
 * The produced invalids array can help to use the package offline
 *    by preventing of checking that if the chosen random image id is valid or not.
 */

$url = "https://picsum.photos/list";

echo "Downloading latest list ...";
$contents = file_get_contents($url);
$contents = utf8_encode($contents);
$results = json_decode($contents);
echo "\n\nNumber of images : " . count($results);

/*
 * Assumptions :
 *      - ID's are started from 0
 *      - ID's are in Ascending order
 *      - There is at least 1 valid image id
 */

// Set a fixed seed number
srand(1000000007);

echo "\n\nFinding invalid image id's ...";
$invalids = [];
$valids = [];
$last = -1;

foreach ( $results as $r ) {
    $id = $r->id;
    $valids[] = $id;

    while ( ++$last < $id )
        $invalids[$last] = $valids[ array_rand($valids) ];

    $last = $id;
    $last_valid = $id;
}

echo "\n\nMax id : " . $last;

$suggestions = [];
foreach ( $invalids as $key => $val ) {
    $suggestions[] = "{$key}=>{$val}";
}

echo "\n\nInvalids list with replacement suggestions : \n[" . implode(", ", $suggestions) . "]";
