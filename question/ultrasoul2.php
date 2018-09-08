<?php

/**
 * ウルトラソウル
 *
 * ウル / トラ / ソウル をランダムに出力
 * ウルトラソウル　が続いたら「ハイ！」と出力
 * おわり
 */

$words  = ['ウル', 'トラ', 'ソウル'];
$result = [];

while ($words !== $result) {
	$result_key = array_rand($words);
	$tmp_result = $words[$result_key];
	echo $tmp_result;
	$result[] = $tmp_result;

	if (count($result) > count($words)) {
		array_shift($result);
	}
}

echo 'ハイ!';