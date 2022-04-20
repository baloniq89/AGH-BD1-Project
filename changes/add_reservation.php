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
<h2>Dodaj rezerwację<h2>

 <?php if ($_SESSION['user']) : ?>
<form class="contact-form" action="addReservation.php" method="post">
	

			 <input class="contact-form-text" type="text"  name="kid" placeholder="Podaj id klienta">
             <input class="contact-form-text" type="text"  name="pos" placeholder="Podaj ilość osób ">
             <input class="contact-form-text" type="text"  name="vip" placeholder="Podaj czy rezerwacja na stolik VIP">
             <input class="contact-form-text" type="text"  name="day" placeholder="Podaj dzień (YYYY-MM-DD)">
             <input class="contact-form-text" type="text"  name="hour" placeholder="Podaj godzinę (np. 17:45)">
             <input class="contact-form-btn" type="submit" value="Dodaj rezerwację" name="sub">
	
</form>
<?php endif; ?>	

		
	</body>
</html>