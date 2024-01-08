
<?php 
#############################################################################
#     Wysyłka odpowiednio sformatowanej ankiety do absolwentów		    #
#      (c) Wojtas 2012                                                      #
#############################################################################
#TU konfigurujesz ścieżkę/adres skryptu
$sciezka="https://ankiety.wseiz.pl/mla";
$subject="Badanie losów zawodowych absolwentów WSEiZ";

include('../config/config.php');
include ('konekt_MySQL.php');
# ustawienie daty zgodnie z logiką PiP NET-u
$dzisiaj=date('m-d');
$rok=date('Y');
$ankieta_3=$rok-3 ."-$dzisiaj 00:00:00.000";
$ankieta_5=$rok-5 ." $dzisiaj 00:00:00.000";
#echo $dzisiaj;
#echo "<br/>$ankieta_3";
#echo "<br/>$ankieta_5";
$sql_3="SELECT * FROM `absolwenci` WHERE `data_obrony`='$ankieta_3' AND `ankieta_3`='1'";
$sql_5="SELECT * FROM `absolwenci` WHERE `data_obrony`='$ankieta_5' AND `ankieta_5`='1'";
//$sql_3="SELECT * FROM `absolwenci` WHERE `ankieta_3`='1'";
//$sql_5="SELECT * FROM `absolwenci` WHERE  `ankieta_5`='1'";
require_once "Mail.php";  
#-------------------------------------------------------------------------------------------------------
#Wysyłka ankiety dla absolwentów, którzy ukończyli 5 lat temu
$do_wysylki=mysqli_query($kon,$sql_5);
if(mysqli_num_rows($do_wysylki)>0){
foreach ($do_wysylki as $absolwent){
    $rok_ukonczenia=$rok-5;
    echo $absolwent['email']."\n";
     require_once "Mail.php";  
    $to=$absolwent['email'];
    		$body="
			<p><b>Droga Absolwentko, Drogi Absolwencie Wyższej Szkoły Ekologii i Zarządzania !</b></p>
<p>
Zwracamy się do Ciebie z prośbą o wypełnienie ankiety, znajdującej sie pod poniższym linkiem:<br/>
<a href=\"$sciezka/index2.php?intro=0&rok=$rok_ukonczenia&typ=$absolwent[id_typ]&rodzaj=$absolwent[id_rodzaj]&kierunek=$absolwent[id_kierunek]\">Badanie losów zawodowych absolwentów WSEiZ - Ankieta</a> <br/>
Ankieta pozwoli nam poznać Twoją opinię na temat kształcenia w naszej Uczelni, poznać Twoje dalsze losy zawodowe oraz plany edukacyjne.</p>
<p>
Dzięki udzielonym przez Ciebie odpowiedziom dowiemy się jak oceniasz zaproponowany przez nas program kształcenia, stopień przygotowania do pracy zawodowej i kompetencje opanowane w toku kształcenia. Dowiemy się również, co sądzisz na temat jakości pracy kadry naukowo-dydaktycznej, obsługi administracyjnej, bazy lokalowo-sprzętowej.
Twoje opinie pomogą nam wyznaczyć kierunek ewentualnych zmian, którym powinniśmy podążać, aby zaproponowana koncepcja i proces kształcenia były jeszcze bardziej efektywne i w pełni dostosowane do potrzeb rynku pracy.
Pragniemy Cię zapewnić, że ankieta jest w pełni anonimowa i zostanie wykorzystana wyłącznie na potrzeby podniesienia jakości kształcenia w Wyższej Szkole Ekologii i Zarządzania.</p>
<p style=\"text-align:right; margin-right:15px;\">
Z wyrazami szacunku,<br/><br/>
doc. dr Monika Madej<br/>
Rektor Wyższej Szkoły Ekologii i Zarządzania";
                echo $body."\n";
$headers = array ('From' => $MailFrom,
  'To' => $to,
  'Subject' => $subject,
  'Content-Type' => $contenttype,
  'Content-Transfer-Encodin' => $transfer);
$smtp = Mail::factory('smtp',
  array ('host' => $mailhost,
    'auth' => true,
    'username' => $mailusername,
    'password' => $mailpassword));
$mail = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
  echo($mail->getMessage());
 } else {
     echo "\n Mail wysłany\n";
 }           
}
}
else echo "\n Nie ma absolwentów broniących się 5 lat temu\n";

#Wysyłka ankiety dla absolwentów, którzy ukończyli 3 lata temu
$do_wysylki=mysqli_query($kon,$sql_3);
if(mysqli_num_rows($do_wysylki)>0){
foreach ($do_wysylki as $absolwent){
     $rok_ukonczenia=$rok-3;
    echo $absolwent['email']."\n";
    $to=$absolwent['email'];
    		$body="
			<p><b>Droga Absolwentko, Drogi Absolwencie Wyższej Szkoły Ekologii i Zarządzania !</b></p>
<p>
Zwracamy się do Ciebie z prośbą o wypełnienie ankiety, znajdującej sie pod poniższym linkiem:<br/>
<a href=\"$sciezka/index2.php?intro=0&rok=$rok_ukonczenia&typ=$absolwent[id_typ]&rodzaj=$absolwent[id_rodzaj]&kierunek=$absolwent[id_kierunek]\">Badanie losów zawodowych absolwentów WSEiZ - Ankieta</a> <br/>
Ankieta pozwoli nam poznać Twoją opinię na temat kształcenia w naszej Uczelni, poznać Twoje dalsze losy zawodowe oraz plany edukacyjne.</p>
<p>
Dzięki udzielonym przez Ciebie odpowiedziom dowiemy się jak oceniasz zaproponowany przez nas program kształcenia, stopień przygotowania do pracy zawodowej i kompetencje opanowane w toku kształcenia. Dowiemy się również, co sądzisz na temat jakości pracy kadry naukowo-dydaktycznej, obsługi administracyjnej, bazy lokalowo-sprzętowej.
Twoje opinie pomogą nam wyznaczyć kierunek ewentualnych zmian, którym powinniśmy podążać, aby zaproponowana koncepcja i proces kształcenia były jeszcze bardziej efektywne i w pełni dostosowane do potrzeb rynku pracy.
Pragniemy Cię zapewnić, że ankieta jest w pełni anonimowa i zostanie wykorzystana wyłącznie na potrzeby podniesienia jakości kształcenia w Wyższej Szkole Ekologii i Zarządzania.</p>
<p style=\"text-align:right; margin-right:15px;\">
Z wyrazami szacunku,<br/><br/>
doc. dr Monika Madej<br/>
Rektor Wyższej Szkoły Ekologii i Zarządzania";
                echo $body."\n";
                $headers = array ('From' => $MailFrom,
  'To' => $to,
  'Subject' => $subject,
  'Content-Type' => $contenttype,
  'Content-Transfer-Encodin' => $transfer);
$smtp = Mail::factory('smtp',
  array ('host' => $mailhost,
    'auth' => true,
    'username' => $mailusername,
    'password' => $mailpassword));
$mail = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
  echo($mail->getMessage());
 } else {
     echo "\n Mail wysłany\n";
 }
}
}
else echo "\n Nie ma absolwentów broniących się 3 lata temu\n";