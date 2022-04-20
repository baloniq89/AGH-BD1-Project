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
<h2>Edytuj stolik<h2>


<?php 
session_start();

 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

 if(isset($_GET['u1']) AND $_GET['u1']=='Update')
 {
 $zmienna=$_GET["id"];
 $zmienna1=$_GET["count"];
 $zmienna2=$_GET["vip"];
 
 
 
 $query_update = "UPDATE restauracja.stolik SET ilosc_osob= '".$zmienna1."',czy_vip='" .$zmienna2."' WHERE stolik_id = " .$zmienna ;
 
 pg_query( $query_update) or die('Query failed: ' . pg_last_error());



 $query = "SELECT * FROM restauracja.stolik";
 $result = pg_query( $query) or die('Query failed: ' . pg_last_error());


echo "<table class='content-table'>";
 echo "<thead>";
  echo "<tr>";
  echo "<th> ID </th>";
  echo "<th> Pojemność </th>";
  echo "<th> Czy VIP </th>";
 	 
	  echo "</tr>";
	   echo "</thead>";
	    echo "<tbody>";
while($row = pg_fetch_row($result))
{
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";

		echo "</tr>";

}
 echo "</tbody>";
echo '</table >';
}
else
{
	 $query = "SELECT * FROM restauracja.stolik WHERE stolik_id=" .$_GET['up1'];
     $result = pg_query( $query) or die('<h4>Błąd </h4>');
$row=pg_fetch_array($result);
?>

<br>
<form class="contact-form" action="update2_table.php" method="GET">
	
	
		<input class="contact-form-text" type="number" min="1" placeholder="ID klienta" name="id" value="<?php echo $row['stolik_id'];?>"/>
		<input class="contact-form-text" type="text"  name="count"  placeholder="Podaj pojemność stolika" value="<?php echo $row['ilosc_osob'];?>"/>
		<input class="contact-form-text" type="text"  placeholder="Podaj czy VIP" name="vip" value="<?php echo $row['czy_vip'];?>"/>
			 
		<input class="contact-form-btn" type="submit" name="u1" value="Update" >
	
	</form>




<?php 
}
 // Closing connection
 pg_close($con);
	


?>
	
		
	</body>
</html>