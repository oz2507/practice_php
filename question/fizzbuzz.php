<?php

/**
 * 1〜100までの数字を出力してください。
 * 3の倍数の時はFizzと出力、5の倍数の時はBuzzと出力してください。
 * 3と5の倍数の時はFizzBuzzと出力してください。
 */

for ($i=1; $i < 101; $i++) { 
	if ($i % 15 == 0) {
		echo 'FizzBuzz' . PHP_EOL;
	} elseif ($i % 3 == 0) {
		echo "Fizz" . PHP_EOL;
	} elseif ($i % 5 == 0) {
		echo "Buzz" . PHP_EOL;
	} else {
		echo "$i" . PHP_EOL;
	}
}