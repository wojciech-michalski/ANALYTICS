<?php
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');
include('konekt_GURU.php');

 $nr_rachunku=base64_decode($_GET['nr']);
 $nrnoslash=str_replace("/","-",$nr_rachunku);
    $rach_details=mysqli_fetch_array(mysqli_query($kon,"SELECT `id_pozycje`,`pesel`,`data`,`wykladowca_imie`,`wykladowca_nazwisko` FROM `rachunki` WHERE `numer`='$nr_rachunku'"));
    $details_array=explode(",",$rach_details[0]);
    foreach($details_array as $element){
        $elementquery="SELECT * FROM `pozycje_rachunkow` WHERE `id`=$element";
       // echo "$elementquery <br/>";
      $wiersz=mysqli_fetch_array(mysqli_query($kon,$elementquery)); 
      $tyt_zaw=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` WHERE `wykladowca_imie`='$rach_details[wykladowca_imie]' "
              . "AND `wykladowca_nazwisko`='$rach_details[wykladowca_nazwisko]'"));
      $posarray[]=array(
              "przedmiot"=> $wiersz['przedmiot'],
              "symbol"=>$wiersz['symbol_studiow'],
              "c"=>$wiersz['c'],
              "w"=>$wiersz['w'],
              "l"=>$wiersz['l'],
              "p"=>$wiersz['p'],
              "s"=>$wiersz['s'],
              "miesiac"=>$wiersz['miesiac'],
              "rok_akademicki"=>$wiersz['rok_akademicki'],
              "pesel"=>$wiersz['pesel']
      );
}

        $pesel=$rach_details[1];   
require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    require dirname(__FILE__).'/view/pdf/rachunek.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'en');
    $html2pdf->setDefaultFont('DejaVuSerif');
    $html2pdf->writeHTML($content);
    $html2pdf->output("$wiersz[imie]$wiersz[nazwisko]$nrnoslash.pdf");
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}



//$html2pdf = new Html2Pdf();
//$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
//$html2pdf->output("$wiersz[imie]$wiersz[nazwisko]$nrnoslash.pdf", 'D'); 
