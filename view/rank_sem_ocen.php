  <?php 
  //określam semestr i rok akademicki
  if(!is_numeric($_GET['rb'])) {
      die('Błędny rok akademicki');
  }  else {
  $rok_badany=$_GET['rb'];
  }
  $WIiZ=array("Zarządzanie","Zarządzanie i Inżynieria Produkcji","Management","Zarządzanie UA","Ochrona Środowiska",
      "Mechanika i Budowa Maszyn","Informatyka","Computer Engineering","Zdrowie Publiczne");
  $WA=array("Architektura","Architecture","AW","Architektura Wnętrz","Architektura Krajobrazu","Wzornictwo",
      "Budownictwo");
  $wzqs=implode("' OR `kierunek`='",$WIiZ);
  $warunek_na_wydzialZ=" AND (`kierunek`='$wzqs')";
  $wzfq="SELECT `przedmiot` FROM `analiza_ocen` "
          . "WHERE `rok_akademicki`='$rok_badany' $warunek_na_wydzialZ AND `forma_zaliczenia`<>'Zaliczenie' GROUP BY `przedmiot`";
 
  $wAqs=implode("' OR `kierunek`='",$WA);
  $warunek_na_wydzialA=" AND (`kierunek`='$wAqs')";
  $wAfq="SELECT `przedmiot` FROM `analiza_ocen` "
          . "WHERE `rok_akademicki`='$rok_badany' $warunek_na_wydzialA AND `forma_zaliczenia`<>'Zaliczenie' GROUP BY `przedmiot`";
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
            <span>RAPORT OCEN</span>
            <span>/</span>
            <span>NAJNIŻSZE I NAJWYŻSZE ŚREDNIE</span>
          </h4>

         

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
          <?php //include ('controller/raport_semestralny_ocen.php');
         ?>
         
     
         

         
         <div class="card-header text-center"></div>
          
<div class="card-body">
    <ul class="nav md-pills nav-justified pills-success">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel11" role="tab">Wydział Inżynierii i Zarządzania</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel12" role="tab">Wydział Architektury</a>
    </li>
    
</ul>

<!-- Tab panels -->
<div class="tab-content">

    <!--Panel 1-->
    <div class="tab-pane fade in show active" id="panel11" role="tabpanel">
       
        <table id="dtMaterialDesignExample1" class="table table-striped table-condensed" cellspacing="0" width="90%">
            <thead>
            <tr> <th>Przedmiot</th>
                <th>Średnia ocen</th>
                <th>Liczba zdających</th>
                <th>Sprawność całkowita</th></tr></thead><!-- comment -->
            <tbody>
        <?php //echo $wzfq;
        //teraz liczę średnią dla przedmiotu, gdzie nieobecność i brak oceny to 2
        $przedmiotyWZ=mysqli_query($kon,$wzfq);
        foreach($przedmiotyWZ as $przedmiot){
            //wyciągam ilość zdających
            $q="SELECT `id` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' $warunek_na_wydzialZ "
                    . "AND `przedmiot`='$przedmiot[przedmiot]'";
            $iloscS=mysqli_num_rows(mysqli_query($kon,$q));
            //teraz wyciągam sumę ocen i liczę średnią
           
            $q2="SELECT SUM(`ocena_calkowita`) FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' "
                    . "$warunek_na_wydzialZ AND `przedmiot`='$przedmiot[przedmiot]' AND `ocena_calkowita`<>'' ";
            $q3="SELECT `id` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' "
                    . "$warunek_na_wydzialZ AND `przedmiot`='$przedmiot[przedmiot]' AND `ocena_calkowita`=''";
            $sumaOzerowych=mysqli_num_rows(mysqli_query($kon,$q3));
            $zerowe=$sumaOzerowych*2;
            $sumaO=mysqli_fetch_array(mysqli_query($kon,$q2));
            $srednia=round(($sumaO[0]+$zerowe)/$iloscS,2);
            //obliczam skuteczność wykładowcy
            $q4="SELECT `id` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' $warunek_na_wydzialZ "
                    . "AND `przedmiot`='$przedmiot[przedmiot]' AND `ocena_calkowita`>='3'";
            $ilosc_zaliczonych=mysqli_num_rows(mysqli_query($kon,$q4));
            $sprawnosc=round($ilosc_zaliczonych/$iloscS,4)*100;
            echo "<tr><td>$przedmiot[przedmiot]</td>";
            echo "<td>$srednia</td><td>$iloscS</td><td>$sprawnosc %</td></tr>";
        }
        ?></tbody>
        </table>
    </div>
    <!--/.Panel 1-->

    <!--Panel 2-->
    <div class="tab-pane fade" id="panel12" role="tabpanel">
         <table id="dtMaterialDesignExample0" class="table table-striped table-condensed" cellspacing="0" width="90%">
            <thead>
            <tr> <th>Przedmiot</th>
                <th>Średnia ocen</th>
                <th>Liczba zdających</th>
                <th>Sprawność całkowita</th></tr></thead><!-- comment -->
            <tbody>
        <?php //echo $wzfq;
        //teraz liczę średnią dla przedmiotu, gdzie nieobecność i brak oceny to 2
        $przedmiotyWA=mysqli_query($kon,$wAfq);
        foreach($przedmiotyWA as $przedmiot){
            //wyciągam ilość zdających
            $q="SELECT `id` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' $warunek_na_wydzialA "
                    . "AND `przedmiot`='$przedmiot[przedmiot]'";
            $iloscS=mysqli_num_rows(mysqli_query($kon,$q));
            //teraz wyciągam sumę ocen i liczę średnią
           
            $q2="SELECT SUM(`ocena_calkowita`) FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' "
                    . "$warunek_na_wydzialA AND `przedmiot`='$przedmiot[przedmiot]' AND `ocena_calkowita`<>'' ";
            $q3="SELECT `id` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' "
                    . "$warunek_na_wydzialA AND `przedmiot`='$przedmiot[przedmiot]' AND `ocena_calkowita`=''";
            $sumaOzerowych=mysqli_num_rows(mysqli_query($kon,$q3));
            $zerowe=$sumaOzerowych*2;
            $sumaO=mysqli_fetch_array(mysqli_query($kon,$q2));
            $srednia=round(($sumaO[0]+$zerowe)/$iloscS,2);
            //obliczam skuteczność wykładowcy
            $q4="SELECT `id` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_badany' $warunek_na_wydzialA "
                    . "AND `przedmiot`='$przedmiot[przedmiot]' AND `ocena_calkowita`>='3'";
            $ilosc_zaliczonych=mysqli_num_rows(mysqli_query($kon,$q4));
            $sprawnosc=round($ilosc_zaliczonych/$iloscS,4)*100;
            echo "<tr><td>$przedmiot[przedmiot]</td>";
            echo "<td>$srednia</td><td>$iloscS</td><td>$sprawnosc %</td></tr>";
        }
        ?></tbody>
        </table>

    </div>
    <!--/.Panel 2-->
</div>
  </div>
                            
   </div>
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

    
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>
       <script>
                $(document).ready(function () {
          <?php $lt=0;
          do {?>
$('#dtMaterialDesignExample<?php echo $lt;?>').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [{
             extend: 'pdf',
             
                orientation: 'landscape'
            },
                    'copy'
            , 'csv', 'excel','print'],
            "order": [[ 0, "desc" ]],
            "language": {
            "lengthMenu": "Pokaż _MENU_ wyników na stronę",
            "zeroRecords": "Nic nie znalazłem :-(",
            "info": "strona _PAGE_ z _PAGES_",
            "infoEmpty": "Nic nie znaleziono",
            "infoFiltered": "(Znaleziono _TOTAL_ z _MAX_ rekordów)",
             "paginate": {
        "first":      "początek",
        "last":       "koniec",
        "next":       "Nast.",
        "previous":   "Poprz."
    },
            "search":  "Szukaj" 
        }  
    
});
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper').find('label').each(function () {
$(this).parent().append($(this).children());
});
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_filter').find('input').each(function () {
$('#dtMaterialDesignExample<?php echo $lt;?>_filter').attr("placeholder", "Szukaj");
$('input').removeClass('form-control-sm');
});
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_length').addClass('d-flex flex-row');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_filter').addClass('md-form');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper select').removeClass(
'custom-select custom-select-sm form-control form-control-sm');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper select').addClass('mdb-select');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .mdb-select').materialSelect();
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_filter').find('label').remove();

$('#dtMaterialDesignExamplen<?php echo $lt;?>').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [{
             extend: 'pdf',
             
                orientation: 'landscape'
            },
                    'copy'
            , 'csv', 'excel','print'],
            "order": [[ 0, "asc" ]],
            "language": {
            "lengthMenu": "Pokaż _MENU_ wyników na stronę",
            "zeroRecords": "Nic nie znalazłem :-(",
            "info": "strona _PAGE_ z _PAGES_",
            "infoEmpty": "Nic nie znaleziono",
            "infoFiltered": "(Znaleziono _TOTAL_ z _MAX_ rekordów)",
             "paginate": {
        "first":      "początek",
        "last":       "koniec",
        "next":       "Nast.",
        "previous":   "Poprz."
    },
            "search":  "Szukaj" 
        }  
    
});
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper').find('label').each(function () {
$(this).parent().append($(this).children());
});
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_filter').find('input').each(function () {
$('#dtMaterialDesignExamplen<?php echo $lt;?>_filter').attr("placeholder", "Szukaj");
$('input').removeClass('form-control-sm');
});
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_length').addClass('d-flex flex-row');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_filter').addClass('md-form');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper select').removeClass(
'custom-select custom-select-sm form-control form-control-sm');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper select').addClass('mdb-select');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .mdb-select').materialSelect();
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_filter').find('label').remove();
<?php $lt++;
          }
          while($lt<2);
          ?>
});
</script>
  
  
 
</body>

</html>