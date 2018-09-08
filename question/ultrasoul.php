<?php

/**
 * ウルトラソウル
 *
 * ウル / トラ / ソウル をランダムに出力
 * ウルトラソウル　が続いたら「ハイ！」と出力
 * おわり
 */

$ultrasoul = array('ウル','トラ','ソウル');

while (true) {
	shuffle($ultrasoul);

	$result[] = $ultrasoul[0];
	echo $ultrasoul[0];
	// var_dump($result);

	$str = implode('', $result);
	// echo $str .'<br>';

	$count = mb_strlen($str);
	// echo $count;

	if ($count >= 7) {
		$first = mb_substr($str, -8, 1);
		$last = mb_substr($str, -7);
		// echo $last;

		if ($first !== 'ソ' && $last === 'ウルトラソウル') {
			echo 'ハイ!';
		 	break;
		}
	}
}