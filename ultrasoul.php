<?php

/**
 * ウルトラソウル
 *
 * ウル / トラ / ソウル をランダムに出力
 * ウルトラソウル　が続いたら「ハイ！」と出力
 * おわり
 */

$words   = ['ウル', 'トラ', 'ソウル'];
$results = [];
while ($words !== $results) {
    $word_index = array_rand($words);
    $results[]  = $words[$word_index];
    echo $words[$word_index];

    if (count($results) > count($words)) {
        array_shift($results);
    }
}
echo 'ハイ!';