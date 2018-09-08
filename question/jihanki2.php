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
	'a' => ['name' => 'エナジードリンク',   'price' => 150],
	['name' => '炭酸飲料水',        'price' => 140],
	['name' => 'スポーツドリンク',   'price' => 130],
	['name' => '缶コーヒー',        'price' => 120],
	['name' => 'ミネラルウォーター', 'price' => 110],
];

var_dump($drinks);
exit;

$moneys = [1000, 500, 100, 10];

$total_money = 0;
foreach ($moneys as $money) {
	// $money_index or $money_idx
	// index というと $moneys 配列のインデックスっぽい
	// 各お金の枚数なのだから $money_count とかにすべき
	$money_indx   = rand(1, 5);
	$total_money += $money * $money_indx;
}
echo "○投入金額 {$total_money}円" .'<br>'. '<br>';

// お釣りを英訳すると change なのかもしれないけど、このプログラム初見の人が見た時に change -> お釣り の和訳は出てこない
// rest_money とかの方がわかりやすい
$change = $total_money;
// flag はこれを見た時に何を管理している何なのか全くわからないので微妙
$flag   = 1;
// flag というよくわからない変数名をつけてしまっているせいで、この条件式が何を言っているのかわからない
// (rand(1, 10) <= 3) とかの方がよっぽどわかりやすいし、確率を変えるのもラク
// $change が140の時に140円以下の飲み物を買えないのは仕様と違うよ
// ドリンクの種類が変わって200円の商品が追加された時に、ここも変えなきゃいけないの？という保守性の問題もある
while (($flag % 10 !== 0) && ($change >= 150)) {
	// 複数形にしてるけど、これ配列じゃないよね？
	$drinks_indexes     = array_rand($drinks);
	$change            -= $drinks[$drinks_indexes]['price'];
	// $purchased_drink_indexes であるべき
	// $purchased_drinks だと、中に入っていそうなのは ['name' => 'エナジードリンク', 'price' => 150]
	$purchased_drinks[] = $drinks_indexes;
	$flag               = rand();
}
echo '○購入したもの'. '<br>';

// index
$purchased_drinks_counts = array_count_values($purchased_drinks);

$price_sum = 0;
foreach ($purchased_drinks_counts as $drink_id => $count) {
	$price = $drinks[$drink_id]['price'] * $count;

	// . の前にスペース
	echo "{$drinks[$drink_id]['name']} × {$count} = {$price}". '<br>';
	$price_sum += $price;
}

echo "=>合計金額 {$price_sum}円". '<br>'. '<br>';
echo "○おつり {$change}円";