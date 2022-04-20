<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt bazy danych</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<body>

<header>
<h1>Restauracja</h1>
</header>
<nav>
<a href="index.php"> Strona główna</a> 
<a href="info_views.php"> Informacje</a> 
<a href="views.php"> Widoki</a> 
<a href="akt.php"> Aktualizuj</a> 
</nav>
<br>
<h2>Rezerwacje VIP<h2>
<br>
<?php

// Open a PostgreSQL connection
$con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");



$query = 'SELECT * FROM restauracja.wykaz_rezerwacji_vip';
$results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());

$row = pg_fetch_all($results);
 echo "<table class='content-table' >";
  echo "<thead>";
 echo "<tr>";
 echo "<th> ID rezerwacji </th>";
 echo "<th> Imię </th>";
 echo "<th> ID stolika </th>";
 echo "<th> Data </th>";
 echo "<th> Godzina </th>";
 echo "<th> Ilość osób </th>";

echo "</tr>";
echo "</thead>";
 echo "<tbody>";
foreach($row as $it)
{
    echo "<tr>";
    foreach($it as $i){

    
echo "<td>" .$i . "</td>" ;

    }
     echo "</tr>";
}
 echo "</tbody>";
 echo "</table>";
// Closing connection
pg_close($con);

?>
   

</body>
</html>