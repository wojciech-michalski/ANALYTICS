<?php
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');
//print_r($_POST);
  $ustawienia_filtra=$_POST['dane_filtra'];
  if($ustawienia_filtra==1){
      $_SESSION['ustawienia_filtra']=array(
          'data' =>$_POST['data'],
          'kolumny' => $_POST['kolumny'],
          'kierunki' => $_POST['kierunki'],
          'typy' => $_POST['typy'],
          'rodzaje' => $_POST['rodzaje'],
          'own' => $_POST['own'],
          'statusy' => $_POST['statusy'],
          'tytuly' => $_POST['tytuly']
  );
  }
  else {unset($_SESSION['ustawienia_filtra']);}
  $querystart="SELECT";
  //print_r($_POST);
  foreach($_POST['typy'] as $qtypy) {
  $typarray[]="mapowanie.stopien='$qtypy'";
  $typtextarray[]="<li>Stopień=$qtypy</li>";
 }
 if($_POST['own']!=='') {
     $own="AND (".$_POST['own'].")";
     //$owntext=str_replace("\'","\\'");
 }
 else {$own="";}
 foreach($_POST['rodzaje'] as $qrodzaje) {
   $rodzajarray[]="mapowanie.forma='$qrodzaje'";
   $rodzajtextarray[]="<li>Forma=$qrodzaje</li>";
 } foreach($_POST['tytuly'] as $qtytuly) {
   $tytularray[]="mapowanie.tytul='$qtytuly'";
   $tytultextarray[]="<li>Tytuł zawodowy=$qtytuly</li>";
 }
 foreach($_POST['kierunki'] as $qkierunki) {
   $kierarray[]="mapowanie.kierunek='$qkierunki'";
   $kiertextarray[]="<li>Kierunek studiów=$qkierunki</li>";
 }
 foreach($_POST['statusy'] as $qstatusy) {
   $statusarray[]="studenci.status_studenta='$qstatusy'";
   $statustextarray[]="<li>Status=$qstatusy</li>";
 }
 $statusstring=implode(" OR ",$statusarray);
 $kierstring=implode(" OR ",$kierarray);
 $typstring=implode(" OR ",$typarray);
 $rodzajstring=implode(" OR ",$rodzajarray);
         $tytulstring=implode(" OR ",$tytularray);
 //echo "SELECT DISTINCT ".$_POST['kolumny']." FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($statusstring) AND ($rodzajstring) $own";
 $querymiddle="FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($tytulstring) AND ($statusstring) AND ($rodzajstring) AND ($typstring) $own";    
 $tabheaders=mysqli_query($kon,"SELECT DISTINCT ".$_POST['kolumny']." FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($tytulstring) AND ($statusstring) AND ($rodzajstring) AND ($typstring) AND ($tytulstring) $own");
 $ilekolumn=mysqli_num_rows($tabheaders);
 $k=0;
 $zapytanie= "$querystart ".$_POST['kolumny']." $querymiddle";
 //echo $zapytanie;
 
       include('view/topnav.php');
       ?>
    <script><!-- comment -->
        function copytable(el) {
    var urlField = document.getElementById(el);   
    var range = document.createRange();
    range.selectNode(urlField);
    window.getSelection().addRange(range) ;
    document.execCommand('copy');
    toastr.info('Tabela skopiowana');
}
</script>
       <div class="row" style="margin-top:70px;">
           <div class="col-md-2">
               <?php
       include('view/sidenav.php');
       switch($_POST['kolumny']){
    case 'plec':
        $temat="Rozkład płci wg wskazanego filtra";
        break;
    default:
        $temat=$_POST['kolumny'];
        break;
    case 'obywatelstwo':
        $temat="Rozkład obywatelstw wg wskazanego filtra";
        break;
    case 'numer_semestru':
        $temat="Rozkład numerów semestrów wg wskazanego filtra";
        break;
    case 'specjalnosc_nazwa':
        $temat="Rozkład specjalności wg wskazanego filtra";
        break;
    case 'polon_miejsc':
        $temat="Rozkład typów miejscowości zamieszkania wg POLON dla wskazanego filtra";
        break;
    case 'stypendium_rodzaj':
        $temat="Rozkład rodzajów pobieranych stypendiów dla wskazanego filtra";
        break;
    case 'mapowanie.profil':
        $temat="Rozkład profili studiów dla wskazanego filtra";
        break;
    case 'mapowanie.forma':
        $temat="Rozkład form studiów dla wskazanego filtra";
        break;
    case 'mapowanie.stopien':
        $temat="Rozkład stopni studiów dla wskazanego filtra";
        break;
    case 'mapowanie.kierunek':
        $temat="Rozkład kierunków studiów dla wskazanego filtra";
        break;
     case 'status_studenta':
        $temat="Rozkład statusów studentów dla wskazanego filtra";
        break;
}
           ?>
           </div>
        <div class="col-md-10" style="padding-left:5%">
                 <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Analytics</a>
            <span>/</span>
            <span>Zbieranie danych i analiza</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
       
     <div class="card">
<div class="card-header text-center">
        Pokazuję <?php echo $temat;?> dla daty: <?php echo $_POST['data'];?>  <hr/>
        <nav class="navbar navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container-fluid">
        <ul class="navbar-nav nav-flex-icons">
           
         <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             <a href="exports/csv/export.csv" >
         <span class="tmi" style="padding-left:0.1rem;" title="pobierz csv">
             <i class="fas fa-file-csv prefix fa-lg info-text" ></i></span></a></li>
             <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             <a href="#" onclick="generatePDF_2();">
         <span class="tmi" style="padding-left:0.1rem;" title="generuj pdf">
             <i class="fas fa-file-pdf prefix fa-lg red-text" ></i></span></a></li>
             <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             <a href="#" onclick="toastr.info('<ul style=\'font-size:0.8em;\'><?php echo implode("",$statustextarray);
                echo implode ("",$kiertextarray);
                echo implode ("",$rodzajtextarray);
                echo implode("",$typtextarray);
                echo implode("",$tytultextarray);
                //echo $owntext;
                ?></ul>',{timeOut: 8000});">
         <span class="tmi" style="padding-left:0.1rem;" title="pokaż zastosowane filtry">
             <i class="fas fa-filter prefix fa-lg green-text" ></i></span></a></li>
             <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             <a href="#" id="trans">
         <span class="tmi" style="padding-left:0.1rem;" title="transponuj tabelę">
             <i class="fas fa-retweet prefix fa-lg info-text" ></i></span></a></li>
              <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             <a href="#" onclick="copytable('pyc666');">
         <span class="tmi" style="padding-left:0.1rem;" title="kopiuj tabelę">
             <i class="fas fa-table prefix fa-lg info-text" ></i></span></a></li>
        </ul> </div></nav>
        <!-- <a href="#" id="trans"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>
        <button class="btn btn-default" onclick="generatePDF_2();" style="margin-left:20%"><i class="fas fa-file-pdf"  ></i> do PDF</button>-->
       </div>
<div class="card-body" id="k2pdf">

       
          <!--      <a data-html2canvas-ignore="true" class="btn btn-sm btn-info" onclick="toastr.info('<ul style=\'font-size:0.8em;\'><?php echo implode("",$statustextarray);
                echo implode ("",$kiertextarray);
                echo implode ("",$rodzajtextarray);
                echo implode("",$typtextarray);
                echo implode("",$tytultextarray);
                //echo $owntext;
                ?></ul>',{timeOut: 8000});">Pokaż zastosowane filtry</a>
    <a data-html2canvas-ignore="true" class="btn btn-sm btn-success" id="trans">Transponuj</a>-->
        <div class="row">
            
                  <table class="table table-hover table-responsive w-auto" id="pyc666">
                      <tr><?php do {
                          $kolumna=mysqli_fetch_array($tabheaders);
                      $k=$k+1;
                      switch($kolumna[0]) {
                          default:
                               echo "<th>$kolumna[0]</th>";
                              $csvhead[]="\"$kolumna[0]\"";
                              break;
                              case '':
                               echo "<th>BRAK</th>"; 
                                   $csvhead[]="\"BRAK\"";
                                  break;
                              
                      }
                     
                      $nextquerycolumns[]=$kolumna[0];
                      }
                      while($k<$ilekolumn);
                      ?></tr><tr>
                      <?php
                      foreach ($nextquerycolumns as $column){
                         // echo "SELECT studenci.id` FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($statusstring) AND ($rodzajstring) AND ".$_POST['kolumny']."='$column' ";
                          $countquery=mysqli_num_rows(mysqli_query($kon,"SELECT studenci.id FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND($typstring) AND($tytulstring) AND ($statusstring) AND ($rodzajstring) AND ".$_POST['kolumny']."='$column' $own "));
                          echo "<td>$countquery</td>";
                          $ilosci[]=$countquery;
                           $csvrow[]="\"$countquery\"";
                          
                      }
                      $csvfirstrow=implode(";",$csvhead);
                      $csvrows[]=implode(";",$csvrow);
                      $csvrestrows=implode("\n",$csvrows);
                       $csvcomplete="$csvfirstrow \n $csvrestrows";
    //$csv=fopen('/var/www/html/naklad_pracy/MP/csv/export.csv',w);
    file_put_contents('/var/www/html/Analytics/exports/csv/export.csv', $csvcomplete);
                      ?>
                      </tr>
                      <tr><th colspan="<?php echo $ilekolumn-1;?>">Znalezionych rekordów:</th><th><?php echo mysqli_num_rows(mysqli_query($kon,$zapytanie));?></th></tr>
                  </table>
        </div>
            <div class="row">
    <?php include('controller/generuj_wykres.php');?>
        <div id="chartContainer" class="img img-responsive" style="width: 100%; height:450px;"></div>
            </div></div>
              

         
          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>
    <?php// include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>
  <script>
 
  $("#trans").click(function(){
     
    $("table").each(function() {
        var $this = $(this);
        var newrows = [];
        $this.find("tr").each(function(){
            var i = 0;
            $(this).find("td, th").each(function(){
                i++;
                if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                if(i == 1)
                    newrows[i].append("<th>" + this.innerHTML  + "</th>");
                else
                    newrows[i].append("<td>" + this.innerHTML  + "</td>");
            });
        });
        $this.find("tr").remove();
        $.each(newrows, function(){
            $this.append(this);
        });
    });
    
    return false;
});

document.getElementsByClassName("loader")[0].style.display = "none";
async function copyImgToClipboard(imgUrl) {
  try {
    const data = await fetch(imgUrl);
    const blob = await data.blob();
    await navigator.clipboard.write([
      new ClipboardItem({
        [blob.type]: blob,
      }),
    ]);
    console.log('Image copied.');
  } catch (err) {
    console.error(err.name, err.message);
  }
}


  </script>
  
  
 
</body>

</html>

