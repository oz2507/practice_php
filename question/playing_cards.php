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

// プレイヤーを用意(所持枚数と名前)

$player_a = [0, 'Aさん'];
$player_b = [0, 'Bさん'];
$player_c = [0, 'Cさん'];
$player_d = [0, 'Dさん'];

$players = [$player_a, $player_b, $player_c, $player_d];

// 52枚のカードを配列の中に入れる
$cards = [];

for ($i = 1; $i <= 13; $i++) {
	for ($j = 1; $j <= 4; $j++) {
		$cards[] = $i;
	}
}

$k = 0;
// 場のカードが無くなるまで以下を繰り返す
while (count($cards) !== 0) {
	// 配列からランダムに2枚のカードを取り出し比較
	$selected_cards = array_rand($cards, 2);
	// 等しければプレイヤーの取り分とし、場の配列から削除
	if ($cards[$selected_cards[0]] === $cards[$selected_cards[1]]) {
		$players[$k][0] += 2;
		unset($cards[$selected_cards[0]], $cards[$selected_cards[1]]);
		continue;
	}
	$k += 1;
	if ($k >= 4) {
		$k = 0;
	}
}
// それぞれのプレイヤーの取得した枚数を出力
foreach ($players as $player) {
	$result = $player[0] / 2;
	echo "{$player[1]} は {$result}組 獲得".'<br>';
}