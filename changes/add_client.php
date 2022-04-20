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
<h2>Dodaj klienta<h2>

 <?php if ($_SESSION['user']) : ?>
<form class="contact-form" action="add_client.php" method="post">
	

			 <input class="contact-form-text" type="text"  name="kid" placeholder="Podaj id klienta">
             <input class="contact-form-text" type="text"  name="name" placeholder="Podaj imie">
             <input class="contact-form-text" type="text"  name="phone" placeholder="Podaj telefon">
             <input class="contact-form-text" type="text"  name="email" placeholder="Podaj email">

		
		<input class="contact-form-btn" type="submit" value="Dodaj klienta" name="sub">
	
	</form>
	    <?php endif; ?>	
		
<?php 
if( isset($_POST["sub"])){
if(($_POST["kid"]) !='' && ($_POST["name"])!='' && ($_POST["phone"])!='' && ($_POST["email"])!=''){
	
 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

$zmienna=$_POST["kid"];
$zmienna2=$_POST["name"];
$zmienna3=$_POST["phone"];
$zmienna4=$_POST["email"];

 $query = "INSERT INTO restauracja.klienci (klient_id, imie, telefon, email) VALUES ('" .$zmienna. "','".$zmienna2."','" .$zmienna3. "','". $zmienna4. "')";
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