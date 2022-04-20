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
<a href="info_views.php"> Informacje ogólne</a> 
<a href="views.php"> Widoki </a> 
<a href="akt.php"> Aktualizuj</a> 
</nav>
<br>


<form class="contact-form" action="orderDetails.php" method="post">
	
		<label>
			<input class="contact-form-text" type="number" name="zamID" placeholder="Podaj id zamówienia">
		</label>
		
		<input class="contact-form-btn" type="submit" value="Wyświetl szczegóły">
	
	</form>
	<br>
<?php 
if(isset($_POST["zamID"])){
	if(($_POST["zamID"]) !=0) {
 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

$zmienna=$_POST["zamID"];

 $query = 'SELECT * FROM restauracja.podsumowanie_zamowienia('. $zmienna .')';
 $results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());

 $row = pg_fetch_all($results);
  echo "<table class='content-table' >";
  echo "<thead>";
  echo "<tr>";
  echo "<th> Imię </th>";
  echo "<th> Telefon </th>";
  echo "<th> Potrawa </th>";
  echo "<th> Ilość </th>";
  echo "<th> Suma </th>";
  echo "<th> Na Wynos </th>";

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
	}
	else
	{echo "<h4>Nie podałeś ID zamówienia.</h4>";}
}
?>
	

</body>
</html>