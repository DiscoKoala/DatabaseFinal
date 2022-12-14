
<?php
     	$link = mysqli_connect("localhost", "johnwesl","e+tS3nrbxnp6", "johnwesl_DB");
?>

<!DOCTYPE>
<html>
<head>

<title>Furredom Friends Adoption Shelter</title>
</head>
<body>
<h1><?php echo"Furreedom Friends Adoption Shelter "?></h1>
<h3><?php echo "By Wesley B. Johnson "?></h3>
<a href="Query1.php" title="Go to query 1"></a>
<?php
  if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  };
?>

<?php
  // View 1
  $sql = "SELECT DISTINCT PET.Name AS 'Pet Name', MEDICAL.Description AS 'Medical Service',\n"
         . "MEDICAL.ServiceDate AS 'Service Date'\n"
         . "FROM PET INNER JOIN MEDICAL ON PET.PetID = MEDICAL.MPetID\n"
         . "ORDER BY PET.Name, MEDICAL.ServiceDate DESC\n";

  if($result = mysqli_query($link, $sql)){
   if(mysqli_num_rows($result) > 0){
     echo "<table class = 'center table-dark' style = 'width:50%'>";
     echo "<caption><h2>Pet Medical Services</h2></caption>";
       echo"<thead>";
         echo"<tr>";
           echo"<th> Pet Name        </th>";
           echo"<th> Medical Service </th>";
           echo"<th> Service Date    </th>";
         echo"</tr>";
       echo"</thead>";
     while($row = mysqli_fetch_array($result)){
       echo"<tbody>";
         echo"<tr>";
           echo"<td>".$row['Pet Name'].       "</td>";
           echo"<td>".$row['Medical Service']."</td>";
           echo"<td>".$row['Service Date'].   "</td>";
         echo"</tr>";
       echo"</tbody>";
     }

    } else {
        echo "No records matching your query were found. ";
      }

    } else {
    echo "ERROR: Was not able to execute sql query. ".mysqli_error($link);
      }

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

// View 3
$sql = "SELECT p.Name, TIMESTAMPDIFF(DAY, p.ArrivalDate, CURDATE()) AS 'Days at Shelter'\n"
       ."FROM PET p LEFT JOIN ADOPTION a ON p.PetID = a.PetID\n"
       ."WHERE a.AdoptDate is NULL\n";

 if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){
    echo "<table class = 'center table-dark' style = 'width:50%'>";
    echo "<caption><h2>Annual Service Costs</h2></caption>";
      echo"<thead>";
        echo"<tr>";
          echo"<th> Name        </th>";
          echo"<th> Days at Shelter </th>";
        echo"</tr>";
      echo"</thead>";
    while($row = mysqli_fetch_array($result)){
      echo"<tbody>";
        echo"<tr>";
          echo"<td>".$row['Name'].       "</td>";
          echo"<td>".$row['Days at Shelter']."</td>";
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

// View 5
$sql = "SELECT DISTINCT p.Name AS 'Pet Name', p.BirthDate AS 'Birth Date', p.Species, p.Age, p.Condition\n"
       ."FROM  ADOPTION a\n"
       ."INNER JOIN PET p ON a.PetID = p.PetID\n"
       ."WHERE a.AdoptStatus = 'Adopted'\n"
       ."ORDER BY p.Species, p.Age DESC\n";

if($result = mysqli_query($link, $sql)){
 if(mysqli_num_rows($result) > 0){
   echo "<table class = 'center table-dark' style = 'width:50%'>";
   echo "<caption><h2>Age and Condition of Adopted Pets</h2></caption>";
     echo"<thead>";
       echo"<tr>";
         echo"<th> Pet Name   </th>";
         echo"<th> Birth Date </th>";
         echo"<th> Species    </th>";
         echo"<th> Age        </th>";
         echo"<th> Condition  </th>";
       echo"</tr>";
       echo"</thead>";
     while($row = mysqli_fetch_array($result)){
       echo"<tbody>";
         echo"<tr>";
           echo"<td>".$row['Pet Name'].  "</td>";
           echo"<td>".$row['Birth Date']."</td>";
           echo"<td>".$row['Species'].   "</td>";
           echo"<td>".$row['Age'].       "</td>";
           echo"<td>".$row['Condition']. "</td>";
         echo"</tr>";
       echo"</tbody>";
     }
    } else {
        echo "No records matching your query were found. ";
      }
  } else {
      echo "ERROR: Was not able to execute sql query. ".mysqli_error($link);
    }

// View 6
$sql = "SELECT DISTINCT p.Name AS 'Pet Name', p.Species, p.Age, p.Size, p.Breed, o.OwnerName AS 'Potential Match'\n"
       ."FROM OWNER o\n"
       ."INNER JOIN PREFERENCES pr ON o.OwnerID = pr.POwnerID\n"
       ."INNER JOIN PET p ON p.Species = pr.PSpecies\n"
       ."WHERE o.OwnerPetID IS NULL\n"
       ."AND (p.Species = pr.PSpecies OR p.Age = pr.PAge OR p.Size = pr.PSize OR p.Breed = pr.PBreed)\n"
       ."ORDER BY p.Name\n";

if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){
   echo "<table class = 'center table-dark' style = 'width:50%'>";
    echo "<caption><h2>Age and Condition of Adopted Pets</h2></caption>";
      echo"<thead>";
        echo"<tr>";
          echo"<th> Pet Name        </th>";
          echo"<th> Species         </th>";
          echo"<th> Age             </th>";
          echo"<th> Size            </th>";
          echo"<th> Breed           </th>";
          echo"<th> Potential Match </th>";
        echo"</tr>";
      echo"</thead>";
      while($row = mysqli_fetch_array($result)){
        echo"<tbody>";
          echo"<tr>";
            echo"<td>".$row['Pet Name'].        "</td>";
            echo"<td>".$row['Species'].         "</td>";
            echo"<td>".$row['Age'].             "</td>";
            echo"<td>".$row['Size'].            "</td>";
            echo"<td>".$row['Breed'].           "</td>";
            echo"<td>".$row['Potential Match']. "</td>";
          echo"</tr>";
        echo"</tbody>";
      }
     } else {
         echo "No records matching your query were found. ";
       }
   } else {
       echo "ERROR: Was not able to execute sql query. ".mysqli_error($link);
     }

// View 7
$sql = "SELECT p.Breed, (COUNT(a.PetID) / (SELECT COUNT(*) FROM ADOPTION))*100 AS 'Adoption Rate'\n"
       ."FROM PET p\n"
       ."INNER JOIN ADOPTION a ON p.PetID = a.PetID\n"
       ."WHERE a.AdoptStatus = 'Adopted'\n"
       ."GROUP BY p.Breed\n"
       ."ORDER BY 'Adoption Rate' DESC\n"
       ."LIMIT 1\n";

if($result = mysqli_query($link, $sql)){
 if(mysqli_num_rows($result) > 0){
  echo "<table class = 'center table-dark' style = 'width:50%'>";
   echo "<caption><h2>Most Popular Breed</h2></caption>";
     echo"<thead>";
       echo"<tr>";
         echo"<th> Breed         </th>";
         echo"<th> Adoption rate </th>";
       echo"</tr>";
     echo"</thead>";
     while($row = mysqli_fetch_array($result)){
       echo"<tbody>";
         echo"<tr>";
           echo"<td>".$row['Breed'].        "</td>";
           echo"<td>".$row['Adoption Rate']."</td>";
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
