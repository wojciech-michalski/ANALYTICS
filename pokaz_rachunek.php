<?php


    $nr_rachunku=base64_decode($_GET['nr']);
    $rach_details=mysqli_fetch_array(mysqli_query($kon,"SELECT `id_elementy`,`pesel` FROM `rachunki` WHERE `numer`='$nr_rachunku'"));
    $details_array=explode(",",$rach_details[0]);
    foreach($details_array as $element){
        $elementquery="SELECT `imie`,`nazwisko`,`godziny`,`przedmiot`,`forma`,`kierunek`"
              . ",`typ`,`rodzaj`,`semestr` FROM `rach_elementy` WHERE `id`=$element";
       // echo "$elementquery <br/>";
      $wiersz=mysqli_fetch_array(mysqli_query($kon,$elementquery)); 
      $posarray[]=array(
              "przedmiot"=> $wiersz['przedmiot'],
              "forma"=>$wiersz['forma'],
              "kierunek"=>$wiersz['kierunek'],
              "typ"=>$wiersz['typ'],
              "rodzaj"=>$wiersz['rodzaj'],
              "semestr"=>$wiersz['semestr'],
              "godziny"=>$wiersz['godziny']
      );
}
        $pesel=$rach_details[1];
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
            <span>Karty obciążeń / Rachunki / <?php echo "$wiersz[imie] $wiersz[nazwisko]";?> / Rachunek nr <?php echo $nr_rachunku;?></span>
          </h4>
            
            <?php //include('controller/generator_rachunku.php');
            ?>
          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
            <div class="tab-content card">
        
         <div class="card-header text-center" >
             
            </div>
<div class="card-body">
 <?php print_r($posarray);?>
    <a href="controller/generator_rachunku.php?nr=<?php echo $_GET['nr'];?>" target="_blank">POKA</a>
          </div>
          <!--/.Card-->
     </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        
       
       
    <?php //include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>

  
  
 
</body>
<script>
   let lp=<?php echo $lp;?>;
   const $tableID = $('#table'); 
   const $BTN = $('#export-btn'); 
   const $EXPORT = $('#export');
  const newTr = `<tr class="hide">
        <td>
      <span class="table-remove"><i class=\"far fa-trash-alt red-text\"></i></span></td>
    <td class="pt-3-half" contenteditable="true">LP</td>
    <td class="pt-3-half" contenteditable="true">Symbol studiów</td>
    <td class="pt-3-half" contenteditable="true">Przedmiot</td>
    <td class="pt-3-half" contenteditable="true">0</td>
    <td class="pt-3-half" contenteditable="true">0</td>
    <td class="pt-3-half" contenteditable="true">0</td>
    <td class="pt-3-half" contenteditable="true">0</td>
    <td class="pt-3-half" contenteditable="true">0</td>
    <!--<td class="pt-3-half" contenteditable="true">razem</td>-->
      </tr> `;
  $('.table-add').on('click', 'i', () => {

  //  const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   // if ($tableID.find('tbody tr').length === 0) {

      $('tbody').append(newTr);
  //  }

    //$tableID.find('table').append($clone);
  });

  $tableID.on('click', '.table-remove', function () {

    $(this).parents('tr').detach();
  });

  $tableID.on('click', '.table-up', function () {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
      return;
    }

    $row.prev().before($row.get(0));
  });

  $tableID.on('click', '.table-down', function () {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
  });

  // A few jQuery helpers for exporting only
  jQuery.fn.pop = [].pop;
  jQuery.fn.shift = [].shift;

  $BTN.on('click', () => {

    const $rows = $tableID.find('tr:not(:hidden)');
    const headers = [];
    const data = [];

    // Get the headers (add special header logic here)
    $($rows.shift()).find('th:not(:empty)').each(function () {

      headers.push($(this).text().toLowerCase());
    });

    // Turn all existing rows into a loopable array
    $rows.each(function () {
      const $td = $(this).find('td');
      const h = {};

      // Use the headers from earlier to name our hash keys
      headers.forEach((header, i) => {

        h[header] = $td.eq(i).text();
      });

      data.push(h);
    });

    // Output the result
    $EXPORT.text(JSON.stringify(data));
  });
   function GetCellValues() {
        var table = Array.prototype.map.call(document.querySelectorAll('#table tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
                  
          let tablestring=table.join("|;;|");
          document.getElementById("formAppend").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}
</script>

</html>

