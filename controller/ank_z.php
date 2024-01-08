<?php
    $listaankiet=mysqli_query($kon,"SELECT DISTINCT `ankieta`,`nazwa` FROM `metryki` WHERE `nazwa`<>'' AND `html` IS NULL");
    $ile_ankiet=mysqli_num_rows($listaankiet);
    function dane_ankiety($sqlconnection,$ankieta) {
        //ilość ankiet pierwsza, ostatnia, ilość pytań
        $ile_ankiet=mysqli_num_rows(mysqli_query($sqlconnection,"SELECT `id` FROM `$ankieta` WHERE 1"));
        $ostatnia_ankieta=mysqli_fetch_array(mysqli_query($sqlconnection,"SELECT MAX(`data`) FROM `$ankieta`"));
        $pierwsza_ankieta=mysqli_fetch_array(mysqli_query($sqlconnection,"SELECT MIN(`data`) FROM `$ankieta`"));
        $ilosc_pytan=mysqli_num_rows(mysqli_query($sqlconnection,"SELECT `id` FROM `metryki` WHERE `ankieta`='$ankieta'"));
        return array(
            "wypelniono"=>$ile_ankiet,
            "data_first"=>$pierwsza_ankieta[0],
            "data_last"=>$ostatnia_ankieta[0],
            "ilosc_pytan"=>$ilosc_pytan
        );
    }
    
 
		?>
