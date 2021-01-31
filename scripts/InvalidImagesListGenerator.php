<?php

/*
 * This script goes through the images list at https://picsum.photos/list
 *    and discovers the image id's that are invalid in range [0..?].
 *    Also for each image id that is invalid, it suggests a random valid image id to replace with.
 *
 * The produced invalids array can help to use the package offline
 *    by preventing of checking that if the chosen random image id is valid or not.
 */

$url = "https://picsum.photos/v2/list?limit=100&page=";

echo "Downloading the list of images ...\n";
$results = [];
$page = 1;
while ( true ) {
    echo "Downloading page ${page} ...\n";
    $contents = file_get_contents($url . (string)($page));
    $contents = utf8_encode($contents);
    $new_results = json_decode($contents);

    if ( count($new_results) == 0 )
        break;

    $results = array_merge($results, $new_results);
    $page = $page + 1;
}
echo "\n\nNumber of images : " . count($results);


/*
 * Sort the list by id
 */
usort($results, function ($a, $b) {
    return (intval($a->id) - intval($b->id)) > 0 ? +1 : -1;
});


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
}

echo "\n\nMin id : " . $results[0]->id;
echo "\nMax id : " . $last;

$suggestions = [];
foreach ( $invalids as $key => $val ) {
    $suggestions[] = "{$key}=>{$val}";
}

echo "\n\nInvalids list with replacement suggestions : \n[" . implode(", ", $suggestions) . "]";
