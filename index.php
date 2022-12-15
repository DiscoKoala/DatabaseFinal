
<?php
     	$link = mysqli_connect("localhost", "johnwesl","e+tS3nrbxnp6", "johnwesl_DB");
?>

<!DOCTYPE>
<html>
<head>
 <link rel="stylesheet" href="Style.css">
 <title>Furredom Friends Adoption Shelter</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1><?php echo"Furreedom Friends Adoption Shelter "?></h1>
<h3><?php echo "By Wesley B. Johnson "?></h3>

<?php
  if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  };
?>
<ul>
  <li><a href="index.php" target="_self">Home</a></li>
  <li><a href="Query1.php" target="_self">Query 1</a></li>
  <li><a href="Query2.php" target="_self">Query 2</a></li>
  <li><a href="Query3.php" target="_self">Query 3</a></li>
  <li><a href="Query4.php" target="_self">Query 4</a></li>
  <li><a href="Query5.php" target="_self">Query 5</a></li>
  <li><a href="Query6.php" target="_self">Query 6</a></li>
  <li><a href="Query7.php" target="_self">Query 7</a></li>
</ul><br>

<h2>Furry Friend Success Stories</h2><br>

<ins><h3>Miss Posie Keen</h3></ins>
<img src="Posie.jpg" alt="Posie" width="900" height="650"><br>

<ins><h3>Theo Delaire</h3></ins>
<img src="Theo.jpg" alt="Theo" width="900" height="1100"><br>

<ins><h3>Namoo Jeong</h3></ins>
<img src="Namoo.jpg" alt="Namoo" width="900" height="1200"><br>


</body>
</html>
