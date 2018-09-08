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

