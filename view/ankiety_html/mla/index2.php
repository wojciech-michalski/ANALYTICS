<?php 
 include('config.php');
  	  include ('konekt.php');
$agent=$_SERVER["HTTP_USER_AGENT"];
    $tablica = explode(" ", $agent);
	if ($tablica[1]=='(iPhone;' || $tablica[1]=='(iPad;') $apple=1;
	
else $apple=0;
if (isset($_GET['intro'])) $intro='0';
else $intro='1';
//Wyłączanie intro - linia poniżej 1 - włącza intro
$intro=0;
	$rok_ukonczenia=$_GET['rok'];
	$typ_studiow=$_GET['typ'];
	$rodzaj=$_GET['rodzaj'];
	$kierunek=$_GET['kierunek'];
#	echo $tablica[6];
        $mapowanie_k=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE `id_kierunek`='$_GET[kierunek]' "));
        $mapowanie_t=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE `id_typ`='$_GET[typ]]' AND "
                . "`id_rodzaj`='$_GET[rodzaj]'"));
        
	?>

<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <link type="text/css" rel="stylesheet" href="styl.css">
  <title>Badanie Losów Zawodowych Absolwenta</title>
</head>
<body>
<div align="center">
<?php //echo $mapowanie_k['kierunek']." ".$mapowanie_t['stopien']." ".$mapowanie_t['forma'];
switch ($mapowanie_k['kierunek']){
    case "Architektura":
    case "Architecture":
        $kierunek="A";
        break;
    case "Zarządzanie":
    case "Management":
        $kierunek="Z";
        break;
     case "Architektura Krajobrazu":
        $kierunek="AK";
        break;
    case "Architektura Wnętrz":
        $kierunek="AW";
        break;
    case "Architektura Wnętrz":
        $kierunek="AW";
        break;
    case "Budownictwo":
        $kierunek="Bud";
        break;
    case "Wzornictwo":
        $kierunek="Wz";
        break;
    case "Ochrona Środowiska":
        $kierunek="OS";
        break;
    case "Zdrowie Publiczne":
        $kierunek="ZP";
        break;
    case "Zarządzanie i Inżynieria Produkcji":
        $kierunek="ZiP";
        break;
    case "Informatyka":
    case "Computer Engineering":
        $kierunek="I";
        break;
    case "Mechanika i Budowa Maszyn":
    
        $kierunek="MiBM";
        break;
}
switch ($mapowanie_t['stopien']){
    case "I stopnia":
        $rodzaj="Istopnia";
        break;
    case "II stopnia":
        $rodzaj="IIStopnia";
}
?>
        




<div class="kontener_glowny">
<div class="naglowek"><br/>BADANIE LOSÓW ZAWODOWYCH ABSOLWENTÓW WSEiZ</div>
<div class="ankieta">
	<fieldset>
		<form method="post" action="weryfikacja.php" name="ankieta"><fieldset class="pole">
		<table><tr><td>
<div class="naglowek-pytania">1. Rok ukończenia studiów </div></td><td><div class="naglowek-pytania">2. Kierunek ukończonych studiów </div></td></tr><tr><td>

<select name="rok_ukonczenia" class="selekcik">
	<option <?php if ($rok_ukonczenia=='1995') echo "selected= \"selected\"";?>>1995</option>
	<option <?php if ($rok_ukonczenia=='1996') echo "selected= \"selected\"";?>>1996</option>
	<option <?php if ($rok_ukonczenia=='1997') echo "selected= \"selected\"";?>>1997</option>
	<option <?php if ($rok_ukonczenia=='1998') echo "selected= \"selected\"";?>>1998</option>
	<option <?php if ($rok_ukonczenia=='1999') echo "selected= \"selected\"";?>>1999</option>
	<option <?php if ($rok_ukonczenia=='2000') echo "selected= \"selected\"";?>>2000</option>
	<option <?php if ($rok_ukonczenia=='2001') echo "selected= \"selected\"";?>>2001</option>
	<option <?php if ($rok_ukonczenia=='2002') echo "selected= \"selected\"";?>>2002</option>
	<option <?php if ($rok_ukonczenia=='2003') echo "selected= \"selected\"";?>>2003</option>
	<option <?php if ($rok_ukonczenia=='2004') echo "selected= \"selected\"";?>>2004</option>
	<option <?php if ($rok_ukonczenia=='2005') echo "selected= \"selected\"";?>>2005</option>
	<option <?php if ($rok_ukonczenia=='2006') echo "selected= \"selected\"";?>>2006</option>
	<option <?php if ($rok_ukonczenia=='2007') echo "selected= \"selected\"";?>>2007</option>
	<option <?php if ($rok_ukonczenia=='2008') echo "selected= \"selected\"";?>>2008</option>
	<option <?php if ($rok_ukonczenia=='2009') echo "selected= \"selected\"";?>>2009</option>
	<option <?php if ($rok_ukonczenia=='2010') echo "selected= \"selected\"";?>>2010</option>
	<option <?php if ($rok_ukonczenia=='2011') echo "selected= \"selected\"";?>>2011</option>
	<option <?php if ($rok_ukonczenia=='2012') echo "selected= \"selected\"";?>>2012</option>
	<option <?php if ($rok_ukonczenia=='2013') echo "selected= \"selected\"";?>>2013</option>
	<option <?php if ($rok_ukonczenia=='2014') echo "selected= \"selected\"";?>>2014</option>
	<option <?php if ($rok_ukonczenia=='2015') echo "selected= \"selected\"";?>>2015</option>
	<option <?php if ($rok_ukonczenia=='2016') echo "selected= \"selected\"";?>>2016</option>
	<option <?php if ($rok_ukonczenia=='2017') echo "selected= \"selected\"";?>>2017</option>
	<option <?php if ($rok_ukonczenia=='2018') echo "selected= \"selected\"";?>>2018</option>
	<option <?php if ($rok_ukonczenia=='2019') echo "selected= \"selected\"";?>>2019</option>
	<option <?php if ($rok_ukonczenia=='2020') echo "selected= \"selected\"";?>>2020</option>
	<option <?php if ($rok_ukonczenia=='2021') echo "selected= \"selected\"";?>>2021</option>
	<option <?php if ($rok_ukonczenia=='2022') echo "selected= \"selected\"";?>>2022</option>
        <option <?php if ($rok_ukonczenia=='2023') echo "selected= \"selected\"";?>>2023</option>
	
</select></td><td>

<select name="kierunek" class="selekcik">
	<option <?php if ($kierunek=='A') echo "selected= \"selected\"";?>>Architektura</option>
	<option <?php if ($kierunek=='AK') echo "selected= \"selected\"";?>>Architektura Krajobrazu</option>
	<option <?php if ($kierunek=='AW') echo "selected= \"selected\"";?>>Architektura Wnętrz</option>
	<option <?php if ($kierunek=='Bud') echo "selected= \"selected\"";?>>Budownictwo</option>
	<option <?php if ($kierunek=='Wz') echo "selected= \"selected\"";?>>Wzornictwo</option>
	<option <?php if ($kierunek=='OS') echo "selected= \"selected\"";?>>Ochrona Środowiska</option>
	<option <?php if ($kierunek=='I') echo "selected= \"selected\"";?>>Informatyka</option>
	<option <?php if ($kierunek=='ZP') echo "selected= \"selected\"";?>>Zdrowie Publiczne</option>
	<option <?php if ($kierunek=='Z') echo "selected= \"selected\"";?>>Zarządzanie</option>
	<option <?php if ($kierunek=='ZiP') echo "selected= \"selected\"";?>>Zarządzanie i Inżynieria Produkcji</option>
	<option <?php if ($kierunek=='MiBM') echo "selected= \"selected\"";?>>Mechanika i Budowa Maszyn</option>
	
</select></td></tr>

<tr><td>
<div class="naglowek-pytania">3. Typ ukończonych studiów</div></td>
<td>
<div class="naglowek-pytania">4. Rodzaj ukończonych studiów</div></td></tr><tr><td>
<select name="typ_studiow" class="selekcik">
	<option>stacjonarne</option>
	<option>niestacjonarne</option>
</select></td><td>
<select name="rodzaj_studiow" class="selekcik">
	<option <?php if ($rodzaj=='Istopnia') echo "selected= \"selected\"";?>>I stopnia</option>
	<option <?php if ($rodzaj=='IIstopnia') echo "selected= \"selected\"";?>>II stopnia</option>
</select></td></tr>
<tr><td><div class="naglowek-pytania">5. Specjalność ukończonych studiów</div></td>
<td><div class="naglowek-pytania" style="color:gray;">Data wypełnienia ankiety</div></td></tr>
<tr><td><textarea  rows="1" class="selekcik" name="specjalnosc"></textarea></td>
<td><textarea  rows="1" class="selekcik" name="data_wypelnienia" >
<?php echo date('Y-m-d');?>
</textarea></td>
</tr></table></fieldset>
<fieldset class="pole2">
<table><tr><td colspan="2"><div class="naglowek-pytania">6. Jakie czynniki wpłynęły na wybór kierunku studiów</div></td></tr><tr><td colspan="2">
<select name="pyt_4" class="selekcik">
	<option>zainteresowania</option>
	<option>sugestie bliskich osób</option>
	<option>niepowodzenia w dostaniu się na inny kierunek studiów</option>
	<option>uważałem/am, że nie będę miał/a trudności ze znalezieniem pracy po jego ukończeniu</option>
	<option>uważałem/am, że daje on możliwość wysokich zarobków</option>
	<option>uważałem/am, że daje on możliwość wykonywania ciekawej pracy</option>
	<option>przypadek</option>
	<option>inne</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">7. Czy jest Pan/i zadowolony/a z wyboru kierunku studiów ?</div></td><td>
<div class="naglowek-pytania">8. W jakim stopniu studia spełniły Pana/i oczekiwania ?</div></td></tr><tr><td>
<select name="pyt_5" class="selekcik">
	<option>tak</option>
	<option>raczej tak</option>
	<option>raczej nie</option>
	<option>nie</option>
	</select></td><td>
<select name="pyt_6" class="selekcik">
	<option>całkowicie</option>
	<option>w większym niż się spodziewałem</option>
	<option>częściowo</option>
	<option>nie spełniły</option>
	</select></td></tr><tr><td>
	
<div class="naglowek-pytania">9. Jak Pan/i całościowo ocenia program studiów ?</div></td><td>
<div class="naglowek-pytania">10. Czy wystąpiło dublowanie treści przedmiotów poczas studiów ?</div></td></tr><tr><td>
<select name="pyt_7" class="selekcik">
	<option>spójny i wewnętrznie logiczny</option>
	<option>złożony ze słabo ze sobą powiązanych przedmiotów</option>
	<option>złożony z odrębnych, nie powiązanych ze sobą przedmiotów</option>
	</select></td><td>
<select name="pyt_8" class="selekcik">
	<option>tak, często</option>
	<option>tak, raczej rzadko</option>
	<option>bardzo rzadko</option>
	<option>nie</option>
	</select></td></tr></table>
</fieldset>
<fieldset class="pole"><table><tr><td>
<div class="naglowek-pytania">11. Jak ocenia Pan/i kompetencje nauczycieli akademickich, z którymi miał/a Pani/i zajęcia ?</div></td><td>
<div class="naglowek-pytania">12.Czy podczas studiów nauczyciele stosowali nowoczesne metody kształcenia ?</div></td></tr><tr><td>
<select name="pyt_9" class="selekcik">
	<option>wysokie</option>
	<option>raczej wysokie</option>
	<option>zróżnicowane</option>
	<option>raczej niskie</option>
	<option>niskie</option>
	</select></td><td>
<select name="pyt_10" class="selekcik">
	<option>tak, często</option>
	<option>tak, raczej rzadko</option>
	<option>bardzo rzadko</option>
	<option>nie</option>
	</select></td></tr></table></fieldset>
<fieldset class="pole2"><table><tr><td>
<div class="naglowek-pytania">13. Czy gdyby Pan/i mógł/mogła ponownie wybrać Uczelnię byłaby to WSEiZ ?</div></td><td>
<div class="naglowek-pytania">14. Jak ocenia Pan/i zaplecze biblioteczne WSEiZ ?</div></td></tr><tr><td>
<select name="pyt_11" class="selekcik">
	<option>tak</option>
	<option>raczej tak</option>
	<option>raczej nie</option>
	<option>nie</option>
	</select></td><td>
<select name="pyt_12" class="selekcik">
	<option>bardzo dobre</option>
	<option>dobre</option>
	<option>odpowiednie</option>
	<option>nieodpowiednie</option>
	</select></td></tr><tr><td>
<div class="naglowek-pytania">15. Jak ocenia Pan/i obsługę administracyjną ?</div></td><td>
<div class="naglowek-pytania">16. Posługując się skalą od 1 do 5 (gdzie 1=żle, a 5=bardzo dobrze), proszę ocenić:</div></td></tr><tr><td>
<select name="pyt_13" class="selekcik">
	<option>bardzo dobra</option>
	<option>dobra</option>
	<option>dostateczna</option>
	<option>zła</option>
	</select></td><td>	
<fieldset class="radiobatony">
- stan techniczny budynków w których odbywały się zajęcia<br/>
				<b>1<input type="radio" name="pyt_14a" value="1">
				<input type="radio" name="pyt_14a" value="2">
				<input type="radio" name="pyt_14a" value="3">
				<input type="radio" name="pyt_14a" value="4">
				<input type="radio" name="pyt_14a" value="5">5</b><br/><br/>
- warunki w pomieszczeniach dydaktycznych<br/>
				<b>1<input type="radio" name="pyt_14b" value="1">
				<input type="radio" name="pyt_14b" value="2">
				<input type="radio" name="pyt_14b" value="3">
				<input type="radio" name="pyt_14b" value="4">
				<input type="radio" name="pyt_14b" value="5">5</b><br/><br/>
- sprzęt dydaktyczny wykorzystywany na zajęciach<br/>
				<b>1<input type="radio" name="pyt_14c" value="1">
				<input type="radio" name="pyt_14c" value="2">
				<input type="radio" name="pyt_14c" value="3">
				<input type="radio" name="pyt_14c" value="4">
				<input type="radio" name="pyt_14c" value="5">5</b><br/><br/>
- sprzęt komputerowy<br/>
				<b>1<input type="radio" name="pyt_14d" value="1">
				<input type="radio" name="pyt_14d" value="2">
				<input type="radio" name="pyt_14d" value="3">
				<input type="radio" name="pyt_14d" value="4">
				<input type="radio" name="pyt_14d" value="5">5</b><br/><br/>
- zaplecze socjalne (toalety, stołówki, itp.)<br/>
				<b>1<input type="radio" name="pyt_14e" value="1">
				<input type="radio" name="pyt_14e" value="2">
				<input type="radio" name="pyt_14e" value="3">
				<input type="radio" name="pyt_14e" value="4">
				<input type="radio" name="pyt_14e" value="5">5</b><br/><br/>
</fieldset></td></tr></table></fieldset>
<fieldset class="pole"><table><tr><td>
<div class="naglowek-pytania">17. Czy po ukończeniu studiów kontynuował Pan/i kształcenie ?</div></td><td>
<div class="naglowek-pytania">18. Jakie były czynniki skłaniające Pana/ią do kontynuacji kształcenia ?</div></td></tr><tr><td>
<select name="pyt_15" class="selekcik">
	<option>zakończyłem edukację</option>
	<option>tak, na studiach II stopnia (magisterskich)</option>
	<option>tak, na studiach III stopnia (doktoranckich)</option>
	<option>tak, na studiach podyplomowych</option>
	<option>tak, na kursach i szkoleniach specjalistycznych</option>
	
</select></td><td>
<select name="pyt_16" class="selekcik">
	<option>nie dotyczy, nie kontynuowałem edukacji</option>
	<option>pogłębienie wiedzy kierunkowej</option>
	<option>przekonanie, że tytuł magistra/stopień doktora zwiększa konkurencyjność na rynku pracy</option>
	<option>przekonanie, że tytuł magistra/stopień doktora wpływa na wzrost zarobków</option>
	<option>uzyskanie wiedzy z dodatkowej dziedziny</option>
	<option>brak gotowości do podjęcia dodatkowej pracy</option>
	<option>niemożność znalezienia pracy po studiach I stopnia</option>
	<option>wymagania pracodawcy</option>
</select></td></tr></table></fieldset>

<fieldset class="pole2"><table><tr><td>
<div class="naglowek-pytania">19. Jaka była Pana/i aktywność zawodowa podczas studiów ?</div></td><td>
<div class="naglowek-pytania">20. Jaki jest obecnie Pana/i status zawodowy ?</div></td></tr><tr><td>
<select name="pyt_17" class="selekcik">
	<option>nie pracowałem/am w ogóle</option>
	<option>praca stała, podjęta przed rozpoczęciem studiów</option>
	<option>praca stała, podjęta w trakcie studiów</option>
	<option>praca dorywcza</option>
	<option>praktyki studenckie, staż</option>
	
</select></td><td>
<select name="pyt_18" class="selekcik">
	<option>jestem zatrudniony/a</option>
	<option>poszukuję pracy</option>
	<option>prowadzę własną działalność</option>
	<option>studiuję</option>
	<option>inne (np. wychowywanie dziecka)</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">21. Jeżeli Pan/i obecnie pracuje, w jakiej instytucji ?</div></td><td>
<div class="naglowek-pytania">22. Jeżeli Pan/i obecnie pracuje, na jakim stanowisku jest Pan/i zatrudniony/a ?</div></td></tr><tr><td>
<select name="pyt_19" class="selekcik">
	<option>nie dotyczy, nie jestem zatrudniony/a</option>
	<option>sektor prywatny - zatrudnia mniej niż 10 pracowników</option>
	<option>sektor prywatny - zatrudnia mniej niż 50 pracowników</option>
	<option>sektor prywatny - zatrudnia mniej niż 250 pracowników</option>
	<option>sektor prywatny - zatrudnia więcej niż 250 pracowników</option>
	<option>sektor publiczny</option>
</select></td><td>
<select name="pyt_20" class="selekcik">
	<option>nie dotyczy, nie jestem zatrudniony/a</option>
	<option>personel biurowy</option>
	<option>specjaliści i inni pracownicy samodzielni</option>
	<option>menadżerowie średniego szczebla (kierownicy)</option>
	<option>najwyższa kadra zarządzająca (dyrektorzy / prezesi)</option>
	<option>własna działalność gospodarcza</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">23. Kiedy Pan/i rozpoczął/eła poszukiwania pierwszej pracy ?</div></td><td>
<div class="naglowek-pytania">24. Jak długo po uzyskaniu dyplomu szukał/a Pan/i pracy ?</div></td></tr><tr><td>
<select name="pyt_21" class="selekcik">
	<option>w czasie trwania studiów</option>
	<option>przed obroną</option>
	<option>po obronie</option>
	<option>po otrzymaniu dyplomu</option>
</select></td><td>
<select name="pyt_22" class="selekcik">
	<option>pracowałem/am już w czasie studiów</option>
	<option>mniej niż 1 miesiąc</option>
	<option>2-6 miesięcy</option>
	<option>6-12 miesięcy</option>
	<option>powyżej jednego roku</option>
	<option>nadal szukam pracy</option>
	<option>nie szukam pracy</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">25. Przez jakie źródła informacji Pan/i poszukiwał/ła lub znalazł/a pracę ?</div></td><td>
<div class="naglowek-pytania">26. Jakie czynniki zadecydowały o wyborze pracodawcy ? (może być wiele odpowiedzi)</div></td></tr><tr><td>
<select name="pyt_23" class="selekcik">
	<option>ogłoszenia w prasie</option>
	<option>ogłoszenia w internecie</option>
	<option>bezpośredni kontakt z pracodawcą</option>
	<option>sieć kontaktów, znajomi, rodzina</option>
	<option>rejestrując CV na portalach pośrednictwa pracy</option>
	<option>wysyłając CV do konkretnych firm mailem, lub pocztą</option>
	<option>Urząd Pracy</option>
	<option>Uczelniane Biuro Karier</option>
	<option>wszystkie możliwości</option>
</select></td><td>
<fieldset class="radiobatony"><table><tr><td>
	- zgodność wymagań z kwalifikacjami</td><td> <input type="checkbox" name="pyt_24a" value="1"  /></td></tr>
	<tr><td>- możliwość rozwoju zawodowego/awansu </td><td><input type="checkbox" name="pyt_24b" value="1" /></td></tr>
	<tr><td>- zainteresowania zawodowe </td><td><input type="checkbox" name="pyt_24c" value="1" /></td></tr>
	<tr><td>- renoma i prestiż firmy </td><td><input type="checkbox" name="pyt_24d" value="1" /></td></tr>
	<tr><td>- wysokość wynagrodzenia </td><td><input type="checkbox" name="pyt_24e" value="1" /></td></tr>
	<tr><td>- stabilność zatrudnienia </td><td><input type="checkbox" name="pyt_24f" value="1" /></td></tr>
	<tr><td>- dogodna lokalizacja </td><td><input type="checkbox" name="pyt_24g" value="1" /></td></tr>
	<tr><td>- opinia znajomych </td><td><input type="checkbox" name="pyt_24h" value="1" /></td></tr>
	<tr><td>- świadczenia socjalne </td><td><input type="checkbox" name="pyt_24i" value="1" /></td></tr>
	<tr><td>- brak możliwości wyboru / chęć podjęcia jakiejkolwiek pracy </td><td><input type="checkbox" name="pyt_24j" value="1" /></td></tr></table>
</fieldset></td></tr><tr><td>
<div class="naglowek-pytania">27. W Pana/i ocenie jakie czynniki zdecydowały o Pana/i zatrudnieniu ?</div></td><td>
<div class="naglowek-pytania">28. Czy ukończenie przez Pana/ią studiów w WSEiZ było atutem w procesie rekrutacji ?</div></td></tr><tr><td>
<select name="pyt_25" class="selekcik">
	<option>ukończony kierunek studiów</option>
	<option>kwalifikacje zawodowe uzyskane na studiach</option>
	<option>ocena na dyplomie</option>
	<option>kwalifikacje zawodowe uzyskane poza programem studiów</option>
	<option>znajomość języków obcych</option>
	<option>motywacja do pracy</option>
	<option>znajomość nowych technik informatycznych</option>
	<option>doświadczenie zawodowe - wcześniejszy kontakt z praktyką</option>
	<option>wynik testu kompetencji</option>
</select></td><td>
<select name="pyt_26" class="selekcik">
	<option>tak</option>
	<option>nie</option>
	<option>trudno powiedzieć</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">29. Czy wykonywana przez Pana/ią praca zgodna jest z kierunkiem ukończonych studiów ?</div></td><td>
<div class="naglowek-pytania">30. Czy wiedza i umiejętności zdobyte podczas studiów wykorzystuje Pan/i w obecnej pracy zawodowej ? Proszę podać wartość w procentach</div></td></tr><tr><td>
<select name="pyt_27" class="selekcik">
	<option>zdecydowanie tak</option>
	<option>raczej tak</option>
	<option>raczej nie</option>
	<option>zdecydowanie nie </option>
</select></td><td>
<select name="pyt_28" class="selekcik">
	<option>w 100%</option>
	<option>w 75%</option>
	<option>w 50%</option>
	<option>w 25%</option>
	<option>nie wykorzystuję tej wiedzy</option>
</select></td></tr></table></fieldset>
<fieldset class="pole"><table><tr><td>
<div class="naglowek-pytania">31. Czy w trakcie studiów miał/a Pan/i kontakt z Uczelnianym Biurem Karier ?</div></td><td>
<div class="naglowek-pytania">32. Czy w czasie studiów brał Pan/i udział w konferencjach, kursach, Targach Pracy, warsztatach przygotowujących do wejścia na rynek pracy ?</div></td></tr><tr><td>
<select name="pyt_29" class="selekcik">
	<option>tak</option>
	<option>nie, ale słyszałem/am o nim</option>
	<option>nie</option>
</select></td><td>
<select name="pyt_30" class="selekcik">
	<option>tak</option>
	<option>nie, ale słyszałem/am o nich</option>
	<option>nie</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">33. Czy program studiów  w WSEiZ umożliwił Panu/i nabycie umiejętności poruszania się na rynku pracy ?</div></td><td>
<div class="naglowek-pytania">34. Pana/i sugestie zmian w programie kształcenia</div></td></tr><tr><td>
<select name="pyt_31" class="selekcik">
	<option>zdecydowanie tak</option>
	<option>tak</option>
	<option>raczej tak</option>
	<option>raczej nie</option>
	<option>nie</option>
	<option>zdecydowanie nie</option>
</select></td><td>
	<textarea  rows="4" class="selekcik2" name="pyt_32"></textarea></td></tr></table>
</fieldset>
<fieldset class="pole3"><table><tr><td colspan="2" style="text-align:center;">METRYCZKA:<hr/></td></tr><tr><td>
<div class="naglowek-pytania">35. Płeć</div></td><td>
<div class="naglowek-pytania">36. Wiek</div></td></tr><tr><td>
<select name="pyt_33" class="selekcik">
	<option>kobieta</option>
	<option>mężczyzna</option>
</select></td><td>
<select name="pyt_34" class="selekcik">
	<option>21-30 lat</option>
	<option>31-40 lat</option>
	<option>41-50 lat</option>
	<option>powyżej 50 lat</option>
</select></td></tr><tr><td>
<div class="naglowek-pytania">37. Miejsce zamieszkania</div></td><td>
<div class="naglowek-pytania">
<!--WAŻNE ! <br/>Jeśli chce Pan/i wziąć udział w losowaniu atrakcyjnych nagród i upominków, prosimy o podanie numeru telefonu lub adresu mailowego, pod którym będziemy mogli się z Panem / Panią skontaktować-->
</div></td></tr><tr><td>
<select name="pyt_35" class="selekcik">
	<option>Warszawa</option>
	<option>inne miasto w województwie mazowieckim</option>
	<option>wieś w województwie mazowieckim</option>
	<option>poza województwem mazowieckim</option>
</select></td><td>
<!--	<textarea  rows="1" class="selekcik" name="telefon">nr telefonu</textarea><br/>
	<textarea  rows="1" class="selekcik" name="email">e-mail</textarea>-->
	</td></tr></table></fieldset>
<fieldset style="text-align:center;"><input type="submit" name="ognia" class="ognia" value="" />Wyślij ankietę</fieldset></fieldset></form>

</fieldset></div><div class="stopka">&nbsp;</div>
</div>

</div></body></html>
