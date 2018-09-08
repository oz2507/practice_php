<?php
/**
 * プレイヤーはN人(N>1)
 * トランプ52枚を順番に2枚ずつめくる
 * 同じ数字だったらもう一度めくる
 * めくるカードが無くなったら終了
 * 違う数字だったら次の人
 * N人目の次の人は1人目
 * J,Q,kは11,12,13でいい
 * 2枚めくって同じ数字だったらめくる対象から除外する
 * 各プレイヤーが取った組の数を出力する
 *
 * 神経衰弱です
 */

$players = [
	['name' => 'Aさん', 'total_point' => 0],
	['name' => 'Bさん', 'total_point' => 0],
	['name' => 'Cさん', 'total_point' => 0],
	['name' => 'Dさん', 'total_point' => 0],
];

$cards = [];

$suits = ['spade', 'club', 'heart', 'diamond'];
foreach ($suits as $suit) {
	for ($number = 1; $number <= 13; $number++) {
			$cards[] = $number;
	}
}

$current_player_index = 0;
while (count($cards) > 0) {
	$selected_cards_indexes = array_rand($cards, 2);

	if ($cards[$selected_cards_indexes[0]] === $cards[$selected_cards_indexes[1]]) {
		$players[$current_player_index]['total_point'] += 1;
		unset($cards[$selected_cards_indexes[0]], $cards[$selected_cards_indexes[1]]);
		continue;
	}

	$current_player_index += 1;
	if ($current_player_index >= 4) {
		$current_player_index = 0;
	}
}

foreach ($players as $player) {
	echo "{$player['name']} は {$player['total_point']}組 獲得".'<br>';
}