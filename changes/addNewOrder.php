<?php
$con=pg_connect("host=localhost dbname=u9balawender user=u9balawender password=9balawender")
			or die ("Nie mozna polaczyc sie z serwerem\n"); 
echo "Udalo sie polaczyc z serwerem";  
//$zam_id = json_encode($_POST['kid']);
$zam_id = $_POST['kid'];

print_r($zam_id);
//$poz_id = json_encode($_POST['pos']);
$poz_id = $_POST['takeout'];


//$ilosc = json_encode($_POST['count']);

$ilosc = $_POST['dateDay'];


$query = "SELECT restauracja.dodaj_zamowienie($zam_id, '$poz_id', '$ilosc')";
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
	
//header("location:add_order.php");

?>