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
<h2>Edytuj klienta<h2>


<?php 
session_start();

 // Open a PostgreSQL connection
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");

 if(isset($_GET['u1']) AND $_GET['u1']=='Update')
 {
 $zmienna=$_GET["id"];
 $zmienna1=$_GET["name"];
 $zmienna2=$_GET["phone"];
 $zmienna3=$_GET["email"];
 
 
 $query_update = "UPDATE restauracja.klienci SET imie= '".$zmienna1."',telefon='" .$zmienna2."',email='".$zmienna3."' WHERE klient_id = " .$zmienna ;
 
 pg_query( $query_update) or die('Query failed: ' . pg_last_error());



 $query = "SELECT * FROM restauracja.klienci";
 $result = pg_query( $query) or die('Query failed: ' . pg_last_error());


echo "<table class='content-table'>";
 echo "<thead>";
  echo "<tr>";
  echo "<th> ID </th>";
  echo "<th> Imię </th>";
  echo "<th> Telefon </th>";
  echo "<th> Email </th>";
 	 
	  echo "</tr>";
	   echo "</thead>";
	    echo "<tbody>";
while($row = pg_fetch_row($result))
{
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "<td>" . $row[3] . "</td>";

		echo "</tr>";

}
 echo "</tbody>";
echo '</table >';
}
else
{
	 $query = "SELECT * FROM restauracja.klienci WHERE klient_id=" .$_GET['up1'];
     $result = pg_query( $query) or die('<h4>Błąd </h4>');
$row=pg_fetch_array($result);
?>

<br>
<form class="contact-form" action="update2_client.php" method="GET">
	
	
		<input class="contact-form-text" type="number" min="1" placeholder="ID klienta" name="id" value="<?php echo $row['klient_id'];?>"/>
		<input class="contact-form-text" type="text"  name="name"  placeholder="Podaj imie" value="<?php echo $row['imie'];?>"/>
		<input class="contact-form-text" type="text"  placeholder="Podaj telefon" name="phone" value="<?php echo $row['telefon'];?>"/>
        <input class="contact-form-text" type="text"  placeholder="Podaj email" name="email" value="<?php echo $row['email'];?>"/>
			 
		<input class="contact-form-btn" type="submit" name="u1" value="Update" >
	
	</form>




<?php 
}
 // Closing connection
 pg_close($con);
	


?>
	
		
	</body>
</html>