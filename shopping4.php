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

while (($total_count === 0) || (mt_rand(0, 10) >= 3)) {
    $product_id     = array_rand($products);
    $purchase_count = mt_rand(0, 3);

    if ($purchase_count > 0) {
        $subtotal    += $products[$product_id]['price'] * $purchase_count;
        $total_count += $purchase_count;

        if (isset($purchased_products[$product_id])) {
            $purchased_products[$product_id]['count'] += $purchase_count;
        } else {
            $purchased_products[$product_id] = ['count' => $purchase_count];
        }
    }
}
if ($total_count < 5) {
    $shipping_fee = 500;
} else {
    $shipping_fee = 1000;
}

if (in_array($prefecture, ['北海道', '沖縄県'])) {
    $shipping_fee += 1000;
}

echo $name . 'さん' . '<br>';
echo '配送先 ' . $prefecture . '<br>';

foreach ($purchased_products as $product_id => $purchased_product) {
    echo $products[$product_id]['name'] . ' × ' . $purchased_product['count'] . ' = ' . $products[$product_id]['price'] * $purchased_product['count'] . '<br>';
}

echo "小計 "   . $subtotal .                                        " 円" . '<br>';
echo "消費税 " . $subtotal * 0.08 .                                 " 円" . '<br>';
echo "送料 "   . $shipping_fee .                                    " 円" . '<br>';
echo "合計 "   . ($subtotal + ($subtotal * 0.08) + $shipping_fee) . " 円";