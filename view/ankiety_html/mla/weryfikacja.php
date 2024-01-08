<?php
include ('head.php');
	
	#weryfikacja danych formularza
	
	#deklaracja zmiennych
	  $rok_ukonczenia=$_POST['rok_ukonczenia'];
	  $kierunek=$_POST['kierunek'];
	  $typ_studiow=$_POST['typ_studiow'];
	  $rodzaj_studiow=$_POST['rodzaj_studiow'];
	  $specjalnosc=$_POST['specjalnosc'];
	  $pyt_4=$_POST['pyt_4'];
          $pyt_6_=$_POST['pyt_4'];
	  $pyt_5=$_POST['pyt_5'];
          $pyt_7_=$_POST['pyt_5'];
	  $pyt_6=$_POST['pyt_6'];
	  $pyt_7=$_POST['pyt_7'];
	  $pyt_8=$_POST['pyt_8'];
	  $pyt_9=$_POST['pyt_9'];
	  $pyt_10=$_POST['pyt_10'];
	  $pyt_11=$_POST['pyt_11'];
	  $pyt_12=$_POST['pyt_12'];
	  $pyt_13=$_POST['pyt_13'];
	  $pyt_14a=$_POST['pyt_14a'];
	  $pyt_14b=$_POST['pyt_14b'];
	  $pyt_14c=$_POST['pyt_14c'];
	  $pyt_14d=$_POST['pyt_14d'];
	  $pyt_14e=$_POST['pyt_14e'];
	  $pyt_15=$_POST['pyt_15'];
	  $pyt_16=$_POST['pyt_16'];
	  $pyt_17=$_POST['pyt_17'];
	  $pyt_18=$_POST['pyt_18'];
	  $pyt_19=$_POST['pyt_19'];
	  $pyt_20=$_POST['pyt_20'];
	  $pyt_21=$_POST['pyt_21'];
	  $pyt_22=$_POST['pyt_22'];
	  $pyt_23=$_POST['pyt_23'];
	  $pyt_24a=$_POST['pyt_24a'];
	  $pyt_24b=$_POST['pyt_24b'];
	  $pyt_24c=$_POST['pyt_24c'];
	  $pyt_24d=$_POST['pyt_24d'];
	  $pyt_24e=$_POST['pyt_24e'];
	  $pyt_24f=$_POST['pyt_24f'];
	  $pyt_24g=$_POST['pyt_24g'];
	  $pyt_24h=$_POST['pyt_24h'];
	  $pyt_24i=$_POST['pyt_24i'];
	  $pyt_24j=$_POST['pyt_24j'];
	  $pyt_25=$_POST['pyt_25'];
	  $pyt_26=$_POST['pyt_26'];
	  $pyt_27=$_POST['pyt_27'];
	  $pyt_28=$_POST['pyt_28'];
	  $pyt_29=$_POST['pyt_29'];
	  $pyt_30=$_POST['pyt_30'];
	  $pyt_31=$_POST['pyt_31'];
	  $pyt_32=$_POST['pyt_32'];
	  $plec=$_POST['pyt_33'];
	  $wiek=$_POST['pyt_34'];
	  $mce_zamieszkania=$_POST['pyt_35'];
	  $nr_telefonu=$_POST['telefon'];
	  $email=$_POST['email'];
	  $data_wypelnienia=$_POST['data_wypelnienia'];
	  echo $data_wypelnienia;
	#koniec deklaracji zmiennych
  # warunek, ze jeżeli 20 jest "zatrudniony", to 21 nie może być "nie dotyczy" i na odwrót
  	  
  	  if ($pyt_18=='jestem zatrudniony/a' || $pyt_18=='prowadzę własną działalność') $zatrudniony=1;
  	  	else $zatrudniony=0;
  	 # echo $zatrudniony;
  	 if ($zatrudniony=='0') {
  	 	$pyt_20='nie dotyczy, nie jestem zatrudniony/a';
  	 	$pyt_19='nie dotyczy, nie jestem zatrudniony/a';
  	 		echo 'zostały zmienione odpowiedzi na pytanie 21 i 22 na \"nie dotyczy, nie jestem zatrudniony/a\"';
  	 	}
  	 if (($zatrudniony=='1' && $pyt_19=='nie dotyczy, nie jestem zatrudniony/a') || ($zatrudniony=='1' && $pyt_20=='nie dotyczy, nie jestem zatrudniony/a')) 
  	  die ("
  		 <script type=\"text/javascript\">
//<!--
alert(\"Informacje sprzeczne. Popraw odpowiedzi na pytanie 21, lub 22\");
history.back();
//--></script>
");
  	 
  	 else 
  	 #echo "Jest OK";
  	
  # warunek, że jeżeli pytanie 17 jest "zakończyłem edukację, to pytanie 18 musi być nie dotyczy, nie kontynuowałem edukacji
  	#echo $pyt_15;
  	#echo "<br/>";
  	#echo $pyt_16;
  	if ($pyt_15=='zakończyłem edukację') $pyt_16='nie dotyczy, nie kontynuowałem edukacji'  ;
  		else
  		 if ($pyt_15!='zakończyłem edukację'&& $pyt_16=='nie dotyczy, nie kontynuowałem edukacji') 
  		 die ("
  		 <script type=\"text/javascript\">
//<!--
alert(\"Informacje sprzeczne. Popraw odpowiedzi na pytanie 17, lub 18\");
history.back();
//--></script>
");
  		 
  		
  	# echo "Jest OK";
  # koniec warunków - update bazy danych
  	# połączenie z MySQL
          include('config.php');
  	  include ('konekt.php');
  $sql="INSERT INTO `ankieta` (`rok_ukonczenia`,`rodzaj_studiow`,`typ_studiow`,`kierunek_studiow`,`specjalnosc`,`pyt_6_`,`pyt_7_`,`pyt_8_`,`pyt_9_`,`pyt_10_`,`pyt_11_`,`pyt_12_`,`pyt_13_`,
`pyt_14_`,`pyt_15_`,`pyt_15a_`,`pyt_15b_`,`pyt_15c_`,`pyt_15d_`,`pyt_15e_`,`pyt_16_`,`pyt_17_`,`pyt_18_`,`pyt_19_`,`pyt_20_`,`pyt_21_`,`pyt_22_`,
 `pyt_23_`,`pyt_24_`,`pyt_24a_`,`PYT_26b_`,`PYT_26c_`,`pyt_24d`,`pyt_24e`,`pyt_24f`,`pyt_24g`,`pyt_24h`,`pyt_24i`,`pyt_24j`,`pyt_25_`,
`pyt_26_`,`pyt_27_`,`pyt_28_`,`pyt_29_`,`pyt_30_`,`pyt_31_`,`pyt_32_`,`plec_`,`wiek_`,`mce_zamieszkania_`,`nr_telefonu`,`email`,`data`) VALUES  
('$rok_ukonczenia','$rodzaj_studiow','$typ_studiow','$kierunek','$specjalnosc','$pyt_6_','$pyt_7_','$pyt_6','$pyt_7','$pyt_8', 	  
'$pyt_9','$pyt_10','$pyt_11','$pyt_12','$pyt_13','$pyt_14a','$pyt_14b','$pyt_14c','$pyt_14d','$pyt_14e','$pyt_15','$pyt_16','$pyt_17',
'$pyt_18','$pyt_19','$pyt_20', '$pyt_21','$pyt_22', '$pyt_23','$pyt_24a','$pyt_24b','$pyt_24c','$pyt_24d','$pyt_24e','$pyt_24f',
'$pyt_24g','$pyt_24h','$pyt_24i','$pyt_24j','$pyt_25','$pyt_26', '$pyt_27','$pyt_28', '$pyt_29', '$pyt_30','$pyt_31','$pyt_32','$plec',
'$wiek','$mce_zamieszkania','$nr_telefonu','$email','$data_wypelnienia');";
//echo $sql;
mysqli_query($kon,$sql);
?>

<script type="text/javascript">
//<!--
alert("Bardzo dziękujemy za wypełnienie ankiety");
//--></script>
<html><head><meta http-equiv="refresh" content="0; URL=http://wseiz.pl"></head></html>

  	  
	  
