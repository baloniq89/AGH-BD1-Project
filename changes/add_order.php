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
<h2>Dodaj zamówienie<h2>

 <?php if ($_SESSION['user']) : ?>
<form class="contact-form" action="addNewOrder.php" method="post">
	

			 <input class="contact-form-text" type="text"  name="kid" placeholder="Podaj id klienta">
             <input class="contact-form-text" type="text"  name="takeout" placeholder="Podaj czy na wynos :yes lub no ">
             <input class="contact-form-text" type="text"  name="dateDay" placeholder="Podaj datę odbioru">
             <input class="contact-form-btn" type="submit" value="Dodaj zamówienie" name="sub">
	
</form>
<?php endif; ?>	

		
	</body>
</html>