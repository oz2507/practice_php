<?php

function purchase($int, $int2){
    $result = $int + $int2;
    return $result;
}

$milk = 0;
$egg  = 'ありまぁす';
$int1 = 6;
$int2 = 1;

if (isset($egg)) {
    $result = purchase($milk, $int1);
} else {
    $result = purchase($milk, $int2);
}

echo "牛乳を {$result} 本購入";


$egg = mt_rand(0, 100)
if ($egg > 0) {
	$milk = 6;
} else {
	$milk = 1;
}