#!/usr/bin/php -q
<?php 
#############################################################################
#     Wysyłka odpowiednio sformatowanej ankiety do absolwentów		    #
#      (c) Wojtas 2012                                                      #
#############################################################################
#TU konfigurujesz ścieżkę/adres skryptu
$sciezka="https://ankiety.wseiz.pl/mla";

include ('konekt.php');
# ustawienie daty zgodnie z logiką PiP NET-u
$dzisiaj=date('Y-m-d');
$ankieta_3=$dzisiaj-30000;
$ankieta_5=$dzisiaj-50000;
#echo $dzisiaj;
#echo "<br/>$ankieta_3";
#echo "<br/>$ankieta_5";
#$sql_3="SELECT * FROM `absolwenci` WHERE `data_obrony`>'20090100' AND `data_obrony`<'20091018'";
#$sql_5="SELECT * FROM `absolwenci` WHERE `data_obrony`>'20070100' AND `data_obrony`<'20071018'";


$sql_3="SELECT * FROM `absolwenci` WHERE `data_obrony`='$ankieta_3'";

$sql_5="SELECT * FROM `absolwenci` WHERE `data_obrony`='$ankieta_5'";


#-------------------------------------------------------------------------------------------------------
#Wysyłka ankiety dla absolwentów, którzy ukończyli 5 lat temu
$query=mysql_query($sql_5);
$ilwierszy=mysql_num_rows($query);
$j=0;
do {
	$j=$j+1;
	$wynik=mysql_fetch_array($query);
		if ($wynik[5]=='Ochrona ?rodowiska') $kierunek='OS';
		if ($wynik[5]=='Informatyka i Ekonometria') $kierunek='IiE';
		if ($wynik[5]=='Budownictwo') $kierunek='Bud';
		if ($wynik[5]=='Zarzšdzanie i In?ynieria Produkcji') $kierunek='ZiP';
		if ($wynik[5]=='Architektura i Urbanistyka') $kierunek='AiU';
		if ($wynik[5]=='Architektura Wn?trz') $kierunek='AW';
		if ($wynik[5]=='Architektura Krajobrazu') $kierunek='AK';
		if ($wynik[5]=='Architektura') $kierunek='A';
		if ($wynik[5]=='Wzornictwo') $kierunek='Wz';
		if ($wynik[5]=='Zarzšdzanie i Marketing') $kierunek='ZiM';
		if ($wynik[5]=='Zarzšdzanie') $kierunek='Z';
		if ($wynik[5]=='Zdrowie Publiczne') $kierunek='ZP';
		if ($wynik[5]=='Edukacja Techniczno-Informatyczna') $kierunek='ETI';
		if ($wynik[5]=='Mechanika i Budowa Maszyn') $kierunek='MiBM';
		
	$rodzaj_studiow=explode(" ",$wynik[6]);
	$rodzaj=$rodzaj_studiow[0];
	if ($rodzaj=='I') $rodzaj="Istopnia" ;
		else $rodzaj="IIstopnia";
	$data_o=$wynik[3];
	$rok="$data_o[0]$data_o[1]$data_o[2]$data_o[3]";
	$link="$sciezka/index.php?rok=$rok&kierunek=$kierunek&rodzaj=$rodzaj";
#	echo "$wynik[4], $link <br/>";
	# [3] - data obrony, [4] - email, [5] - kierunek studiów, [6] - rodzaj studiów

		#Utworzenie maila
		$naglowek="From: biurokarier@wseiz.pl".PHP_EOL."Reply-To: biurokarier@wseiz.pl".PHP_EOL."Content-type: text/html; charset=UTF-8";
		$temat="Badanie losów zawodowych absolwentów WSEiZ";
		$wiadomosc="
			<p><b>Droga Absolwentko, Drogi Absolwencie Wyższej Szkoły Ekologii i Zarządzania !</b></p>
<p>
Zwracamy się do Ciebie z prośbą o wypełnienie ankiety, znajdującej sie pod poniższym linkiem:<br/>
<a href=\"$link\">Badanie losów zawodowych absolwentów WSEiZ - Ankieta</a> <br/>
Ankieta pozwoli nam poznać Twoją opinię na temat kształcenia w naszej Uczelni, poznać Twoje dalsze losy zawodowe oraz plany edukacyjne.</p>
<p>
Dzięki udzielonym przez Ciebie odpowiedziom dowiemy się jak oceniasz zaproponowany przez nas program kształcenia, stopień przygotowania do pracy zawodowej i kompetencje opanowane w toku kształcenia. Dowiemy się również, co sądzisz na temat jakości pracy kadry naukowo-dydaktycznej, obsługi administracyjnej, bazy lokalowo-sprzętowej.
Twoje opinie pomogą nam wyznaczyć kierunek ewentualnych zmian, którym powinniśmy podążać, aby zaproponowana koncepcja i proces kształcenia były jeszcze bardziej efektywne i w pełni dostosowane do potrzeb rynku pracy.
Pragniemy Cię zapewnić, że ankieta jest w pełni anonimowa i zostanie wykorzystana wyłącznie na potrzeby podniesienia jakości kształcenia w Wyższej Szkole Ekologii i Zarządzania.</p>
<p style=\"text-align:right; margin-right:15px;\">
Z wyrazami szacunku,<br/><br/>
doc. dr Monika Madej<br/>
Rektor Wyższej Szkoły Ekologii i Zarządzania";
#  WYSYŁKA E-Mail
	mail("$wynik[4]", "$temat", "$wiadomosc", "$naglowek");
# Zmiana statusu ankiety
	$sql = "UPDATE `monitoring_absolwenta`.`absolwenci` SET `status_ankiety_5lat` = 'wyslana' WHERE `absolwenci`.`email` = '$wynik[4]' LIMIT 1;";
#		echo "<br/>$sql<br/>";
mysql_query($sql);

	   }
while ($j<$ilwierszy);
$info_5lat="Wysłano $ilwierszy ankiet dla absolwentów, którzy obronili się $ankieta_5 <br/>";
echo $info_5lat;
#Wysyłka ankiety dla absolwentów, którzy ukończyli 3 lata temu
#--------------------------------------------------------------------------------------------

$query=mysql_query($sql_3);
$ilwierszy=mysql_num_rows($query);
$j=0;
do {
	$j=$j+1;
	$wynik=mysql_fetch_array($query);
		if ($wynik[5]=='Ochrona ?rodowiska') $kierunek='OS';
		if ($wynik[5]=='Informatyka i Ekonometria') $kierunek='IiE';
		if ($wynik[5]=='Budownictwo') $kierunek='Bud';
		if ($wynik[5]=='Zarzšdzanie i In?ynieria Produkcji') $kierunek='ZiP';
		if ($wynik[5]=='Architektura i Urbanistyka') $kierunek='AiU';
		if ($wynik[5]=='Architektura Wn?trz') $kierunek='AW';
		if ($wynik[5]=='Architektura Krajobrazu') $kierunek='AK';
		if ($wynik[5]=='Architektura') $kierunek='A';
		if ($wynik[5]=='Wzornictwo') $kierunek='Wz';
		if ($wynik[5]=='Zarzšdzanie i Marketing') $kierunek='ZiM';
		if ($wynik[5]=='Zarzšdzanie') $kierunek='Z';
		if ($wynik[5]=='Zdrowie Publiczne') $kierunek='ZP';
		if ($wynik[5]=='Edukacja Techniczno-Informatyczna') $kierunek='ETI';
	$rodzaj_studiow=explode(" ",$wynik[6]);
	$rodzaj=$rodzaj_studiow[0];
	if ($rodzaj=='I') $rodzaj="Istopnia" ;
		else $rodzaj="IIstopnia";
	$data_o=$wynik[3];
	$rok="$data_o[0]$data_o[1]$data_o[2]$data_o[3]";
	$link="$sciezka/index.php?rok=$rok&kierunek=$kierunek&rodzaj=$rodzaj";
#	echo "$wynik[4], $link <br/>";
	# [3] - data obrony, [4] - email, [5] - kierunek studiów, [6] - rodzaj studiów

		#Utworzenie maila
		$naglowek="From: biurokarier@wseiz.pl".PHP_EOL."Reply-To: biurokarier@wseiz.pl".PHP_EOL."Content-type: text/html; charset=UTF-8";
		$temat="Badanie losów zawodowych absolwentów WSEiZ";
		$wiadomosc="
			<p><b>Droga Absolwentko, Drogi Absolwencie Wyższej Szkoły Ekologii i Zarządzania !</b></p>
<p>
Zwracamy się do Ciebie z prośbą o wypełnienie ankiety, znajdującej sie pod poniższym linkiem:<br/>
<a href=\"$link\">Badanie losów zawodowych absolwentów WSEiZ - Ankieta</a> <br/>
Ankieta pozwoli nam poznać Twoją opinię na temat kształcenia w naszej Uczelni, poznać Twoje dalsze losy zawodowe oraz plany edukacyjne.</p>
<p>
Dzięki udzielonym przez Ciebie odpowiedziom dowiemy się jak oceniasz zaproponowany przez nas program kształcenia, stopień przygotowania do pracy zawodowej i kompetencje opanowane w toku kształcenia. Dowiemy się również, co sądzisz na temat jakości pracy kadry naukowo-dydaktycznej, obsługi administracyjnej, bazy lokalowo-sprzętowej.
Twoje opinie pomogą nam wyznaczyć kierunek ewentualnych zmian, którym powinniśmy podążać, aby zaproponowana koncepcja i proces kształcenia były jeszcze bardziej efektywne i w pełni dostosowane do potrzeb rynku pracy.
Pragniemy Cię zapewnić, że ankieta jest w pełni anonimowa i zostanie wykorzystana wyłącznie na potrzeby podniesienia jakości kształcenia w Wyższej Szkole Ekologii i Zarządzania.</p>
<p>
Pomóż nam się doskonalić. Twoje zdanie ma dla nas ogromne znaczenie.</p>
<p style=\"text-align:right; margin-right:15px;\">
Z wyrazami szacunku,<br/><br/>
doc. dr Monika Madej<br/>
Rektor Wyższej Szkoły Ekologii i Zarządzania";
#  WYSYŁKA E-Mail
#echo $wiadomosc;
	mail("$wynik[4]", "$temat", "$wiadomosc", "$naglowek");
# Zmiana statusu ankiety
	$sql = "UPDATE `monitoring_absolwenta`.`absolwenci` SET `status_ankiety_3lata` = 'wyslana' WHERE `absolwenci`.`email` = '$wynik[4]' LIMIT 1;";
#		echo "<br/>$sql<br/>";
mysql_query($sql);

	   }
while ($j<$ilwierszy);
$info_3lata=" Wysłano $ilwierszy ankiet dla absolwentów, którzy obronili się $ankieta_3";
$sql_raport="SELECT * FROM `ankieta`";
$ile_ankiet=mysql_query($sql_raport);
$ile=mysql_num_rows($ile_ankiet);
$raport="$info_5lat $info_3lata<br/> Dotychczas absolwenci wypełnili <b>$ile</b> ankiet";
mail("ci@wseiz.pl, pr@wseiz.pl", "raport z wysylki ankiet", "$raport", "$naglowek");
?>
