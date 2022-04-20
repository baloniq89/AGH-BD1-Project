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
<h2>Dodaj pozycję do MENU<h2>

 <?php if ($_SESSION['user']) : ?>
<form class="contact-form" action="add_MenuPos.php" method="post">
	

			 <input class="contact-form-text" type="text"  name="m_id" placeholder="Podaj pozycję(id) w MENU">
             <input class="contact-form-text" type="text"  name="k_id" placeholder="Podaj id kategorii">
             <input class="contact-form-text" type="text"  name="name" placeholder="Podaj nazwę potrawy">
             <input class="contact-form-text" type="text"  name="price" placeholder="Podaj cenę">

		
		<input class="contact-form-btn" type="submit" value="Dodaj do MENU" name="sub">
	
	</form>
	    <?php endif; ?>	
		
<?php 
if( isset($_POST["sub"])){
if(($_POST["m_id"]) !='' && ($_POST["k_id"])!='' && ($_POST["name"])!='' && ($_POST["price"])!=''){
	
 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

$zmienna=$_POST["m_id"];
$zmienna2=$_POST["k_id"];
$zmienna3=$_POST["name"];
$zmienna4=$_POST["price"];

 $query = "INSERT INTO restauracja.menu (pozycja_id, kategoria_id, nazwa_dania, cena) VALUES ('" .$zmienna. "','".$zmienna2."','" .$zmienna3. "','". $zmienna4. "')";
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