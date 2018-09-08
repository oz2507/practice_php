<!DOCTYPE html>
<html>
  <head>
	  <title>九九</title>
	  <meta charset="utf-8">
  </head>
  <body>
    <table border="1">
	    <?php for ($i = 1; $i <= 9; $i++) : ?>
		  	<tr>
			  	<?php for ($j = 1; $j <= 9; $j++) : ?>
		      	<td><?php echo $i * $j ?></td>
		    	<?php endfor ?>
	    	</tr>
	    <?php endfor ?>
		</table>
	</body>
</html>