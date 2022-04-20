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
<h2>Usuń stolik<h2>

<?php
session_start();
if($_SESSION['user']) {
$con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");


if(isset($_GET['s1']))
{
pg_query( "DELETE FROM restauracja.stolik  WHERE stolik_id=$_GET[del]") or die('<h4>Błąd </h4>');
}
 $query = "SELECT * FROM restauracja.stolik";
 $result = pg_query( $query) or die('Query failed: ' . pg_last_error());

echo '<form action="delete_table.php" method="GET">';
echo "<table class='content-table'>";
 echo "<thead>";
  echo "<tr>";
  echo "<th> ID </th>";
  echo "<th> Pojemność </th>";
  echo "<th> VIP </th>";
 	echo "<th><input class='contact-form-btn' type=submit name=s1 value='Usuń stolik'></th>";	 
	  echo "</tr>";
	   echo "</thead>";
	    echo "<tbody>";
while($row = pg_fetch_row($result))
{
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "<td><input type=radio name=del value=" . $row[0] . "></td>";	
		echo "</tr>";

}
 echo "</tbody>";
echo '</table >';
echo '</form>';

 // Closing connection
 pg_close($con);

}
?>
	
		
	</body>
</html>