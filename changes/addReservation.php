<?php
$con=pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender")
			or die ("Nie mozna polaczyc sie z serwerem\n"); 
echo "Udalo sie polaczyc z serwerem";  
//$zam_id = json_encode($_POST['kid']);
$x = $_POST['kid'];
$x1 = $_POST['pos'];
$x2 = $_POST['vip'];
$x3 = $_POST['day'];
$x4 = $_POST['hour'];



$query = "SELECT restauracja.dodaj_rezerwacje($x, $x1, '$x2', '$x3', '$x4')";
//$result = pg_query($query) or die('Nie udalo sie odczytac polecenia 1' . pg_last_error());
//$array = oci_parse($con,"SELECT restauracja.dodaj_do_zamowienia('".$zam_id."','".$poz_id."','".$ilosc."');");
//oci_execute($array);
$result - pg_exec($con, $query);
if(!$result) 
{
	echo pg_last_error($con);
}
else
{
	echo "Dodano!";	
}
	
header("location: add_reservation.php");

?>