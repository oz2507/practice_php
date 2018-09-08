<?php

session_start();

echo "{$_SESSION['name']}さん" . '<br>';
echo $_SESSION['location'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>確認画面</title>
</head>
<body>
	<a href="shopping.php">戻って確認</a>
</body>
</html>