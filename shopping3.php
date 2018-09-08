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
    1 => ['name' => 'A', 'price' => 100],
    2 => ['name' => 'B', 'price' => 200],
    3 => ['name' => 'C', 'price' => 300],
    4 => ['name' => 'D', 'price' => 500],
    5 => ['name' => 'E', 'price' => 700],
    6 => ['name' => 'F', 'price' => 800],
    7 => ['name' => 'G', 'price' => 900],
];

$human_names = ['佐藤', '鈴木', '高橋', '田中', '伊藤'];
$prefectures = ['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'];

$name_index = array_rand($human_names);
$name       = $human_names[$name_index];

$prefecture_index = array_rand($prefectures);
$prefecture       = $prefectures[$prefecture_index];

$subtotal           = 0;
$total_count        = 0;
$purchased_products = [];

while (true) {
    // イコールの位置がおかしい
    $product_id     = array_rand($products);

    // すでに買ってたら買えない というのはなんかおかしい気がする
    if (!isset($purchased_products[$product_id])) {
        $purchase_count = mt_rand(0, 3);

        if ($purchase_count > 0) {
            $subtotal                       += $products[$product_id]['price'] * $purchase_count;
            $total_count                    += $purchase_count;
            // information の r が抜けてる
            // product_information はこの配列が持つべきじゃない
            // そもそもマスターデータと重複しちゃってるし
            $purchased_products[$product_id] = ['product_infomation' => $products[$product_id], 'count' => $purchase_count];
        }
    }
    if (($total_count > 0) && (mt_rand(0, 10) <= 2)) {
        break;
    }
}

$postage = 500;
if ($total_count >= 5) {
    $postage += 500;
}
// in_array($prefecture, ['北海道', '沖縄県']) こう言う書き方もできる
if (($prefecture === '北海道') || ($prefecture === '沖縄県')) {
    $postage += 1000;
}

echo $name . 'さん' . '<br>';
echo '配送先 ' . $prefecture . '<br>';

foreach ($purchased_products as $purchased_product) {
    echo $purchased_product['product_infomation']['name'] . ' × ' . $purchased_product['count'] . ' = ' . $purchased_product['product_infomation']['price'] * $purchased_product['count'] . '<br>';
}

// . で揃えた方が見やすいよ
echo "小計 " . $subtotal . " 円" . '<br>';
echo "消費税 " . $subtotal * 0.08 . " 円" . '<br>';
echo "送料 " . $postage . " 円" . '<br>';
echo "合計 " . ($subtotal + ($subtotal * 0.08) + $postage) . " 円";

// echo "<pre>";
// var_dump($purchased_products);
// echo "</pre>";