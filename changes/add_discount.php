<?php
session_start();
?>

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
<h2>Dodaj zniżke<h2>

 <?php if ($_SESSION['user']) : ?>
<form class="contact-form" action="add_discount.php" method="post">
	
             <input class="contact-form-text" type="text"  name="z_id" placeholder="Podaj id zniżki">
			 <input class="contact-form-text" type="text"  name="kid" placeholder="Podaj id klienta">
             <input class="contact-form-text" type="text"  name="start" placeholder="Podaj datę rozpoczęcia promocji">
             <input class="contact-form-text" type="text"  name="end" placeholder="Podaj datę zakończenia promocji">
             <input class="contact-form-text" type="text"  name="amount" placeholder="Podaj wysokość zniżki (wartość od 0 do 1)">

		
		<input class="contact-form-btn" type="submit" value="Dodaj zniżkę" name="sub">
	
	</form>
	    <?php endif; ?>	
		
<?php 
if( isset($_POST["sub"])){
if(($_POST["kid"]) !='' && ($_POST["z_id"])!='' && ($_POST["start"])!='' && ($_POST["end"])!='' && ($_POST["amount"])!=''){
	
 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

$x=$_POST["z_id"];
$x2=$_POST["kid"];
$x3=$_POST["start"];
$x4=$_POST["end"];
$x5=$_POST["amount"];

 $query = "INSERT INTO restauracja.znizki(znizka_id, klient_id,start , wygasa, procent_znizka) VALUES ('" .$x. "','".$x2."','" .$x3. "','". $x4. "', '".$x5."')";
 pg_query( $query) or die('<h4>Query failed: ' . pg_last_error().'</h4>');


 
  echo "<h4>Dodano</h4>";
 // Closing connection
 pg_close($con);
	
}
else
{
	echo "<h4>Podaj wszystkie dobre wartości</h4>";
}
}


?>
	
		
	</body>
</html>