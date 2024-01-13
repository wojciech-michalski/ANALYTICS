<?php
require('config/config.php');
require('controller/session_controller.php');
include('controller/konekt_MySQL.php');
include('controller/konekt_GURU.php');?>
<div class="loader">
  <div class="loading">
  </div>
</div>
<?php
//include('view/header_intro.php');
switch($_GET['mode']) {
    default:
        $dashboardactiveclass="active";
        include('view/header_intro.php');
        include('view/mainbody3.php');
        
        break;
        case "trends":
        $dashboardactiveclass="active";
        include('view/header_intro.php');
        include('view/mainbody2.php');
        
        break;
        case "analytics":
            $analactiveclass="active";
            include('view/header_intro.php');
            include('view/analytics2.php');
            break;
        case "SG":
            $analactiveclass="active";
            include('view/header_intro.php');
            include('view/SG.php');
            break;
         case "rektrend":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/rekTrend.php');   
            break;
        case "foreigners":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/cudzoziemcy.php');   
            break;
        case "zestawienie":
            $analactiveclass="active";
            include('view/header_intro.php');
             include('view/zestawienie2.php');
            break;
        case "deanreport1":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/odsiewy2.php');
            break;
         case "deanreport2":
             $deanactive="active";
             include('view/header_intro.php');
            include('view/dyplomy2.php');
            break;
        case "deanreport3":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/obrony_ranking2.php');
            break;
        case "mla":
            include('view/header_intro.php');
            include('view/mla.php');
            break;
        case "deanreport4":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/raport_rekrutacji2.php');
            break;
        case "deanreport5":
            $moneyactive="active";
            include('view/header_intro.php');
            
            switch($_POST['rozbite']){
            case "rozbite":
                include('view/raport_wplat.php');
            break;
            case "zagregowane":
                include('view/header_intro.php');
                include('view/raport_wplat_bak2.php');
                break;
            }
            break;
        case "deanreport6":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_zebrane.php');
            break;
        case "surveyprepare":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/przygotuj_ankiety.php');
            break;
        case "deanreport7":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza.php');
            break;
        case "deanreport8":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_2.php');
            break;
        case "survey1":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_3.php');
            break;
        case "survey2":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_4.php');
            break;
        case "deanreport12":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_5.php');
            break;
         case "deanreport13":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_6.php');
            break;
        case "surveycreator":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_kreator.php');
            break;
        case "asql":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_sql.php');
            break;
        case "sql_analytics":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_sql.php');
            break;
        case "ankieta_sql_edycja":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankieta_sql_edycja.php');
            break;
        
        case "solver1":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/solver1.php');
            break;
        case "solver2":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/solver2.php');
            case "solver3":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/solver3.php');
            break;
        case "solver1-1":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/solver1-1.php');
            break;
         case "solver2-1":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/solver2-1.php');
            break;
         case "solver3-1":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/solver3-1.php');
            break;
        case "deanreport15":
            $ankietyactive="active";
            include('view/header_intro.php');
            include('view/ankiety_analiza_mla.php');
            break;
        case "deanreport9":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/raport_sem_ocen.php');
            break;
         case "deanreport14":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/rank_sem_ocen.php');
            break;
        case "deanreport10":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/analiza_raportu_ocen.php');
            break;
        case "deanreport11":
            $deanactive="active";
            include('view/header_intro.php');
            include('view/przygotowanie_raportu_ocen.php');
            break;
        case "koA":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/karty_obciazenA.php');
            break;
        case "inv":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/rachunki.php');
            break;
        case "invI":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/rachunkiI.php');
            break;
         case "koI":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/karty_obciazenI.php');
            break;
        case "ko":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/karty_obciazen.php');
            break;
        case "showcardI":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/pokaz_karty_o.php');
            break;
        case "showcardA":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/pokaz_karty_oA.php');
            break;
        case "display_inv":
            $rdactive="active";
            include('view/header_intro.php');
            include('view/pokaz_rachunek.php');
            break;
         case "cDEF":
           $moneyactive="active";
            include('view/header_intro.php');
            include('view/definicja_Koszt.php');
            break;
        case "KMON":
            $analactiveclass="active";
            include('view/header_intro.php');
            include('view/kmon.php');
            break;
        case "PAPI":
            $polonactiveclass="active";
            include('view/header_intro.php');
            include('view/polon_view3.php');
            break;
}
include('view/foreignModal.php');
include('view/SG_Modal.php');
include('view/rankinOcen_Modal.php');
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
include('view/polon_Modal.php');
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
include('view/ranking_Modal.php');
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
include('view/mla_Modal.php');
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
include('view/raportRekrutacji_Modal.php');
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
include('view/wplaty_Modal.php');
include('view/odsiew_Modal.php');
include('view/nowaankieta_Modal.php');
include('view/modaLKartaObciazen.php');
include('view/modaLKartaObciazenI.php');
include('view/Modal_KMON.php');

?>


