<?php
$head="<?xml version=\"1.0\" encoding=\"utf-8\"?>
<ns0:plikStudenci xmlns:c=\"urn:polon:imp:typy-danych-student:8_0_0\" xmlns:ns0=\"urn:polon:plikStudenci:8_0_0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"urn:polon:plikStudenci:8_0_0 plikStudenci.xsd\">\n	<studenci>\n";
$plik = fopen("/var/www/html/Analytics/files/$filename", 'w');
fwrite($plik, $head);
switch($obc){
    case "PL":

//echo "SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.pesel<>'' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')";
$studenci=mysqli_query($kon,"SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.pesel<>'' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')");

$ile=mysqli_num_rows($studenci);
$i=0;
	do {
	$student=mysqli_fetch_array($studenci);
	$i=$i+1;
	//$data_ur=explode("-",$student['DATA_UR']);
        $pes=$student['pesel'];
        $data_urodzenia=$student['data_urodzenia'];
	$rok_urodzenia="$data_urodzenia[0]$data_urodzenia[1]$data_urodzenia[2]$data_urodzenia[3]";
		switch($student['polon_miejsc']){
		case "BRAK":
		$miastowies="miasto";
		break;
		case "WIEŚ":
		$miastowies="wies";
		break;
		default:
		$miastowies="miasto";
		break;}	
                switch ($student['plec']){
                    case "kobieta":
                        $plec="K";
                        break;
                    case "mężczyzna":
                        $plec="M";
                        break;
                }
              //  switch($student['typ_semestru']){
              //      case "L":
               //         $typ_semestru=2;
               //         break;
                //    case "Z":
                 //       $typ_semestru=1;
                 //       break;
             //   }
                switch ($student['data_rozp_polon']){
                    default:
                        $data_rozp=$student['data_rozp_polon'];
                        break;
                    case "":
                        $data_rozp=$student['data_rozpoczecia'];
                        break;
                }
                if($data_rozp!=="BRAK"&&isset($rok_urodzenia)&&$rok_akademicki==$rok_zdefiniowany&&$student['numer_semestru']!=="") {
             //$codequery= "SELECT `KOD_URUCHOMIENIA` FROM `kierunki_kody` WHERE `NAZWA_KIERUNKU`='$kierunki__' AND `STOPIEN`='$typy__' AND `FORMA`='$rodzaje__'";   
	//$kod_uruchomienia=mysqli_fetch_array(mysqli_query($kon,$codequery));			
	$wiersz="<student>
			
			<osoba>
				<!--Dane osobowe studenta-->
				<imie1>".$student['imie']."</imie1>
				<nazwisko>".$student['nazwisko']."</nazwisko>
				<cudzoziemiec>N</cudzoziemiec>
				<plec>$plec</plec>
				<rokUrodzenia>$rok_urodzenia</rokUrodzenia>
				<pesel>$pes</pesel>
				<obywatelstwo>PL</obywatelstwo>
				<kartaPolaka>N</kartaPolaka>
			</osoba>
			<daneDotyczaceStudiow>
				
				<studia>
					
					<dataRozpoczecia>$data_rozp</dataRozpoczecia>
					<miejsceZamieszkania>$miastowies</miejsceZamieszkania>
					<proceduraOdwolaniaOdSkreslenia>N</proceduraOdwolaniaOdSkreslenia>
					<uruchomienieKod>".$student['kod_uruchomienia']."</uruchomienieKod>
					<realizujeKsztalcenieZawodNauczyciela>N</realizujeKsztalcenieZawodNauczyciela>
					<realizujeKsztalcenieStudiaWspolne>N</realizujeKsztalcenieStudiaWspolne>
				</studia>
				<semestry>
					<!--Semestry-->
					<semestr>
						<!--Semestr studiów-->
						<daneSemestru>
							<!--Dane semestru studiów-->
							<rokAkademicki>$rok_akademicki</rokAkademicki>
							<semestrNr>$typ_semestru</semestrNr>
							<semestrStudenta>".$student['numer_semestru']."</semestrStudenta>
							<rekrutacjaBezPodzialuNaKierunki>N</rekrutacjaBezPodzialuNaKierunki>
						</daneSemestru>
						<ects>
							<!--Punkty ects dla semestru-->
							<ectsUzyskane>".$student['ects']."</ectsUzyskane>
						</ects>
					</semestr>
					
				</semestry>
				
			</daneDotyczaceStudiow>
		</student>";
	
fwrite($plik, $wiersz);

                }
                else $errorarray[]="$pes ".$student['kod_uruchomienia']." $rok_urodzenia $data_rozp";
			}
		while ($i<$ile);
	
        break;
        
                    case "OBC":
                    //    echo "SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.obywatelstwo<>'PL' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')";
            $studenci=mysqli_query($kon,"SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.obywatelstwo<>'PL' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')");

$ile=mysqli_num_rows($studenci);
$i=0;
	do {
	$student=mysqli_fetch_array($studenci);
	$i=$i+1;
	//$data_ur=explode("-",$student['DATA_UR']);
        
        $data_urodzenia=$student['data_urodzenia'];
	$rok_urodzenia="$data_urodzenia[0]$data_urodzenia[1]$data_urodzenia[2]$data_urodzenia[3]";
		switch($student['polon_miejsc']){
		case "BRAK":
		$miastowies="miasto";
		break;
		case "WIEŚ":
		$miastowies="wies";
		break;
		default:
		$miastowies="miasto";
		break;}	
                switch ($student['plec']){
                    case "kobieta":
                        $plec="K";
                        break;
                    case "mężczyzna":
                        $plec="M";
                        break;
                }
              //  switch($student['typ_semestru']){
              //      case "L":
               //         $typ_semestru=2;
               //         break;
                //    case "Z":
                 //       $typ_semestru=1;
                 //       break;
             //   }
                switch ($student['data_rozp_polon']){
                    default:
                        $data_rozp=$student['data_rozp_polon'];
                        break;
                    case "":
                        $data_rozp=$student['data_rozpoczecia'];
                        break;
                }
                if($data_rozp!=="BRAK"&&isset($rok_urodzenia)&&$rok_akademicki==$rok_zdefiniowany&&$student['numer_semestru']!==""&&$student['dokument_nr']!=="") {
             //$codequery= "SELECT `KOD_URUCHOMIENIA` FROM `kierunki_kody` WHERE `NAZWA_KIERUNKU`='$kierunki__' AND `STOPIEN`='$typy__' AND `FORMA`='$rodzaje__'";   
	//$kod_uruchomienia=mysqli_fetch_array(mysqli_query($kon,$codequery));			
	$wiersz="<student>
			
			<osoba>
				<!--Dane osobowe studenta-->
				<imie1>".$student['imie']."</imie1>
				<nazwisko>".$student['nazwisko']."</nazwisko>
				<cudzoziemiec>T</cudzoziemiec>
                                <krajPochodzenia>".$student['obywatelstwo']."</krajPochodzenia>
				<plec>$plec</plec>
				<rokUrodzenia>$rok_urodzenia</rokUrodzenia>
				<dokTozsamRodzaj>PS</dokTozsamRodzaj>
				<dokTozsamNumer>".$student['dokument_nr']."</dokTozsamNumer>
				<dokTozsamKrajKod>".$student['obywatelstwo']."</dokTozsamKrajKod>
				<obywatelstwo>".$student['obywatelstwo']."</obywatelstwo>
				<panstwoUrodzenia>".$student['obywatelstwo']."</panstwoUrodzenia>
				<kartaPolaka>N</kartaPolaka>
			</osoba>
			<daneDotyczaceStudiow>
				
				<studia>
					
					<dataRozpoczecia>$data_rozp</dataRozpoczecia>
					<miejsceZamieszkania>$miastowies</miejsceZamieszkania>
                                            <podstawaStatusuStudiowania>
						<podstawa>
							<status>PSC1</status>
							<dataOd>$data_rozp</dataOd>
						
						</podstawa>
						
					</podstawaStatusuStudiowania>
					<proceduraOdwolaniaOdSkreslenia>N</proceduraOdwolaniaOdSkreslenia>
					<uruchomienieKod>".$student['kod_uruchomienia']."</uruchomienieKod>
					<realizujeKsztalcenieZawodNauczyciela>N</realizujeKsztalcenieZawodNauczyciela>
					<realizujeKsztalcenieStudiaWspolne>N</realizujeKsztalcenieStudiaWspolne>
				</studia>
				<semestry>
					<!--Semestry-->
					<semestr>
						<!--Semestr studiów-->
						<daneSemestru>
							<!--Dane semestru studiów-->
							<rokAkademicki>$rok_akademicki</rokAkademicki>
							<semestrNr>$typ_semestru</semestrNr>
							<semestrStudenta>".$student['numer_semestru']."</semestrStudenta>
							<rekrutacjaBezPodzialuNaKierunki>N</rekrutacjaBezPodzialuNaKierunki>
						</daneSemestru>
						<ects>
							<!--Punkty ects dla semestru-->
							<ectsUzyskane>".$student['ects']."</ectsUzyskane>
						</ects>
					</semestr>
					
				</semestry>
				
			</daneDotyczaceStudiow>
		</student>";
	
fwrite($plik, $wiersz);

                }
                else $errorarray[]=$student['dokument_nr']." ".$student['kod_uruchomienia']." $rok_urodzenia $data_rozp";
			}
		while ($i<$ile);
	
        break;
}
$stopka="</studenci>
</ns0:plikStudenci>" ;       
        
	fwrite($plik, $stopka);	
		fclose($plik);
                
		shell_exec("zip /var/www/html/Analytics/files/$filename.zip /var/www/html/Analytics/files/$filename");

		?>

<body>
  <!-- Main navigation -->
  <header>
    <!--Navbar-->
 <?php include('view/mainmenu.php');?>
    <!-- Full Page Intro -->
    <div class="view" style="background-image: url('view/img/wseiz_background.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <!-- Mask & flexbox options-->
      <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
        <!-- Content -->
        <div class="container">
          <!--Grid row-->
          <div class="row">
            <!--Grid column-->
            <div class="col-md-6 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
              
                <a href="<?php echo "../files/$filename.zip";?>"><button type="button" class="btn btn-warning">Pobierz XML</button></a>
              <hr class="hr-light">
              <p>Błędne dane (PESEL, kod uruchomienia rok urodzenia data rozpoczęcia studiów)</p>
     <?php print_r($errorarray);?>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-6 col-xl-5 mt-xl-5 wow fadeInRight" data-wow-delay="0.3s">
              <img src="view/img/admin-new.png" alt="" class="img-fluid">
            </div>
            <!--Grid column-->
          </div>
          <!--Grid row-->
        </div>
        <!-- Content -->
      </div>
      <!-- Mask & flexbox options-->
    </div>
    <!-- Full Page Intro -->
  </header>
  <!-- Main navigation -->
  <!--Main Layout-->
  <!--<main>
    <div class="container">
      
      <div class="row py-5">
        
      </div>
      
    </div>
  </main>-->
  <!--Main Layout-->
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
</body>

</html>