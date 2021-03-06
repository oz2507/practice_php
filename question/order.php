<?php

/**
 * 製品A
 *   部品A2個と部品B1個からできています。
 * 製品B
 *   部品C3個と部品D2個からできています。
 * 製品C
 *   部品B1個と部品D1個からできています。
 *
 * 製品Aと製品Bと製品Cをランダムで発注します。
 * 　部品にはそれぞれ在庫がありそれがなくなるまで製造します。
 *
 * 最後に以下を出力します。
 *
 * 製造前の各部品の在庫数
 * 製品の発注数
 * 製造した製品の個数
 * 製造後の各部品の在庫数
 */

function dump($arg) {
    echo '<pre>';
    var_dump($arg);
    echo '</pre>';
}
