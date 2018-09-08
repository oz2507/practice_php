<?php

/**
 * 1〜100までの数字を出力してください。
 * 3の倍数の時はFizzと出力、5の倍数の時はBuzzと出力してください。
 * 3と5の倍数の時はFizzBuzzと出力してください。
 */

for ($i = 1; $i <= 100; $i++) { 
  if ($i % 15 === 0) {
    echo 'fizzbuzz';
  } elseif ($i % 3 === 0) {
    echo 'fizz';
  } elseif ($i % 5 === 0) {
    echo 'buzz';
  } else {
    echo $i;
  }
}