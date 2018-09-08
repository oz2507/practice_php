<?php

/**
 * エナジードリンク 150円
 * 炭酸飲料水 140円
 * スポーツドリンク 130円
 * 缶コーヒー 120円
 * ミネラルウォーター 110円
 *
 * X円投入する(X > 0)
 * 投入できるのは1000円札、500円硬貨、100円硬貨、50円硬貨、10円硬貨のみ
 * 10000円札、5000円札、2000円札、5円硬貨、1円硬貨は使用不可
 * 紙幣、硬貨の最大数はY枚とする(Y > 0)
 *
 * ランダムで飲料を購入する
 * ただし、飲料の合計金額がNを超えてはならない
 * 各飲料の在庫数はZ本とする(Z > 0)
 *
 * 任意の金額N円(1000,500,100,50,10円(の組み合わせで成立する額))を
 * 1回のみ自販機に投入して、
 * ランダムに何か買ってゆく。
 * それが何本でもいいし、何を買ってもいい。
 * まだ何か買えたとしても、どこで打ち切るかもランダム。
 *
 * 購入したら投入金額、各飲料の本数とその合計金額、全飲料の合計金額、おつりを表示する
 */


$drinks = [
	['name' => 'エナジードリンク',   'price' => 150],
	['name' => '炭酸飲料水',        'price' => 140],
	['name' => 'スポーツドリンク',   'price' => 130],
	['name' => '缶コーヒー',        'price' => 120],
	['name' => 'ミネラルウォーター', 'price' => 110],
];

$moneys = [1000, 500, 100, 10];

$total_money = 0;
foreach ($moneys as $money) {
	$money_count  = rand(1, 5); 
	$total_money += $money * $money_count; 
}
echo "○投入金額 {$total_money}円" . '<br>' . '<br>';


$rest_money = $total_money;
while (true) {
	$drink_index = array_rand($drinks);
	if ($rest_money >= $drinks[$drink_index]['price']) {
		$rest_money               -= $drinks[$drink_index]['price'];
		$purchased_drink_indexes[] = $drink_index;
	}
	if (rand(1, 10) <= 3) {
		break;
	}
}
echo '○購入したもの' . '<br>';

$drink_index_counts = array_count_values($purchased_drink_indexes);

$total_cost = 0;
foreach ($drink_index_counts as $drink_index => $count) {
	$price = $drinks[$drink_index]['price'] * $count;

	echo "{$drinks[$drink_index]['name']} × {$count} = {$price}" . '<br>';
	$total_cost += $price;
}

echo "=>合計金額 {$total_cost}円" . '<br>' . '<br>';
echo "○おつり {$rest_money}円";