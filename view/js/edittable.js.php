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

      $('.tbody').append(newTr);
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

//Listopad

   let lp2=<?php echo $lp2;?>;
   const $tableID2 = $('#table2'); 
   const $BTN2 = $('#export-btn2'); 
   const $EXPORT2 = $('#export2');
  const newTr2 = `<tr class="hide">
        <td>
      <span class="table-remove2"><i class=\"far fa-trash-alt red-text\"></i></span></td>
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
  $('.table-add2').on('click', 'i', () => {

  //  const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   // if ($tableID.find('tbody tr').length === 0) {

      $('.tbody2').append(newTr2);
  //  }

    //$tableID.find('table').append($clone);
  });

  $tableID2.on('click', '.table-remove2', function () {

    $(this).parents('tr').detach();
  });

  $tableID2.on('click', '.table-up', function () {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
      return;
    }

    $row.prev().before($row.get(0));
  });

  $tableID2.on('click', '.table-down', function () {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
  });

  // A few jQuery helpers for exporting only
  jQuery.fn.pop = [].pop;
  jQuery.fn.shift = [].shift;

  $BTN2.on('click', () => {

    const $rows = $tableID2.find('tr:not(:hidden)');
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
    $EXPORT2.text(JSON.stringify(data));
  });
   function GetCellValues2() {
        var table = Array.prototype.map.call(document.querySelectorAll('#table2 tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
                  
          let tablestring=table.join("|;;|");
          document.getElementById("formAppend2").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}

//Grudzień

   let lp3=<?php echo $lp3;?>;
   const $tableID3 = $('#table3'); 
   const $BTN3 = $('#export-btn3'); 
   const $EXPORT3 = $('#export3');
  const newTr3 = `<tr class="hide">
        <td>
      <span class="table-remove3"><i class=\"far fa-trash-alt red-text\"></i></span></td>
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
  $('.table-add3').on('click', 'i', () => {

  //  const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   // if ($tableID.find('tbody tr').length === 0) {

      $('.tbody3').append(newTr3);
  //  }

    //$tableID.find('table').append($clone);
  });

  $tableID3.on('click', '.table-remove3', function () {

    $(this).parents('tr').detach();
  });

  $tableID3.on('click', '.table-up', function () {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
      return;
    }

    $row.prev().before($row.get(0));
  });

  $tableID3.on('click', '.table-down', function () {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
  });

  // A few jQuery helpers for exporting only
  jQuery.fn.pop = [].pop;
  jQuery.fn.shift = [].shift;

  $BTN3.on('click', () => {

    const $rows = $tableID3.find('tr:not(:hidden)');
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
    $EXPORT3.text(JSON.stringify(data));
  });
   function GetCellValues3() {
        var table = Array.prototype.map.call(document.querySelectorAll('#table3 tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
                  
          let tablestring=table.join("|;;|");
          document.getElementById("formAppend3").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}
//Styczeń

   let lp4=<?php echo $lp4;?>;
   const $tableID4 = $('#table4'); 
   const $BTN4 = $('#export-btn4'); 
   const $EXPORT4 = $('#export4');
  const newTr4 = `<tr class="hide">
        <td>
      <span class="table-remove4"><i class=\"far fa-trash-alt red-text\"></i></span></td>
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
  $('.table-add4').on('click', 'i', () => {

  //  const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   // if ($tableID.find('tbody tr').length === 0) {

      $('.tbody4').append(newTr4);
  //  }

    //$tableID.find('table').append($clone);
  });

  $tableID4.on('click', '.table-remove4', function () {

    $(this).parents('tr').detach();
  });

  $tableID4.on('click', '.table-up', function () {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
      return;
    }

    $row.prev().before($row.get(0));
  });

  $tableID4.on('click', '.table-down', function () {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
  });

  // A few jQuery helpers for exporting only
  jQuery.fn.pop = [].pop;
  jQuery.fn.shift = [].shift;

  $BTN4.on('click', () => {

    const $rows = $tableID4.find('tr:not(:hidden)');
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
    $EXPORT4.text(JSON.stringify(data));
  });
   function GetCellValues4() {
        var table = Array.prototype.map.call(document.querySelectorAll('#table4 tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
                  
          let tablestring=table.join("|;;|");
          document.getElementById("formAppend4").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}
//Luty

   let lp5=<?php echo $lp5;?>;
   const $tableID5 = $('#table5'); 
   const $BTN5 = $('#export-btn5'); 
   const $EXPORT5 = $('#export5');
  const newTr5 = `<tr class="hide">
        <td>
      <span class="table-remove5"><i class=\"far fa-trash-alt red-text\"></i></span></td>
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
  $('.table-add5').on('click', 'i', () => {

  //  const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   // if ($tableID.find('tbody tr').length === 0) {

      $('.tbody5').append(newTr5);
  //  }

    //$tableID.find('table').append($clone);
  });

  $tableID5.on('click', '.table-remove5', function () {

    $(this).parents('tr').detach();
  });

  $tableID5.on('click', '.table-up', function () {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
      return;
    }

    $row.prev().before($row.get(0));
  });

  $tableID5.on('click', '.table-down', function () {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
  });

  // A few jQuery helpers for exporting only
  jQuery.fn.pop = [].pop;
  jQuery.fn.shift = [].shift;

  $BTN5.on('click', () => {

    const $rows = $tableID5.find('tr:not(:hidden)');
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
    $EXPORT5.text(JSON.stringify(data));
  });
   function GetCellValues5() {
        var table = Array.prototype.map.call(document.querySelectorAll('#table5 tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
                  
          let tablestring=table.join("|;;|");
          document.getElementById("formAppend5").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}
</script>