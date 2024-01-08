<?php
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
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
            <span>Zbieranie danych i analiza</span>
             <span>/</span>
             <span>Zestawienie dla Straży Granicznej</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Analiza na dzień
</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kmonModal">
    zestawienie KMON
</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SGModal">
    zestawienie dla SG
</button>               
            </div>
<div class="card-body">
        <?php //print_r($_POST);
        $obquery="SELECT DISTINCT studenci.obywatelstwo FROM `studenci` "
                . "INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie "
                . "WHERE studenci.collect_data>='$_POST[data1]' AND studenci.collect_data<='$_POST[data2]' AND "
                . "studenci.obywatelstwo<>'PL' AND studenci.obywatelstwo<>'' AND mapowanie.kierunek NOT LIKE 'ERASMUS%'";
        $obywatelstwa=mysqli_query($kon,$obquery);
        $ile_obywatelstw=mysqli_num_rows($obywatelstwa);
        echo "<h5 class=\"text-center\"> Liczba cudzoziemców studiujących na uczelni w ".substr($_POST['data1'],0,4)." roku - stan na dzień $_POST[data2]</h5>";
        $lp=1;
        ?>
        <table id="dtMaterialDesignExampleSG" class="table table-striped table-responsive table-bordered w-auto">
            <thead><tr><th>Lp.</th><th>Miasto</th><th>Nazwa uczelni</th><th>Obywatelstwo</th><th>Liczba</th></tr></thead><!-- comment -->
            <tbody>
            <?php
        foreach($obywatelstwa as $obywatelstwo){
            //dla każdego kraju sprawdzam ilość studentów na dzień $_POST['data2']
            $is=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` "
                    . "WHERE `obywatelstwo`='$obywatelstwo[obywatelstwo]' AND  `status_studenta`<>'rezygnacja' "
                    . "AND  `status_studenta`<>'skreślenie' AND  `status_studenta`<>'absolwent' "
                    . "AND  `status_studenta`<>'kandydat' AND `collect_data`='$_POST[data2]'"));
            if($is>0){
            echo "<tr><td>$lp</td><td>Warszawa</td><td>Wyższa Szkoła Ekologii i Zarządzania</td>"
                    . "<td>".$countries[$obywatelstwo['obywatelstwo']]." ($obywatelstwo[obywatelstwo])</td><td>$is</td></tr>";
            }
            $lp++;
        }
        ?>
            </tbody></table>
    <hr/>
    <h5 class="text-center"> Liczba cudzoziemców skreślonych w <?php echo substr($_POST['data1'],0,4);?> roku - stan na dzień <?php echo $_POST['data2'];?></h5>
    <?php
        $squery="SELECT DISTINCT studenci.numer_albumu FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie"
                . " WHERE studenci.collect_data>='$_POST[data1]' AND studenci.collect_data<='$_POST[data2]' AND "
                . "studenci.obywatelstwo<>'PL' AND studenci.obywatelstwo<>'' AND mapowanie.kierunek NOT LIKE 'ERASMUS%' AND "
                . "(studenci.status_studenta='skreślenie' OR studenci.status_studenta='rezygnacja')";
       // echo $squery;
        $skresleni=mysqli_query($kon,$squery);
        foreach($skresleni as $skreslony){
            //sprawdzam czy jest w bazie roboczej
            $baza=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT G_BAZA FROM Przynaleznosc WHERE G_NUMER_ALBUMU='$skreslony[numer_albumu]'"));
            switch($baza[0]){
                default:
                   break;
                case 3:
                    $ob_skreslonego=mysqli_fetch_array(mysqli_query($kon,"SELECT DISTINCT `obywatelstwo` FROM `studenci` WHERE `numer_albumu`='$skreslony[numer_albumu]'"));
                    $sarray[]=$ob_skreslonego[0];
                    break;
            }
        }
        $skresl=array_count_values($sarray);
        $elp=1;
    ?>
    <table id="dtMaterialDesignExampleSG2" class="table table-striped table-responsive table-bordered w-auto">
            <thead><tr><th>Lp.</th><th>Miasto</th><th>Nazwa uczelni</th><th>Obywatelstwo</th><th>Liczba</th></tr></thead><!-- comment -->
            <tbody>
              <?php
                foreach(array_keys($skresl) as $ss){
                    
                    echo "<tr><td>$elp</td><td>Warszawa</td><td>Wyższa Szkoła Ekologii i Zarządzania</td><td>".$countries[$ss]." ($ss)</td><td>$skresl[$ss]</td></tr>";
                    $elp++;
                }
              ?>
                 </tbody></table>
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
    <?php include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>
<script>
    $(document).ready(function () {
$('#dtMaterialDesignExampleSG').DataTable( {
            "dom": 'Bfrtip',
            "buttons": ['copy','csv','excel',{
                    "extend": 'pdfHtml5',
                    "title": "Liczba cudzoziemców studiujących na uczelni w <?php echo substr($_POST['data1'],0,4);?> roku - stan na dzień <?php echo $_POST['data2'];?>",
                    
                }
                ],
            
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
$('#dtMaterialDesignExample_wrapper').find('label').each(function () {
$(this).parent().append($(this).children());
});
$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
$('#dtMaterialDesignExample_filter').attr("placeholder", "Szukaj");
$('input').removeClass('form-control-sm');
});
$('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
$('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
$('#dtMaterialDesignExample_wrapper select').removeClass(
'custom-select custom-select-sm form-control form-control-sm');
$('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
$('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
});
$(document).ready(function () {
$('#dtMaterialDesignExampleSG2').DataTable( {
            "dom": 'Bfrtip',
            "buttons": ['copy','csv','excel',{
                    "extend": 'pdfHtml5',
                    "title": "Liczba cudzoziemców skreślonych w <?php echo substr($_POST['data1'],0,4);?> roku - stan na dzień <?php echo $_POST['data2'];?>",
                    
                }
                ],
            
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
$('#dtMaterialDesignExample_wrapper').find('label').each(function () {
$(this).parent().append($(this).children());
});
$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
$('#dtMaterialDesignExample_filter').attr("placeholder", "Szukaj");
$('input').removeClass('form-control-sm');
});
$('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
$('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
$('#dtMaterialDesignExample_wrapper select').removeClass(
'custom-select custom-select-sm form-control form-control-sm');
$('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
$('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
});
</script>
  
  
 
</body>

</html>

