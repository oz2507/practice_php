<?php

// 車のナンバーで真偽を判断
$numbers = ['46-49', '49-49', '49-46', '46-46'];

// 完全に一致するもののみ
foreach ($numbers as $number) {
		$result = preg_match("/46-49/", $number);
		if ($result) {
				echo "{$number}は条件に一致するナンバーです。<br>";
		} else {
				echo "{$number}は条件に一致しないナンバーです。<br>";
		}
}
echo "<br>";

// []を用いてを用いて範囲を指定
foreach ($numbers as $number) {
		$result = preg_match("/4[6-9]-49/", $number);
		if ($result) {
				echo "{$number}は条件に一致するナンバーです。<br>";
		} else {
				echo "{$number}は条件に一致しないナンバーです。<br>";
		}
}
echo "<br>";

// .はなんでもいい 
foreach ($numbers as $number) {
		$result = preg_match("/4.-49/", $number);
		if ($result) {
				echo "{$number}は条件に一致するナンバーです。<br>";
		} else {
				echo "{$number}は条件に一致しないナンバーです。<br>";
		}
}
echo "<br>";


// 電話番号の真偽を判断
$phone_numbers = ['080-1234-5678', '090-1234-5678', '010-1234-5678', '09012345678'];

foreach ($phone_numbers as $phone_number) {
		$result = preg_match("/(090|080|050)-{0,1}[0-9]{4}-{0,1}[0-9]{4}/u", $phone_number);
		if ($result) {
				echo "{$phone_number}は条件に一致するナンバーです。<br>";
		} else {
				echo "{$phone_number}は条件に一致しないナンバーです。<br>";
		}
}
echo "<br>";

// 郵便番号の真偽を判断
$postal_codes = ['123456', '〒123 456', '123 1234', '123-456'];

$pattern     = "/〒?\d{3}-?\d{4}/";
foreach ($postal_codes as $postal_code) {
		$result = preg_match($pattern, $postal_code);
		if ($result) {
				echo "正しい表記方法です。<br>";
		} else {
				echo "{$postal_code}は正しくない表記方法です。もう一度ご確認ください。<br>";
		}
}
echo "<br>";

// クレジットカードの番号の真偽を判断
$credit_cards = ['1234123412341234', '1234 1234 1234 1234', '1234 5678 9012 3456', '1234-1234-1234-1234'];

$pattern     = "/\d{4}\s?\d{4}\s?\d{4}\s?(\d{4})$/";
$replacement = "**** **** **** $1";
foreach ($credit_cards as $credit_card) {
		$result = preg_match($pattern, $credit_card);
		if ($result) {
				$replaced_result = preg_replace($pattern, $replacement, $credit_card);
				echo "条件に一致するナンバーです。<br>";
				echo "→{$replaced_result}を保存しました。<br>";
		} else {
				echo "{$credit_card}は条件に一致しないナンバーです。<br>";
		}
}
echo "<br>";