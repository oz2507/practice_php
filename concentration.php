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
 * 神経衰弱
 */

$players = [
    ['name' => '佐藤', 'total_point' => 0],
    ['name' => '鈴木', 'total_point' => 0],
    ['name' => '高橋', 'total_point' => 0],
    ['name' => '田中', 'total_point' => 0],
];

$suits =['heart', 'diamond', 'club', 'spade'];

$cards = [];
foreach ($suits as $suit) {
    for ($number = 1; $number <= 13; $number++) { 
      $cards[] = ['suit' => $suit, 'number' => $number];
    }
}

$player_index = 0;
while (count($cards) > 0) {
    $selected_cards = array_rand($cards, 2);
    if ($cards[$selected_cards[0]]['number'] === $cards[$selected_cards[1]]['number']) {
        $players[$player_index]['total_point'] += 1;
        unset($cards[$selected_cards[0]], $cards[$selected_cards[1]]);
    } else {
        $player_index += 1;
        if ($player_index >= 4) {
            $player_index = 0;
        }
    }
}

foreach ($players as $player) {
    echo $player['name'] . 'さん ' . $player['total_point'] . '組' . '<br>';
}