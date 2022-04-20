<?php

session_start();
?>

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

<?php if ($_SESSION['user']) : ?>
<a href="views.php"> Widoki </a> 
<a href="akt.php"> Aktualizuj</a> 
<?php endif; ?>	
</nav>
<br>
<h2>Informacje </h2>
<h4>Dostępne bazy: klienci, zamowienia, typZamowienia, szczegolyZamowienia, rezerwacja,stolik_rezerwacja, stolik, znizki, menu, kategorie  </h4>
<h4>Ewentualnie dostępne widoki: obecne_menu (reszta widoków będzie dostępna po zalogowaniu) </h4>
<form class="contact-form" action="info_views.php" method="post">
	
		
			 <input class="contact-form-text" type="text" name="baza" placeholder="Podaj baze/widok">
		
		
		<input  class="contact-form-btn" type="submit" value="Pokaż ">
	
	</form>
	<br>
<?php 
if(isset($_POST["baza"])){
	if(($_POST["baza"])=='klienci' || ($_POST["baza"])=='zamowienia' || ($_POST["baza"])=='typZamowienia' || ($_POST["baza"])=='rezerwacja' || ($_POST["baza"])=='stolik_rezerwacja' || ($_POST["baza"])=='stolik' || ($_POST["baza"])=='his_klientow' || ($_POST["baza"])=='znizki' ||  ($_POST["baza"])=='szczegolyZamowienia' || ($_POST["baza"])=='menu' || ($_POST["baza"])=='kategorie' || ($_POST["baza"])=='obecne_menu'){
 // Open a PostgreSQL connection
 //$con = pg_connect("host=tyke.db.elephantsql.com dbname=ygqdzncf user=ygqdzncf password=yPaF__FJzaRZG7N7qQajaGpWQTR-22p0");
 $con = pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender");
$zmienna=$_POST["baza"];

 $query = 'SELECT * FROM restauracja.' .$zmienna;
 $results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());

 $row = pg_fetch_all($results);
  echo "<table class='content-table' >";
  echo "<thead>";
  echo "<tr>";
$k=1;
 foreach($row as $it)
 {
	 
	 $i = 0;
	 if($k==1){
	 for(;$i < count($it) ;){

	$fieldname = pg_field_name($results, ($i));
	
	
		
			
				
					if($fieldname){
						
     echo  "<td>" . $fieldname . "</td>"; 
	 
				}
	
	
	 
$i=$i+1;
	 }}
 $k++;
}

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
	{echo "<h4>Podaj odpowiednią bazę/widok.</h4>";}
}
?>
	

</body>
</html>
