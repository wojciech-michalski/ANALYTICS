  <?php 

$listaq="SELECT `wykladowca_imie`,`wykladowca_nazwisko`,`wykladowca_tytul`,`semestr_ZL`,`rok_akademicki` FROM `karta_obciazen` "
        . " WHERE `wykladowca_nazwisko`<>'' GROUP BY `wykladowca_imie`,`wykladowca_nazwisko`,`rok_akademicki`,`semestr_ZL`"
        . " ORDER BY `rok_akademicki` DESC;";

$lista=mysqli_query($kon,$listaq);

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
            <span>ROZLICZENIE DYDAKTYKI</span> <span>/</span>
             <span>Definicja kosztów osobowych</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
           <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="100%">
               <thead>
    <tr>
        <th>L.P.</th>
        <th>Nazwisko</th> 
        <th>Imię</th>
        <th>Tytuł zawodowy</th>
        <th>Rok akademicki</th>
        <th>Semestr</th>
        <th>Przedmioty</th>
        <th>Stawki godzinowe</th>
    </tr></thead><!-- comment -->
               <tbody>
                   <?php
                   $lp=1;
                   foreach ($lista as $wykl){
                       $przedmioty=mysqli_query($kon,"SELECT DISTINCT `przedmiot` FROM `karta_obciazen` WHERE"
                               . "`rok_akademicki`='$wykl[rok_akademicki]' AND `semestr_ZL`='$wykl[semestr_ZL]'"
                               . " AND `wykladowca_imie`='$wykl[wykladowca_imie]' AND `wykladowca_nazwisko`="
                               . "'$wykl[wykladowca_nazwisko]'");
                               foreach($przedmioty as $pr){
                                   $prarray[]=$pr['przedmiot'];
                               }
                               $prstring="<ul><li>".implode("</li><li>",$prarray)."</li></ul>";
                               unset($prarray);
                               
                               switch($wykl['semestr_ZL']){
                                   case 0:
                                       $sZL="zimowy";
                                       break;
                                   case 1:
                                       $sZL="letni";
                                       break;
                               }
                               //sprawdzamy czy ma zdefiniowane stawki dla roku akademickiego
                               if(mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `koszta_osobowe` WHERE "
                                       . "`rok_akademicki`='$wykl[rok_akademicki]' AND `semestr_ZL`='$wykl[semestr_ZL]' "
                                       . "AND `wykladowca_imie`='$wykl[wykladowca_imie]' "
                                       . "AND `wykladowca_nazwisko`='$wykl[wykladowca_nazwisko]'"))>0){
                                   $stawki=mysqli_fetch_array(mysqli_query($kon,"SELECT `stawka_wyklad`,`stawka_cwiczenia`,"
                                           . "`stawka_lab`,`stawka_projekt`, `stawka_wyklad_en`,`stawka_cwiczenia_en`,"
                                           . "`stawka_lab_en`,`stawka_projekt_en` FROM `koszta_osobowe` WHERE "
                                       . "`rok_akademicki`='$wykl[rok_akademicki]' AND `semestr_ZL`='$wykl[semestr_ZL]' "
                                       . "AND `wykladowca_imie`='$wykl[wykladowca_imie]' "
                                       . "AND `wykladowca_nazwisko`='$wykl[wykladowca_nazwisko]'"));
                                   $button="<button class=\"btn btn-success\" "
                               . "data-toggle=\"modal\" data-target=\"#def$lp\">Pokaż stawki</button>";
                                              $modal[]="<div class=\"modal fade\" id=\"def$lp\" tabindex=\"-1\" role=\"dialog\" "
                               . "aria-labelledby=\"example$lp\"
  aria-hidden=\"true\">
  <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h5 class=\"modal-title\" id=\"example$lp\">Definiowanie stawek dla wykładowcy</h5>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div><form method=\"POST\" action=\"controller/def_stawka.php\">
      <div class=\"modal-body\">
        <h6>$wykl[wykladowca_tytul] $wykl[wykladowca_imie] $wykl[wykladowca_nazwisko]</h6>
            
            <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon1_$lp\">stawka wykład PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_wyklad\" value=\"$stawki[stawka_wyklad]\" 
      aria-label=\"stawka wykład\"
  aria-describedby=\"basic-addon1_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon2_$lp\">stawka ćwiczenia PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_cw\" value=\"$stawki[stawka_cwiczenia]\" 
      aria-label=\"stawka ćwiczenia\"
  aria-describedby=\"basic-addon2_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon3_$lp\">stawka projekt PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_p\" value=\"$stawki[stawka_projekt]\" 
      aria-label=\"stawka projekt\"
  aria-describedby=\"basic-addon3_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon4_$lp\">stawka laboratorium PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_l\" value=\"$stawki[stawka_lab]\" 
      aria-label=\"stawka laboratorium\"
  aria-describedby=\"basic-addon4_$lp\">
</div>
<hr/>
 <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon5_$lp\">stawka wykład język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_wyklad_en\" value=\"$stawki[stawka_wyklad_en]\" 
      aria-label=\"stawka wykład język angielski\"
  aria-describedby=\"basic-addon5_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon6_$lp\">stawka ćwiczenia język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_cw_en\"value=\"$stawki[stawka_cwiczenia_en]\" 
      aria-label=\"stawka ćwiczenia język angielski\"
  aria-describedby=\"basic-addon6_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon7_$lp\">stawka projekt język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_p_en\" value=\"$stawki[stawka_projekt_en]\" 
      aria-label=\"stawka projekt język angielski\"
  aria-describedby=\"basic-addon7_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon8_$lp\">stawka laboratorium język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_l_en\" value=\"$stawki[stawka_lab_en]\" aria-label=\"stawka laboratorium język angielski\"
  aria-describedby=\"basic-addon8_$lp\">
</div>
<input type=\"hidden\" name=\"wykladowca_imie\" value=\"$wykl[wykladowca_imie]\"/>
<input type=\"hidden\" name=\"wykladowca_nazwisko\" value=\"$wykl[wykladowca_nazwisko]\"/>
<input type=\"hidden\" name=\"rok_akademicki\" value=\"$wykl[rok_akademicki]\"/>
    <input type=\"hidden\" name=\"semestr_ZL\" value=\"$wykl[semestr_ZL]\"/>
       </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Zamknij</button>
        <button type=\submit\" class=\"btn btn-indigo\">Zapisz</button></form>
      </div>
    </div>
  </div>
</div>";
                                   
                               }
                               else {
                                   $button="<button class=\"btn btn-indigo\" "
                               . "data-toggle=\"modal\" data-target=\"#def$lp\">Definiuj stawki</button>";
                                $modal[]="<div class=\"modal fade\" id=\"def$lp\" tabindex=\"-1\" role=\"dialog\" "
                               . "aria-labelledby=\"example$lp\"
  aria-hidden=\"true\">
  <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h5 class=\"modal-title\" id=\"example$lp\">Definiowanie stawek dla wykładowcy</h5>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div><form method=\"POST\" action=\"controller/def_stawka.php\">
      <div class=\"modal-body\">
        <h6>$wykl[wykladowca_tytul] $wykl[wykladowca_imie] $wykl[wykladowca_nazwisko]</h6>
            
            <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon1_$lp\">stawka wykład PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_wyklad\" placeholder=\"stawka wykład\" aria-label=\"stawka wykład\"
  aria-describedby=\"basic-addon1_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon2_$lp\">stawka ćwiczenia PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_cw\" placeholder=\"stawka ćwiczenia\" aria-label=\"stawka ćwiczenia\"
  aria-describedby=\"basic-addon2_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon3_$lp\">stawka projekt PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_p\" placeholder=\"stawka projekt\" aria-label=\"stawka projekt\"
  aria-describedby=\"basic-addon3_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon4_$lp\">stawka laboratorium PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_l\" placeholder=\"stawka laboratorium\" aria-label=\"stawka laboratorium\"
  aria-describedby=\"basic-addon4_$lp\">
</div>
<hr/>
 <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon5_$lp\">stawka wykład język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_wyklad_en\" placeholder=\"stawka wykład język angielski\" aria-label=\"stawka wykład język angielski\"
  aria-describedby=\"basic-addon5_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon6_$lp\">stawka ćwiczenia język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_cw_en\" placeholder=\"stawka ćwiczenia język angielski\" aria-label=\"stawka ćwiczenia język angielski\"
  aria-describedby=\"basic-addon6_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon7_$lp\">stawka projekt język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_p_en\" placeholder=\"stawka projekt język angielski\" aria-label=\"stawka projekt język angielski\"
  aria-describedby=\"basic-addon7_$lp\">
</div>
<div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"basic-addon8_$lp\">stawka laboratorium język angielski PLN</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"stawka_l_en\" placeholder=\"stawka laboratorium język angielski\" aria-label=\"stawka laboratorium język angielski\"
  aria-describedby=\"basic-addon8_$lp\">
</div>
<input type=\"hidden\" name=\"wykladowca_imie\" value=\"$wykl[wykladowca_imie]\"/>
<input type=\"hidden\" name=\"wykladowca_nazwisko\" value=\"$wykl[wykladowca_nazwisko]\"/>
<input type=\"hidden\" name=\"rok_akademicki\" value=\"$wykl[rok_akademicki]\"/>
    <input type=\"hidden\" name=\"semestr_ZL\" value=\"$wykl[semestr_ZL]\"/>
       </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Zamknij</button>
        <button type=\submit\" class=\"btn btn-indigo\">Zapisz</button></form>
      </div>
    </div>
  </div>
</div>";   
                               }
                       echo "<tr><td>$lp</td>"
                               . "<td>$wykl[wykladowca_nazwisko]</td>"
                               . "<td>$wykl[wykladowca_imie]</td>"
                               . "<td>$wykl[wykladowca_tytul]</td>"
                               . "<td>$wykl[rok_akademicki]</td>"
                               . "<td>$sZL</td>"
                               . "<td>$prstring</td>"
                               . "<td>$button</td></tr>";
                       
                       $lp++;
                   }
                   ?>
               </tbody>
           </table>
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>

    <?php
   $modale=implode("\n",$modal);
    echo $modale;
    ?>
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>

  
  
 
</body>

</html>