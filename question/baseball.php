<?php

/**
 * ピッチャーがボールを投げる
 * ランダムでボールかストライクとなる
 * ボールだったらボールと出力する
 * ストライクだったらストライクと出力する
 * ボールが4つになったらフォアボールと出力する
 * ストライクが3つになったらアウトと出力する
 *
 * フォアボールかアウトになったら終了
 *
 * なお、ストライクだったら、
 * ランダムに、
 * 空振り、ファウル、ヒット、見逃しとなる
 *
 * 空振りの場合
 * 　[空振り]と出力
 * 　2ストライクだったら[空振り三振]と出力して終了する
 *
 * 見逃しの場合
 * 　[見逃し]と出力
 * 　2ストライクだったら[見逃し三振]と出力して終了する
 *
 * ファウルの場合
 * 　[ファウル]と出力
 *   2ストライクでもアウトにならない 
 *
 * ヒットの場合
 * 　[ヒット]と出力して終了する
 *
 */

