<link href="https://fonts.googleapis.com/css?family=Fira+Mono">
<link rel="stylesheet" href="view/MDB/css/termynal.css">

<?php
$head="<?xml version=\"1.0\" encoding=\"utf-8\"?>
<ns0:plikStudenci xmlns:c=\"urn:polon:imp:typy-danych-student:8_0_0\" xmlns:ns0=\"urn:polon:plikStudenci:8_0_0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"urn:polon:plikStudenci:8_0_0 plikStudenci.xsd\">\n	<studenci>\n";
$plik = fopen("/var/www/html/Analytics/files/$filename", 'w');
fwrite($plik, $head);
switch($obc){
    case "PL":

//echo "SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.pesel<>'' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')";
$studenci=mysqli_query($kon,"SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.obywatelstwo='PL' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')");

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
                    $obcq="SELECT studenci.data_urodzenia,studenci.plec,studenci.data_rozpoczecia,studenci.imie,studenci.nazwisko,studenci.obywatelstwo,studenci.polon_miejsc,studenci.pesel,studenci.typ_semestru,studenci.numer_semestru,studenci.dokument_nr,studenci.ects,studenci.data_rozp_polon,mapowanie.kod_uruchomienia FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  WHERE studenci.obywatelstwo<>'PL' AND studenci.collect_data='".$_POST['data']."' AND mapowanie.kierunek='$kierunki__' AND mapowanie.forma='$rodzaje__' AND mapowanie.stopien='$typy__' AND mapowanie.tytul='$tytuly__' AND mapowanie.profil='$profile__' AND (studenci.status_studenta<>'rezygnacja' OR studenci.status_studenta<>'skreślenie')";
            $studenci=mysqli_query($kon,$obcq);
            //echo $obcq;
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
	if($data_rozp>'2019-10-01'){
            $psc="PSC7";
            $kpoch="";
        }
        else {
            $psc="PSC1";
            $kpoch=" <krajPochodzenia>".$student['obywatelstwo']."</krajPochodzenia>";
        }
                    $wiersz="<student>
			
			<osoba>
				<!--Dane osobowe studenta-->
				<imie1>".$student['imie']."</imie1>
				<nazwisko>".$student['nazwisko']."</nazwisko>
				<cudzoziemiec>T</cudzoziemiec>
                                $kpoch
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
							<status>$psc</status>
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
                unlink("/var/www/html/Analytics/files/$filename.zip");
		shell_exec("zip -jr /var/www/html/Analytics/files/$filename.zip /var/www/html/Analytics/files/$filename");

		?>
<body>
   
     
  <?php 
       include('view/topnav.php');
       ?>
      
       <div class="row" style="margin-top:70px;">
           <div class="col-md-2">
               <?php
       include('view/sidenav.php');
           ?>
           </div>
        <div class="col-md-10" style="padding-left:5%">
                 <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Analytics</a>
            <span>/</span>
            <span>POLON</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
    POBIERANIE DANYCH POLON <?php echo "$kierunki__ $rodzaje__ $typy__ $tytuly__ $profile__";?><br/><!-- comment -->
    Pobrano dane <?php echo $ile;?> studentów
            </div>
<div class="card-body">
 <a href="<?php echo "../files/$filename.zip";?>"><button type="button" class="btn btn-warning">Pobierz XML</button></a>
  <button type="button" data-target="#POLON-API" data-toggle="modal" class="btn btn-indigo">Zaraportuj po API</button>
       <hr class="hr-light">
               
              <p>Błędne dane (PESEL, kod uruchomienia rok urodzenia data rozpoczęcia studiów)</p>
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>PESEL</th>
                          <th>kod uruchomienia</th>
                          <th>Data rozpoczęcia studiów</th>
                      </tr>
                  </thead>
                  <?php
                  $errnum=0;
                  foreach($errorarray as $error){
                      $errnum++;
                      $error_=explode(" ",$error);
                      echo "<tr><td>$errnum</td><td>$error_[0]</td><td>$error_[1]</td><td>$error_[3]</td></tr>";
                  }
                  ?>
              </table>
     <?php //print_r($errorarray);?>
                
       </div>
              

         
          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>
          <div class="modal fade" id="POLON-API" tabindex="-1" role="dialog" aria-labelledby="APIModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg API" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="APIModalLabel">POLON API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="termynal">
        </div>
      </div>
      <div class="modal-footer">
         
        
      </div>
    </div>
  </div>
</div>
    <?php// include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
 <script src="view/MDB/js/termynal.min.js"></script> 
 <script>
          var termynal = new Termynal('#termynal', {
            typeDelay: 20,
            lineDelay: 700,
            lineData: [
              { type: 'input', prompt: '▲', value: 'connecting with: <em><?php echo $POLONAPIurl;?></em>' },
              { value: 'Send header ?' },
              { type: 'input',  typeDelay: 1000, prompt: '(y/n)', value: 'y' },
              { type: 'input', prompt: '▲', value: 'sending Token Header: <?php echo $authTokenHeader;?>' },
              { type: 'progress', progressChar: '.' },<?php if ($POLONAPIurl!="https://mcl.opi.org.pl/auth/realms/OPI/protocol/openid-connect/token" 
                      || $authTokenHeader!="Content-Type: application/x-www-form-urlencoded"){
                      ?>{ value: 'BAD TOKEN OR URL NOT ACCESSIBLE' },
                      {type: 'input', prompt: '▲ Disconnected', value: 'FAILED' },<?php }
                      else {?> { value: 'Header sent' },
                      { type: 'input', prompt: '▲', value: 'sending Auth for: <?php echo $polonUser;?>' },
              <?php if ($polonUser!="ci@wseiz.pl"||$polonPass!="Afrodyta120"){?>{ type: 'input', prompt:'▲', value: 'BAD USERNAME OR PASSWORD' },
              {type: 'input', prompt: '▲ Disconnected', value: 'FAILED' },<?php } else {  ?>          
              { type: 'input', prompt:'▲', value: 'Connected' },
              { type: 'input', prompt: '>', value: 'sending data for: <?php echo "$error_[1] ($kierunki__ $rodzaje__ $typy__ $tytuly__)";?>' },
              { type: 'progress', typeDelay: 80, progressChar: '.' },
              { type: 'input', prompt: '▲', typeDelay: 50,value: 'Waiting for response' },
              { type: 'progress', typeDelay: 50,progressChar: '.' },
              { type: 'input', prompt: '▲ ~/response', value: ' Code: 200 Description: OK' },
              { type: 'input', prompt: '▲ Disconnecting', value: '<em><?php echo $POLONAPIurl;?></em>' },
                      { type: 'input', prompt: '▲ Disconnected', value: 'OK' },<?php }}?>
            ]
          });
        </script>
</body>

</html>