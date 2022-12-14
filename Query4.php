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
// View 4
$sql = "SELECT p.Name AS 'Pet Name', o2.OwnerName AS 'First Owner', YEAR(a.AdoptDate) AS Year,\n"
       ."IFNULL(a.ReturnDate, '') AS 'Return Date',\n"
       ."IFNULL(o.OwnerName, '') AS 'Second Owner',\n"
       ."IFNULL(a2.AdoptDate, '') AS 'Second Adoption Date'\n"
       ."FROM PET p\n"
       ."INNER JOIN ADOPTION a ON p.PetID = a.PetID\n"
       ."INNER JOIN OWNER o ON p.PreviousOwner = o.OwnerID\n"
       ."INNER JOIN OWNER o2 ON p.POwnerID = o2.OwnerID\n"
       ."INNER JOIN ADOPTION a2 ON p.PetID = a2.PetID AND a2.AdoptDate > a.AdoptDate\n"
       ."GROUP BY p.PetID, a.AdoptDate, a.ReturnDate, o2.OwnerName, a2.AdoptDate\n"
       ."HAVING COUNT(*) > 1\n";

if($result = mysqli_query($link, $sql)){
 if(mysqli_num_rows($result) > 0){
    echo "<table class = 'center table-dark' style = 'width:50%'>";
    echo "<caption><h2>Adopted and Returned</h2></caption>";
      echo"<thead>";
        echo"<tr>";
          echo"<th> Pet Name             </th>";
          echo"<th> First Owner          </th>";
          echo"<th> Year                 </th>";
          echo"<th> Return Date          </th>";
          echo"<th> Second Owner         </th>";
          echo"<th> Second Adoption Date </th>";
        echo"</tr>";
      echo"</thead>";
    while($row = mysqli_fetch_array($result)){
      echo"<tbody>";
        echo"<tr>";
          echo"<td>".$row['Pet Name'].            "</td>";
          echo"<td>".$row['First Owner'].         "</td>";
          echo"<td>".$row['Year'].                "</td>";
          echo"<td>".$row['Return Date'].         "</td>";
          echo"<td>".$row['Second Owner'].        "</td>";
          echo"<td>".$row['Second Adoption Date']."</td>";
        echo"</tr>";
      echo"</tbody>";
    }
 } else {
     echo "No records matching your query were found. ";
   }
} else {
    echo "ERROR: Was not able to execute sql query. ".mysqli_error($link);
  }

?>

</body>
</html>
