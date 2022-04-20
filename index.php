<?php

session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt bazy danych</title>

<link rel="stylesheet" href="style.css" />
</head>

<body>
<header>
<h1>Restauracja</h1>
</header>
<nav>
<a href="index.php"> Strona główna</a> 
<a href="info_views.php"> Informacje </a> 
</nav>
<br><br>
    <?php if (empty($_SESSION['user'])) : ?>
<br><br>


    <form class="box"  action="login.php" method="post">
	<h1>LOGOWANIE</h1>
      <input type="text" name="login" value="admin" placeholder="Login"/> 

      <input type="password" name="password" value="password" placeholder="Haslo"/>

      <input type="submit" name="" value="Zaloguj się">
    </form>
    <?php else : ?>
<nav>
        <a href="views.php"> Widoki </a> 
        <a href="akt.php"> Aktualizuj</a> <br><br><br><br>
        <a href="logout.php">Wyloguj</a>
</nav>
    <?php endif; ?>	

</body>
</html>