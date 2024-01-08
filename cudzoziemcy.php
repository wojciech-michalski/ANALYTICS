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
            <span>Zestawienie obcokrajowców na kierunkach</span>
            
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
               
            </div>
<div class="card-body">
        <?php //print_r($_POST);
        switch($_POST['wydzial']){
            case 1:
                $wydzial="Wydział Architektury";
                $faculty="Faculty of Architecture";
                $wydziale="Wydziale Architektury";
                break;
            case 2:
                $wydzial="Wydział Inżynierii i Zarządzania";
                $wydziale="Wydziale Inżynierii i Zarządzania";
                $faculty="Faculty of Engineering and Management";
                break;
        }
        $obquery="SELECT DISTINCT `obywatelstwo` FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie  "
                . "WHERE studenci.collect_data='$_POST[data1]' AND (mapowanie.wydzial='$wydzial' OR mapowanie.wydzial='$faculty') "
                . "AND studenci.obywatelstwo<>'PL' AND studenci.obywatelstwo<>'' AND mapowanie.kierunek NOT LIKE 'ERASMUS%'";
        //echo "SELECT DISTINCT `kierunek` FROM `mapowanie` WHERE mapowanie.wydzial='$wydzial' OR mapowanie.wydzial='$faculty' AND (mapowanie.stopien='I stopnia' OR mapowanie.stopien='II stopnia')";
        $obywatelstwa=mysqli_query($kon,$obquery);
        $kierunkii=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `mapowanie` WHERE (mapowanie.wydzial='$wydzial' OR mapowanie.wydzial='$faculty') "
                . "AND (mapowanie.stopien='I stopnia' OR mapowanie.stopien='II stopnia') AND mapowanie.kierunek NOT LIKE 'ERASMUS%' ORDER BY `kierunek` ASC");
        $ile_obywatelstw=mysqli_num_rows($obywatelstwa);
        foreach($obywatelstwa as $obywatelstwo){
            $theadarray[]="<th>".$countries[$obywatelstwo['obywatelstwo']]." ($obywatelstwo[obywatelstwo])</th>";
        }
        echo "<h5 class=\"text-center\"> Liczba cudzoziemców studiujących na $wydziale stan na dzień $_POST[data1]</h5>";
        $lp=1;
        ?>
        <table id="dtMaterialDesignExampleSG" class="table table-striped table-responsive table-bordered w-auto">
            <thead><tr><th>Kierunek studiów</th>
                <?php foreach($theadarray as $th){
                    echo $th;
                }
                ?>
                </tr></thead><!-- comment -->
            <tbody>
            <?php
              foreach($kierunkii as $kierunek){
                  echo "<tr><td>$kierunek[kierunek]</td>";
                  foreach ($obywatelstwa as $obywatelstwo){
                      $ilu=mysqli_num_rows(mysqli_query($kon,
                              "SELECT studenci.id FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie "
                              . "WHERE `obywatelstwo`='$obywatelstwo[obywatelstwo]' AND studenci.collect_data='$_POST[data1]' AND mapowanie.kierunek='$kierunek[kierunek]'"));
                      echo "<td>$ilu</td>";
                     $summa[]=$ilu;
                  }
                   echo"</tr>";
              }
              
        ?>
            </tbody></table>
    <?php $razem=array_sum($summa);?>
    <h5 class="text-center">RAZEM: <?php echo $razem;?></h5>
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
                    "orientation": 'landscape',
                    "title": "Liczba cudzoziemców studiujących na wydziale <?php echo $wydziale;?>  - stan na dzień <?php echo $_POST['data1'];?>",
                    
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

