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

// product -> name
// priceの位置も合わせる
$drinks = [
	['product' => 'エナジードリンク',   'price'  => 150],
	['product' => '炭酸飲料水',        'price'        => 140],
	['product' => 'スポーツドリンク',   'price'   => 130],
	['product' => '缶コーヒー',        'price'        => 120],
	['product' => 'ミネラルウォーター', 'price' => 110],
];

/*

// master data
$drinks = [
	1 => ['name' => 'エナジードリンク', 'price' => 160],
	2 =>
	3 =>
];

$purchased_drinks = [
	1 => 3,
	3 => 2,
];

foreach ($purchased_drinks as $drink_id => $count) {
	echo $drinks[$drink_id]['name'];
}

*/

// 保守性が低い
// データ構造をちゃんとすれば、いらなくなる
$drinks_for_price = ['エナジードリンク' => 150, '炭酸飲料水' => 140, 'スポーツドリンク' => 130, '缶コーヒー' => 120, 'ミネラルウォーター' => 110];

$moneys = [1000, 500, 100, 10];

// ランダムに数字を取得する関数を使う
$determine_how_many = [1, 2, 3, 4, 5];
// ランダムに数字を取得する関数を使う
$lottery = [0, 1];


$total_money = 0;
foreach ($moneys as $money) {
	$money_indx = array_rand($determine_how_many);
	// {}がない
	// ""必要ない
	$total_money += $money * $determine_how_many["$money_indx"]; 
}
echo "○投入金額 {$total_money}円" .'<br>'. '<br>';

// tmp_priceは必要ない
$tmp_price = 0;
$change = $total_money - $tmp_price;
$flag = 1;

while (($flag === 1) && ($change >= 150)) {
	$purchased_drink_index = array_rand($drinks);
	$purchased_drinks[] = $drinks["$purchased_drink_index"]['product'];
	$change -= $drinks["$purchased_drink_index"]['price'];

	$lottey_index = array_rand($lottery);
	$flag = $lottery["$lottey_index"];
}


echo '○購入したもの'. '<br>';

$purchased_drinks_counts = array_count_values($purchased_drinks);
$price_sum = 0;

// $purchased_drinks_count -> drink_name
foreach ($purchased_drinks_counts as $purchased_drinks_count => $count) {
	// price 等で十分
	$every_drinks_price = $drinks_for_price[$purchased_drinks_count] * $count;
	echo "{$purchased_drinks_count} × {$count} = {$every_drinks_price}". '<br>';

	$price_sum += $every_drinks_price;
}

echo "=>合計金額 {$price_sum}円". '<br>'. '<br>';
echo "○おつり {$change}円";