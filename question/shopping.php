<?php

/**
 * ある商品群があります
 * 商品は名前と金額
 *
 * ある買う人がいます
 * 名前と都道府県
 *
 * その人が商品をN個買います
 * 買う商品はランダムで購入数もランダム 1個以上
 *
 * 送料は500円
 * ただ、購入数が5以上の場合は1000円
 * ただ、沖縄県と北海道はプラス1000円
 *
 * 買った商品ごとの商品名、個数と、金額
 * 小計、消費税、送料（消費税かからない）、合計金額
 */

// session を使うのはなんかおかしい
// 画面遷移をしないんだから、session なんか使わなくて普通に配列に情報を記憶しておけばいいだけじゃないの？
// というか、header() 使っているのがなんかおかしい
session_start();

$products = [
    ['name' => 'A', 'price' => 100],
    ['name' => 'B', 'price' => 200],
    ['name' => 'C', 'price' => 300],
    ['name' => 'D', 'price' => 500],
];

// $human がなんで全ての都道府県の情報とか複数の名前を持ってるの
$human = [
    'name'     => ['佐藤', '鈴木' ,'高橋', '田中', '伊藤'],
    'location' => ['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'];
];

// 購入者情報破棄の決定
if (empty($_SESSION)) {
    $name_index = array_rand($human['name']);
    $name       = $human['name'][$name_index];

    $location_index = array_rand($human['location']);
    $location       = $human['location'][$location_index];
} else {
    $name     = $_SESSION['name'];
    $location = $_SESSION['location'];
}
echo $name . 'さん' . '<br>';
echo '配送先 ' . $location . '<br>';

// 小計 及び 購入数
$amount   = 0;
$subtotal = 0;
foreach ($products as $product) {
    $count     = rand(0, 2);
    $amount   += $count;
    $price     = $product['price'] * $count;
    $subtotal += $price;

    echo "{$product['name']} × {$count} = {$price}" . '<br>';
}
echo "小計 {$subtotal}円" . '<br>';

// 一つ以上購入
if ($amount === 0) {
	  $_SESSION['name']     = $name;
	  $_SESSION['location'] = $location;
    header("Location: shopping.php");
    // header("Location: check_shopping.php");
}

// 消費税
$consume_tax = $subtotal * 0.08;
echo "消費税 {$consume_tax}円" . '<br>';

// 送料
$submittion_price = 500;
if ($amount >= 5) {
	$submittion_price += 500;
}
if (($location === '北海道') || ($location === '沖縄')) {
	$submittion_price += 1000;
}
echo "送料 {$submittion_price}円" . '<br>';

// 合計
$total_price = $subtotal + $consume_tax + $submittion_price;
echo "合計 {$total_price}" . '<br>';

// session 破棄
if ((isset($_SESSION)) && ($amount > 0)) {
	session_destroy();
}