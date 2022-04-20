<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt bazy danych</title>
	<link type="text/css" rel="stylesheet" href="../style.css" />
</head>

<body>
<header>
<h1>Restauracja</h1>
</header>
<nav>
<a href="../index.php"> Strona główna</a> 
<a href="../info_views.php"> Informacje </a> 
<a href="../views.php"> Widoki </a> 
<a href="../akt.php"> Aktualizuj</a> 
</nav>
<br>
<h2>Edytuj zniżkę<h2>


<?php 
session_start();

 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

 if(isset($_GET['u1']) AND $_GET['u1']=='Update')
 {
    $x=$_GET["z_id"];
    $x2=$_GET["kid"];
    $x3=$_GET["start"];
    $x4=$_GET["end"];
    $x5=$_GET["amount"];
 
 
 $query_update = "UPDATE restauracja.znizki SET klient_id= '".$x2."',start='" .$x3."',wygasa='".$x4."', procent_znizka='".$x5."' WHERE znizka_id = " .$x ;
 
 pg_query( $query_update) or die('Query failed: ' . pg_last_error());



 $query = "SELECT * FROM restauracja.znizki";
 $result = pg_query( $query) or die('Query failed: ' . pg_last_error());


echo "<table class='content-table'>";
 echo "<thead>";
  echo "<tr>";
  echo "<th> ID zniżki</th>";
  echo "<th> ID klienta </th>";
  echo "<th> Start </th>";
  echo "<th> End </th>";
  echo "<th> Zniżka </th>";
 	 
	  echo "</tr>";
	   echo "</thead>";
	    echo "<tbody>";
while($row = pg_fetch_row($result))
{
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "<td>" . $row[3] . "</td>";
    echo "<td>" . $row[4] . "</td>";

		echo "</tr>";

}
 echo "</tbody>";
echo '</table >';
}
else
{
	 $query = "SELECT * FROM restauracja.znizki WHERE znizka_id=" .$_GET['up1'];
     $result = pg_query( $query) or die('<h4>Błąd </h4>');
$row=pg_fetch_array($result);
?>

<br>
<form class="contact-form" action="update2_discount.php" method="GET">
	
	
		<input class="contact-form-text" type="number"  name="z_id" placeholder="Podaj id zniżki" value="<?php echo $row['znizka_id'];?>"/>
		<input class="contact-form-text" type="number"  name="kid"  placeholder="Podaj id klienta" value="<?php echo $row['klient_id'];?>"/>
		<input class="contact-form-text" type="text"  placeholder="Podaj datę rozpoczęcia zniżki" name="start" value="<?php echo $row['start'];?>"/>
        <input class="contact-form-text" type="text"  placeholder="Podaj datę zakończenia" name="end" value="<?php echo $row['wygasa'];?>"/>
        <input class="contact-form-text" type="text"  placeholder="Podaj wartość" name="amount" value="<?php echo $row['procent_znizka'];?>"/>
			 
		<input class="contact-form-btn" type="submit" name="u1" value="Update" >
	
	</form>




<?php 
}
 // Closing connection
 pg_close($con);
	


?>
	
		
	</body>
</html>