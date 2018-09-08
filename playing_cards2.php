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
	['name' => 'Aさん', 'total' => 0],
	['name' => 'Bさん', 'total' => 0],
	['name' => 'Cさん', 'total' => 0],
	['name' => 'Dさん', 'total' => 0]
];

$cards = [];

for ($num = 1; $num <= 13; $num++) {
	for ($suit = 1; $suit <= 4; $suit++) {
		$cards[] = $num;
	}
}

$player_index = 0;
while (count($cards) > 0) {
	$selected_cards_keys = array_rand($cards, 2);

	if ($cards[$selected_cards_keys[0]] === $cards[$selected_cards_keys[1]]) {
		$players[$player_index]['total'] += 1;
		unset($cards[$selected_cards_keys[0]], $cards[$selected_cards_keys[1]]);
		continue;
	}

	$player_index += 1;
	if ($player_index >= 4) {
		$player_index = 0;
	}
}

foreach ($players as $player) {
	echo "{$player['name']} は {$player['total']}組 獲得".'<br>';
}