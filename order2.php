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

// マスターデータとして持つべき情報と、（計算）結果の情報がごっちゃになっているのはよくない
$products = [
    1 => ['name' => '製品A', 'order' => 0, 'created' => 0],
    2 => ['name' => '製品B', 'order' => 0, 'created' => 0],
    3 => ['name' => '製品C', 'order' => 0, 'created' => 0],
];

$parts = [
    'A' => ['count' => 0],
    'B' => ['count' => 0],
    'C' => ['count' => 0],
    'D' => ['count' => 0],
];

// 最初に製品とその構成要素を定義している配列がないのは不自然

// 出力は最後にまとめてやろう
echo "○製造前の各部品の在庫数" . "<br>";
// foreach (array_keys($parts) as $part_name)
foreach ($parts as $part_name => $part) {
    $parts[$part_name]['count'] = mt_rand(50, 100);
    echo '部品' . $part_name . ' ' . $parts[$part_name]['count'] . "個" . "<br>";
}
echo "<br>";

echo "○各製品の発注数" . "<br>";
foreach ($products as $product_id => $product) {
    $products[$product_id]['order'] = mt_rand(0, 50);
    echo $product['name'] . ' ' . $products[$product_id]['order'] . "個" . "<br>";
}
echo "<br>";

foreach ($products as $product_id => $product) {
    while (true) {
        if ($product['name'] === '製品A'){
            // このやり方だと製品が増えた時にコードの追加が大変
            if (($parts['A']['count'] < 2) || ($parts['B']['count'] < 1) || ($products[$product_id]['order'] === 0)) {
                break;
            } else {
                $parts['A']['count']              -= 2;
                $parts['B']['count']              -= 1;
                $products[$product_id]['created'] += 1;
                $products[$product_id]['order']   -= 1;
            }

        } elseif ($product['name'] === '製品B') {
            if (($parts['C']['count'] < 3) || ($parts['D']['count'] < 2) || ($products[$product_id]['order'] === 0)) {
                break;
            } else {
                $parts['C']['count']              -= 3;
                $parts['D']['count']              -= 2;
                $products[$product_id]['created'] += 1;
                $products[$product_id]['order']   -= 1;
            }

        } elseif ($product['name'] === '製品C') {
            if (($parts['B']['count'] < 1) || ($parts['D']['count'] < 1) || ($products[$product_id]['order'] === 0)) {
                break;
            } else {
                $parts['B']['count']              -= 1;
                $parts['D']['count']              -= 1;
                $products[$product_id]['created'] += 1;
                $products[$product_id]['order']   -= 1;
            }
        }
    }
}

echo "○製造した製品の各個数"  . "<br>";
foreach ($products as $product) {
    echo $product['name'] . ' ' . $product['created'] . "個" . "<br>";
}
echo "<br>";

echo "○製造後の各部品の在庫数" . "<br>";
foreach ($parts as $part_name => $part) {
    echo '部品' . $part_name . ' ' . $part['count'] . "個" . "<br>";
}