<?php
     	$link = mysqli_connect("localhost", "johnwesl","e+tS3nrbxnp6", "johnwesl_DB");
?>

<!DOCTYPE>
<html>
<head>
 <link rel="stylesheet" href="Style.css">
 <title>Furredom Friends Adoption Shelter</title>
</head>
<body>
  <h1><?php echo"Furreedom Friends Adoption Shelter "?></h1>
  <h3><?php echo "By Wesley B. Johnson "?></h3>

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
<?php
  // View 2
  $sql = "SELECT YEAR(ServiceDate) AS Year, Description, SUM(Cost) AS Total\n"
        . "FROM MEDICAL WHERE ServiceDate BETWEEN CURDATE() - INTERVAL 2 YEAR AND CURDATE()\n"
        . "GROUP BY year, Description\n"
        . "ORDER BY year ASC, Total DESC\n";

  if($result = mysqli_query($link, $sql)){
   if(mysqli_num_rows($result) > 0){
     echo "<table class = 'center table-dark' style = 'width:50%'>";
     echo "<caption><h2>Annual Service Costs</h2></caption>";
       echo"<thead>";
         echo"<tr>";
           echo"<th> Year        </th>";
           echo"<th> Description </th>";
           echo"<th> Total       </th>";
         echo"</tr>";
       echo"</thead>";
     while($row = mysqli_fetch_array($result)){
       echo"<tbody>";
         echo"<tr>";
           echo"<td>".$row['Year'].       "</td>";
           echo"<td>".$row['Description']."</td>";
           echo"<td>".$row['Total'].      "</td>";
          echo"</tr>";
        echo"</tbody>";
      }
    }
    else {
      echo "No records matching your query were found. ";
    }

  } else {
      echo "ERROR: Was not able to execute sql query. ".mysqli_error($link);
    }
?>
</body>
</html>
