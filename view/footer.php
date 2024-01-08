<!--<script type="text/javascript" src="view/MDB/js/jquery-3.3.1.min.js"></script>-->
   <script type="text/javascript" src="/view/MDB/js/jquery.min.js"></script>
  <script type="text/javascript" src="/view/MDB/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="/view/MDB/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="/view/MDB/js/mdb.min.js"></script>
 <!--script src="/view/js/jquery.canvasjs.min.js"></script>-->
<script src="view/js/canvasjs_new.min.js"></script>
  <script type="text/javascript" src="/view/MDB/js/addons/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> 
   <script>
       
$(document).ready(function() {
   $('.mdb-select').materialSelect();
 $('.datepicker').pickadate({

min: new Date(2020,12,12),
max: new Date(2042,12,12),
labelMonthNext: 'Następny miesiąc',
labelMonthPrev: 'Poprzedni miesiąc',
labelMonthSelect: 'Wybierz miesiąc z listy',
labelYearSelect: 'Wybierz rok z listy',
selectMonths: true,
selectYears: 50,

// Escape any “rule” characters with an exclamation mark (!).
monthsFull: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik',
'Listopad', 'Grudzień'],
monthsShort:['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie' , 'Wrz', 'Paź' , 'Lis' , 'Gru'],
format: 'yyyy-mm-dd',
firstDay: 1,
weekdaysShort: ['Nd', 'Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sb'],
weekdaysFull: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
today: 'Dziś',
clear: 'wyczyść',
close: 'zamknij',
formatSubmit: 'yyyy-mm-dd'
 });
 });
  // Material Design example
$(document).ready(function () {
$('#dtMaterialDesignExample').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [
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
 <script>

$(document).ready(function(){
   var myVar;
 $( ".spinnerek" ).click(function() {
  	myFunction(this);
});
//window.onload = function() {
 //       document.getElementsByClassName("loader")[0].style.display = "none";
 //   }
 function myFunction(div) {
 $("#loader").toggle();
 $(div).toggle();

 }

        $("#loader").hide();
   
});

function generatePDF() {
                                
				const element = document.getElementById('k2pdf');
				var opt = {
  margin:      [5,-5,1,-3],
  pagebreak: {mode:'legacy'},
  filename:     'raport.pdf',
  image:        { type: 'jpeg', quality: 1 },
  html2canvas:  { scale: 1,dpi: 96, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
};
				html2pdf().from(element).set(opt).save();
                                document.getElementsByClassName("loader")[0].style.display = "none";
			}
function generatePDFKO() {
                    
				const element = document.getElementById('koA');
				var opt = {
 margin:       [5,-5,1,-3],
 pagebreak: {mode:'legacy'},
 filename:     'karta_obciazen.pdf',
 image:        { type: 'jpeg', quality: 1 },
 html2canvas:  { scale: 5 },
 jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
};
				html2pdf().from(element).set(opt).save();
                                document.getElementsByClassName("loader")[0].style.display = "none";
			}
function generatePDFKO2() {
                    
				const element = document.getElementById('koB');
				var opt = {
 margin:       [5,-5,1,-3],
 filename:     'karta_obciazen.pdf',
 image:        { type: 'jpeg', quality: 1 },
 html2canvas:  { scale: 5 },
 jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
};
				html2pdf().from(element).set(opt).save();
                                document.getElementsByClassName("loader")[0].style.display = "none";
			}
				
function generatePDF_2() {
                                
				const element = document.getElementById('k2pdf');
				var opt = {
  margin:      1,
  pagebreak: {mode:'legacy'},
  filename:     'raport.pdf',
  image:        { type: 'jpeg', quality: 1 },
  html2canvas:  { scale: 1,dpi: 300, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a3', orientation: 'landscape' }
};
				html2pdf().from(element).set(opt).save();
                                document.getElementsByClassName("loader")[0].style.display = "none";
			}
                        
    function zapamietajFiltr() {
        
        const dane_filtra=document.getElementById('dane_filtra');
        dane_filtra.value=1;
        toastr["info"]("Dane filtra zostały zapamiętane");
       // console.log(filtr);
    }
    function wyczyscFiltr() {
        
        const dane_filtra=document.getElementById('dane_filtra');
        dane_filtra.value=0;
        toastr["info"]("Dane filtra zostały wyczyszczone");
       // console.log(filtr);
    }
</script>

    