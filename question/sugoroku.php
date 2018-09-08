<?php

/**
 * すごろく
 *
 * サイコロ(6面)を振って出た目の数だけ進むことができる
 * サイコロを振ってゴール丁度に到達したときのみ上がることができる
 *   ゴールまでのマス目の数をオーバーしたらその分戻る
 *   例)ゴールの1マス前で3が出たらゴールの2マス前になる
 *
 * マップに何マスか戻るマスを1つ以上設置すること
 *   このマスに止まったら指定されたマス目分戻る
 * マップに何マスか進むマスを1つ以上設置すること
 *   このマスに止まったら指定されたマス目文進む
 * マップに1回スキップするマスを1つ以上配置すること
 *   このマスに止まったら次の自分の番が飛ばされる
 *
 * 複数人でプレイしたときゴールした順番とサイコロを振った回数を出力する
 *
 * 3マス進むマスの3マス先に3マス戻るマスがあるようなケースは想定しなくていい
 *   最初に自分で適当なマップを作成する
 *
 */

function dump($arg) {
    echo '<pre>';
    var_dump($arg);
    echo '</pre>';
}

$players = [
    'player1' => [
        'name'     => 'Yamada',
        'position' => 0,
        //'roll_dice_number' => 0,
    ],
    'player2' => [
        'name'     => 'Suzuki',
        'position' => 0,
        //'roll_dice_number' => 0,
    ],
    'player3' => [
        'name'     => 'Satou',
        'position' => 0,
        //'roll_dice_number' => 0,
    ],
];

$squares = [
    1 => [
        'action'    => 'advance',
        'parameter' => 2,
    ],
    2 => [
        'action' => 'none',
    ],
    3 => [
        'action' => 'none',
    ],
    4 => [
        'action' => 'none',
    ],
    5 => [
        'action'    => 'return',
        'parameter' => -2,
    ],
    6 => [
        'action' => 'none',
    ],
    7 => [
        'action' => 'none',
    ],
    8 => [
        'action' => 'skip',
    ],
    9 => [
        'action' => 'none',
    ],
    10 => [
        'action'    => 'back',
        'parameter' => -3,
    ],
    11 => [
        'action' => 'none',
    ],
    12 => [
        'action' => 'none',
    ],
    13 => [
        'action' => 'skip',
    ],
    14 => [
        'action' => 'none',
    ],
    15 => [
        'action' => 'goal',
    ],
];

$results = [];
foreach ($players as $player_key => $player) {
    $results[$player_key] = [
        'rank'             => null,
        'roll_dice_number' => 0,
    ];
}

// $goal_rankings = [];

$skips = [];
foreach ($players as $player_key => $player) {
    $skips[$player_key] = false;
}

$squares_count = count($squares);

$max_dice_number = 6;

while (true) {
    foreach ($players as $player_key => &$player) {
        // if (!in_array($player_key, $goal_rankings) && !$skips[$player_key]) {
        if ($results[$player_key]['rank'] === null && !$skips[$player_key]) {

            $roll_dice = mt_rand(1, $max_dice_number);

            // $player['roll_dice_number']++;
            $results[$player_key]['roll_dice_number']++;

            if (($player['position'] + $roll_dice) > $squares_count) {
                $return_square      = (($player['position'] + $roll_dice) - $squares_count);
                $player['position'] = ($squares_count - $return_square);
            } else {
                $player['position'] += $roll_dice;
            }
    
            if ($squares[$player['position']]['action'] === 'skip') {
                $skips[$player_key] = true;
                continue;
            } elseif ($squares[$player['position']]['action'] === 'goal') {
                // $goal_rankings[] = $player_key;
                $goal_players_count = count(array_filter(array_column($results, 'rank')));
                $results[$player_key]['rank'] = $goal_players_count + 1;
            } elseif ($squares[$player['position']]['action'] !== 'none') {
                $player['position'] += $squares[$player['position']]['parameter'];
            }
        }

        $skips[$player_key] = false;

        if (count(array_filter(array_column($results, 'rank'))) === count($players)) {
            break 2;
        }
    }
}

$ranks = [];
foreach ($results as $player_key => $result) {
    $ranks[$player_key] = $result['rank'];
}

array_multisort($ranks, SORT_ASC, $results);

/*
foreach ($goal_rankings as $key => $player_key) {
    echo '順位: ' . ($key + 1) . '位<br>';
    echo $player_key . '<br>';
    echo 'サイコロを振った回数 ' . $players[$player_key]['roll_dice_number'] . '回<br><br>';
}
*/

foreach ($results as $player_key => $result) {
    echo '順位: ' . $result['rank'] . '位<br>';
    echo $players[$player_key]['name'] . '<br>';
    echo 'サイコロを振った回数 ' . $result['roll_dice_number'] . '回<br><br>';
}
