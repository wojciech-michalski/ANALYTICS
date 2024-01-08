<!DOCTYPE html>
<html>
    <?php
            
            require_once('views/head.php');
            if($_GET['ankieta']=='sql') {
                include('views/ankieta_sql.php');
                  
                die();
            }
            else 
            if(!is_numeric($_GET['p'])) die ('<script>alert("nie dostałem przedmiotu i wykładowcy")</script>'); 
                else
                    $id_prowadzacy=$_GET['p'];
            if($_GET['ankieta']!='ow' && $_GET['ankieta'] !='onp'&& $_GET['ankieta'] !='opz'&& $_GET['ankieta'] !='oa'&& $_GET['ankieta'] !='covid') die ('<script>alert("nie dostałem rodzaju ankiety")</script>');
                else
            $an=$_GET['ankieta'];
            require_once('config/config.php');
            require('konekt_MySQL.php');
            $naglowek=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM `prowadzacy` WHERE `id`='$id_prowadzacy'"));
            $grupa=$naglowek['grupa'];
            $group_array=explode(" ",$grupa);
            $semestr=$group_array[1];
            switch ($semestr) {
                case "I":
                    case"II":
                        $rok_studiow=1;
                        break;
                case "III":
                case "IV":
                    $rok_studiow=2;
                        break;
                      case "V":
                    case"VI":
                        $rok_studiow=3;
                        break;
                case "VII":
                case "VIII":
                    $rok_studiow=4;
                        break;
            }
            if($naglowek['forma']==''){
            if ($grupa[0]=='D') $forma="stacjonarne";
                else $forma="niestacjonarne";
            }
                else $forma=$naglowek['forma'];
                
            echo "<body>";
            switch ($an){
                case "oa":
                    $ankieta="ocena_administracji2";
                    $pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta' AND `typ`='radio'");
                    include('views/ankieta_administracji.php');
                    break;
                case "ow":
                    $ankieta="ocena_pracy_nauczyciela";
                    $pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta' AND `typ`='radio'");
                    include('views/ankieta_wykladowcy.php');
                    break;
                    
                case "onp":
                    $ankieta="ocena_nakladu_pracy_studenta";
                    $pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta' AND `typ`='text'");
                    $pytania_radio=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta' AND `typ`='radio'");
                    include('views/ankieta_nakladu.php');
                    $id_przedmiot=$_GET['p'];
                    break;
                 case "opz":
                    $forma=$naglowek['forma'];
                    $ankieta="ocena_praktyk_zawodowych";
                    $pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta' AND `typ`='radio'");
                    include('views/ankieta_praktyk.php');
                    $id_przedmiot=$_GET['p'];
                    break;
                case "covid":
                    //$forma=$naglowek['forma'];
                    $ankieta="covid-19-2021";
                    $pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta'");
                    include('views/ankieta_covid19.php');
                    //$id_przedmiot=$_GET['p'];
                    break;
                 case "rezygnacje":
                    //$forma=$naglowek['forma'];
                    $ankieta="rezygnacje";
                    $pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$ankieta'");
                    include('views/ankieta_rezygnacje.php');
                    //$id_przedmiot=$_GET['p'];
                    break;
            }
            
            require_once('views/footer.php');
            //teraz trochę Javasriptu muszę wygenerować...
           
    $kk=1;
    do {
    echo "<script>
        $('#materialUnchecked$kk').change(function () {
    if(this.checked) {
        $('#inputLGEx$kk').prop('required',false);
    } else {
        $('#inputLGEx$kk').prop('required',true);
    }
});

        </script>";
    $kk=$kk+1;
    }
    while ($kk<$ile_pytan);
    
    ?>
    <script>
               
$('#wu').hide();
$('#pyc').hide();       
function pokaz_wu() {
$('#wu').show();
};
function schowaj_wu() {
$('#wu').hide();
};
function pokaz_pyc() {
$('#pyc').show();
};
function schowaj_pyc() {
$('#pyc').hide();
};
</script>
</html>
