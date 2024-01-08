<?php
function customError() {
    $errfile = "unknown file";
    $errstr  = "shutdown";
    $errno   = E_ERROR;
    $errline = 0;

    $error = error_get_last();

    if($error['type'] == 1) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];
    ?>
<div class="alert alert-danger alert-dismissible fade show" style="position:absolute;top:70;" role="alert">
  <strong>Motyla noga !</strong> Analytics właśnie próbuje zrobić coś, czego się zrobić nie da...
  <hr/>Poniżej zrzut komunikatu dla specjalistów:
  <p class="text-muted"><?php echo "BŁĄD: [$errno] $errstr";?></p><?php //print_r($error);?>
    <a href="main.php"><button type="button" class="close">
    <span aria-hidden="true">&times;</span>
      </button></a>
</div>
    <?php };
}
register_shutdown_function("customError");
//set_error_handler("customError",E_ERROR);
$siteurl="https://analytics.aranea.com.pl";
$RA="2023/24";
$salt="2Ah2Hl7VMcVXuNWrP7HAzaEQ5sdKoYzi";
//$surveyurl="https://analytics.aranea.com.pl:9091/view/ankiety_html";
$surveyurl="https://ankiety.wseiz.pl";
//Developerka - do usunięcia
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//Połączenie z MSSQL
	//$myServer = "10.10.10.9";
        $myServer = "GWINT";
		$myInstance="WSEIZ";
		$myUser = "sa";
		$myPass = "!@Szkola#$";
		$myDB = "U10";
//Połączenie z MySQL
	$chmurka = "localhost";
	$baza="analytics";
	$user_DB="root";
	$haselo="!@szkola#";
        $url="Analytics";
//Sekcja API POLON
$POLONAPIurl="https://mcl.opi.org.pl/auth/realms/OPI/protocol/openid-connect/token";
$authTokenHeader="Content-Type: application/x-www-form-urlencoded";
$polonUser="ci@wseiz.pl";
$polonPass="Afrodyta120";
   //curl --location --request POST 'https://mcl.opi.org.pl/auth/realms/OPI/protocol/openid-connect/token' --header 'Content-Type: application/x-www-form-urlencoded' --data-urlencode 'client_id=polon2' --data-urlencode 'grant_type=password' --data-urlencode 'username=ci@wseiz.pl' --data-urlencode 'password=Afrodyta120'     
 //Mail
$MailFrom = "WSEiZ <uczelnia@wseiz.pl>";
$mailusername = "uczelnia@wseiz.pl";
$mailpassword = "!@Uczniak#$";
$mailhost = "smtp.office365.com";
$contenttype = "text/html; charset=utf-8";
$transfer = "8bit";       
//Sekcja API PCG_Academia
        $PCGApiKey="CzJmkcwpwd15:56";
        $PCGApiUrl="10.10.10.11";
        $miesiace=array('01' => "Styczeń",
            '02' => "Luty",
            '03' => "Marzec",
            '04' => "Kwiecień",
            '05' => "Maj",
            '06' => "Czerwiec",
            '07' => "Lipiec",
            '08' => "Sierpień",
            '09' => "Wrzesień",
            '10' => "Październik",
            '11' => "Listopad",
            '12' => "Grudzień");
        $rodzaje_Oplat=array(
       '1' => "czesne",
       '68' => "odsetki",
       '18' => "opłata archiwizacyjna",
       '51' => "duplikat legitymacji",
       '15' => "powtórna realizacja przedmiotu",
       '19' => "opłata za urlop dziekański",
       '4' => "opłata rekrutacyjna",
       '49' => "opłata biblioteczna (kara)",
      '5' => "różnice programowe",
       '3' => "wpisowe"
        );
    //Powiązanie nazw ankiet z widokami
        $widokiAnkiety=array(
            "ocena_administracji2" => "ANALIZA-Ocena Administracji",
            
        );
    $countries=array(
"PL"=>"Polska",
"YE"=>"Jemen",
"YT"=>"Majotta",
"ZA"=>"Republika Południowej Afryki",
"ZM"=>"Zambia",
"ZW"=>"Zimbabwe",
"UM"=>"Minor Powiernicze Wyspy Pacyfiku Stanów Zjednoczonych",
"UK"=>"Zjednoczone Królestwo",
"UG"=>"Uganda",
"UA"=>"Ukraina",
"UZ"=>"Uzbekistan",
"UY"=>"Urugwaj",
"US"=>"Stany Zjednoczone",
"VN"=>"Wietnam",
"VI"=>"Wyspy Dziewicze (Stanów Zjednoczonych)",
"VE"=>"Wenezuela",
"VG"=>"Wyspy Dziewicze (Brytyjskie)",
"VA"=>"Państwo Watykańskie (Stolica Apostolska)",
"VC"=>"Saint Vincent i Grenadyny",
"VU"=>"Vanuatu",
"WL"=>"Saint Lucia",
"WF"=>"Wallis i Futuna",
"WS"=>"Samoa",
"QA"=>"Katar",
"RS"=>"Serbia",
"RO"=>"Rumunia",
"RW"=>"Rwanda",
"RU"=>"Federacja Rosyjska",
"RE"=>"Reunion",
"SN"=>"Senegal",
"SO"=>"Somalia",
"SR"=>"Surinam",
"ST"=>"Wyspy Świętego Tomasza i Książęca",
"SV"=>"Salwador",
"SY"=>"Syryjska, Arabska Republika",
"SZ"=>"Suazi",
"SA"=>"Arabia Saudyjska",
"SC"=>"Seszele",
"SB"=>"Wyspy Salomona",
"SE"=>"Szwecja",
"SD"=>"Sudan",
"SG"=>"Singapur",
"SI"=>"Słowenia",
"SK"=>"Słowacka, Republika",
"SJ"=>"Wyspy Svalbard i Jan Mayen",
"SM"=>"San Marino",
"SL"=>"Sierra Leone",
"TR"=>"Turcja",
"TO"=>"Tonga",
"TV"=>"Tuvalu",
"TT"=>"Trynidad i Tobago",
"TZ"=>"Tanzanii, Zjednoczona Republika",
"TW"=>"Tajwan",
"TF"=>"Francuskie Terytoria Południowe",
"TD"=>"Czad",
"TC"=>"Wyspy Turks i Caicos",
"TJ"=>"Tadżykistan",
"TH"=>"Tajlandia",
"TG"=>"Togo",
"TN"=>"Tunezja",
"TM"=>"Turkmenistan",
"TL"=>"Timor Wschodni",
"TK"=>"Tokelau",
"MU"=>"Mauritius",
"MT"=>"Malta",
"MW"=>"Malawi",
"MV"=>"Malediwy",
"MQ"=>"Martynika",
"MP"=>"Mariany Północne",
"MS"=>"Montserrat",
"MR"=>"Mauretania",
"MM"=>"Myanmar, Związek",
"ML"=>"Mali",
"MO"=>"Makau",
"MN"=>"Mongolia",
"MH"=>"Wyspy Marshalla",
"MK"=>"Macedonii, Była Jugosłowiańska Republika",
"MD"=>"Mołdowy, Republika",
"ME"=>"Czarnogóra",
"MG"=>"Madagaskar",
"MA"=>"Maroko",
"MC"=>"Monako",
"LY"=>"Wielka Arabska Libijska Dżamahirijja Ludowo-Socjalistyczna",
"NU"=>"Niue",
"NR"=>"Nauru",
"NP"=>"Nepal",
"NO"=>"Norwegia",
"NL"=>"Holandia",
"NI"=>"Nikaragua",
"NG"=>"Nigeria",
"NE"=>"Niger",
"NF"=>"Norfolk",
"NC"=>"Nowa Kaledonia",
"NA"=>"Namibia",
"MZ"=>"Mozambik",
"MX"=>"Meksyk",
"MY"=>"Malezja",
"OM"=>"Oman",
"NZ"=>"Nowa Zelandia",
"PT"=>"Portugalia",
"PS"=>"Terytorium Palestyny, Okupowane",
"PY"=>"Paragwaj",
"PW"=>"Palau",
"PN"=>"Pitcairn",
"PK"=>"Pakistan",
"PR"=>"Portoryko",
"PE"=>"Peru",
"PF"=>"Polinezja Francuska",
"PG"=>"Papua-Nowa Gwinea",
"PH"=>"Filipiny",
"PA"=>"Panama",
"BY"=>"Białoruś",
"BZ"=>"Belize",
"BW"=>"Botswana",
"BR"=>"Brazylia",
"BS"=>"Bahamy",
"BT"=>"Bhutan",
"BM"=>"Bermudy",
"BN"=>"Brunei Darussalam",
"BO"=>"Boliwia",
"CK"=>"Wyspy Cooka",
"CM"=>"Kamerun",
"CL"=>"Chile",
"CG"=>"Konga, Republika",
"CF"=>"Republika Środkowoafrykańska",
"CI"=>"Wybrzeże Kości Słoniowej",
"CH"=>"Szwajcaria",
"CC"=>"Wyspy Kokosowe (Keelinga)",
"CD"=>"Konga, Demokratyczna Republika",
"CA"=>"Kanada",
"CZ"=>"Czechy",
"CX"=>"Wyspa Bożego Narodzenia",
"CY"=>"Cypr",
"CV"=>"Republika Zielonego Przylądka",
"CU"=>"Kuba",
"CR"=>"Kostaryka",
"CN"=>"Chiny",
"CO"=>"Kolumbia",
"DM"=>"Dominika",
"DK"=>"Dania",
"DJ"=>"Dżibuti",
"DE"=>"Niemcy",
"AE"=>"Zjednoczone Emiraty Arabskie",
"AD"=>"Andora",
"AG"=>"Antigua i Barbuda",
"AF"=>"Afganistan",
"AI"=>"Anguilla",
"AW"=>"Aruba",
"AT"=>"Austria",
"AU"=>"Australia",
"AZ"=>"Azerbejdżan",
"AN"=>"Antyle Holenderskie",
"AO"=>"Angola",
"AL"=>"Albania",
"AM"=>"Armenia",
"AR"=>"Argentyna",
"AS"=>"Samoa Amerykańskie",
"AQ"=>"Antarktyka",
"BH"=>"Bahrajn",
"BG"=>"Bułgaria",
"BF"=>"Burkina Faso",
"BE"=>"Belgia",
"BJ"=>"Benin",
"BI"=>"Burundi",
"BD"=>"Bangladesz",
"BB"=>"Barbados",
"BA"=>"Bośnia i Hercegowina",
"GH"=>"Ghana",
"GI"=>"Gibraltar",
"GF"=>"Gujana Francuska",
"GD"=>"Grenada",
"GE"=>"Gruzja",
"GB"=>"Wielka Brytania",
"GP"=>"Gwadelupa",
"GQ"=>"Gwinea Równikowa",
"GN"=>"Gwinea",
"GL"=>"Grenlandia",
"GM"=>"Gambia",
"FR"=>"Francja",
"GA"=>"Gabon",
"HR"=>"Chorwacja",
"HK"=>"Hongkong",
"HM"=>"Wyspy Heard i McDonalda",
"HN"=>"Honduras",
"GW"=>"Gwinea Bissau",
"GY"=>"Gujana",
"GS"=>"Georgia Południowa i Sandwich Południowy",
"GR"=>"Grecja",
"GU"=>"Guam",
"GT"=>"Gwatemala",
"EC"=>"Ekwador",
"EG"=>"Egipt",
"EE"=>"Estonia",
"EH"=>"Sahara Zachodnia",
"DO"=>"Dominikana",
"DZ"=>"Algieria",
"FI"=>"Finlandia",
"FJ"=>"Fidżi",
"FK"=>"Falklandy (Malwiny)",
"FM"=>"Mikronezji, Sfederowane Stany",
"FO"=>"Wyspy Owcze",
"ES"=>"Hiszpania",
"ER"=>"Erytrea",
"ET"=>"Etiopia",
"KR"=>"Koreańska Republika Ludowo-Demokratyczna",
"KP"=>"Korei, Republika",
"KN"=>"Saint Kitts i Nevis",
"KM"=>"Komory",
"KI"=>"Kiribati",
"KH"=>"Kambodża",
"KG"=>"Kirgistan",
"KE"=>"Kenia",
"LT"=>"Litwa",
"LS"=>"Lesotho",
"LV"=>"Łotwa",
"LU"=>"Luksemburg",
"LR"=>"Liberia",
"LK"=>"Sri Lanka",
"LI"=>"Liechtenstein",
"LA"=>"Laotańska Republika Ludowo-Demokratyczna",
"LB"=>"Liban",
"KZ"=>"Kazachstan",
"KW"=>"Kuwejt",
"KY"=>"Kajmany",
"IO"=>"Brytyjskie Terytorium Oceanu Indyjskiego",
"IN"=>"Indie",
"IL"=>"Izrael",
"IS"=>"Islandia",
"IR"=>"Iranu, Islamska Republika",
"IQ"=>"Irak",
"IE"=>"Irlandia",
"ID"=>"Indonezja",
"HU"=>"Węgry",
"HT"=>"Haiti",
"JM"=>"Jamajka",
"JP"=>"Japonia",
"JO"=>"Jordania",
"IT"=>"Włochy");    
        
 ?>