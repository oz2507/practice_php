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

$products = [
    ['name' => 'A', 'price' => 100],
    ['name' => 'B', 'price' => 200],
    ['name' => 'C', 'price' => 300],
    ['name' => 'D', 'price' => 500],
];

$human_names = ['佐藤', '鈴木', '高橋', '田中', '伊藤'];
$prefectures = ['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'];


$name_index = array_rand($human_names);
$name       = $human_names[$name_index];

$prefecture_index = array_rand($prefectures);
$prefecture       = $prefectures[$prefecture_index];

echo $name . 'さん' . '<br>';
echo '配送先 ' . $prefecture . '<br>';

$amount           = 0;
$subtotal         = 0;
$purchase_results = [];
while(true){
    foreach ($products as $product) {
        $count     = rand(0, 1);
        $amount   += $count;
        $price     = $product['price'] * $count;
        $subtotal += $price;

        $purchase_results[] = ['name' => $product['name'], 'count' => $count, 'price' => $price];
    }
    if ($amount === 0) {
        unset($purchase_results);
        continue;
    }
    break;
}

foreach ($purchase_results as $purchase_result) {
    echo "{$purchase_result['name']} × {$purchase_result['count']} = {$purchase_result['price']}" . '<br>';
}

echo "小計 {$subtotal}円" . '<br>';

$consumption_tax = $subtotal * 0.08;
echo "消費税 {$consumption_tax}円" . '<br>';

$postage = 500;
if ($amount >= 5) {
	$postage += 500;
}
if (($prefecture === '北海道') || ($prefecture === '沖縄県')) {
	$postage += 1000;
}
echo "送料 {$postage}円" . '<br>';

$total_price = $subtotal + $consumption_tax + $postage;
echo "合計 {$total_price}" . '<br>';