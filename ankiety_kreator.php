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
            <span>KREATOR ANKIET</span>
          </h4>
                  </div>
      </div>
              <div class="row wow fadeIn">
        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <!--Card-->
         
     <div class="card">
         
        <div class="card-header text-center">
           </div>
          
<div class="card-body">
    <form method="POST" action="core/surveycreate.php">
     <div class="md-form">
        <input type="text" id="Form-email4" name="nazwa_ankiety" class="form-control">
        <label for="Form-email4">Nazwa ankiety</label>
      </div>
        <div class="md-form">
            <textarea id="Form-email5" name="wstep" class="form-control"></textarea>
        <label for="Form-email5">Tekst wstępny</label>
      </div>
        <hr/>
        <div class="card-header text-center"><h5>Pytanie 1</h5><div class="md-form form-sm">
  <input type="text" id="PYT_1" name="+PYT_1" class="form-control form-control-sm">
  <label for="PYT_1">Treść pytania nr 1</label>
  <div class="row"><div class="col-md-4"><h6 class="text-warning">Rodzaj pola</h6></div>
      <div class="col-md-4"><h6 class="text-warning">Ilość wariantów odpowiedzi</h6></div>
      <div class="col-md-4"><h6 class="text-warning">warianty</h6></div>
</div><div class="row"><div class="col-md-4 text-left">
            <div class="form-check">
  <input type="radio" class="form-check-input" onclick="createText(1);" id="text" name="typ_pytania" value="text">
  <label class="form-check-label" for="text">Tekst</label>
</div>

<!-- Group of material radios - option 2 -->
<div class="form-check">
  <input type="radio" class="form-check-input" onclick="createText(1);" id="textarea" name="typ_pytania" value="textarea">
  <label class="form-check-label" for="textarea">Pole tekstowe</label>
</div>

<!-- Group of material radios - option 3 -->
<div class="form-check">
  <input type="radio" class="form-check-input" onclick="createRadio(1);" id="radio" name="typ_pytania" value="radio">
  <label class="form-check-label" for="radio">Pole jednokrotnego wyboru</label>
</div>
<div class="form-check">
  <input type="radio" class="form-check-input" onclick="createRadio(1);" id="checkbox" name="typ_pytania" value="checkbox">
  <label class="form-check-label" for="checkbox">Pole wielokrotnego wyboru</label>
</div>
<div class="form-check">
  <input type="radio" class="form-check-input" onclick="createRadio(1);" id="select" name="typ_pytania" value="select">
  <label class="form-check-label" for="select">Lista rozwijana</label>
</div></div>
    <div class="col-md-4" id="survervariant">
    </div>
    <div class="col-md-4" id="subvariant">
    </div>     
    
</div>
           </div>  
            <div class="row"></div> 
</div>
        <div id="pytania"></div>
        <button type="button" class="btn btn-default btn-rounded waves-effect" onclick="dodajPytanie(nrpytania);">Dodaj pytanie <i class="fas fa-plus"></i></button>
       <button type="submit" class="btn btn-indigo" style="margin-left:60%">Prześlij</button></form>
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
   
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
     ?>
  <script>
 // $( document ).ready(function() {
 //   new WOW().init()
//});
  </script>
  <script>
      let k="";
      var nrpytania=1;
      let id1 = "survervariant";
      let id2 = "subvariant";
      let idsuwaka = "#suwak";
      let suwid="suwak";
      let wariantid= "wariant";
      function createText(pytanie) {
          
         let zawartosc=document.getElementById( id1 );
         let zawartosc2=document.getElementById( id2 );
         zawartosc.innerHTML='';
         zawartosc2.innerHTML='';
     }
     function createRadio(pytanie) {
         let zawartosc=document.getElementById(id1);
         zawartosc.innerHTML=`<div class="d-flex justify-content-center my-4">
          <span class="font-weight-bold indigo-text mr-2 mt-1">2</span><form class="range-field w-25">
          <input id="` + suwid + `" onchange="radioVariants(' + nrpytania + ');" class="border-0" type="range" 
          min="2" max="20" /></form><span class="font-weight-bold indigo-text ml-2 mt-1">20</span></div>`;
     }
     function radioVariants(pytanie) {
         delete elements;
        // console.log(idsuwaka);
         wartosc=$(idsuwaka).val();
        // console.log(wartosc);
        n=0; 
        const elements = [];
        do {
            n++;
            
         elements[n]=`<div class="md-form"><input type="text" class="form-control" id="`+ wariantid +`` + n + `
           " name="PYT_`+nrpytania +`|wariant` + n +`"/><label for="` + wariantid +`` + n + `">treść wariantu `+ n + `
            </label></div>`;
         
         }
         while(n<wartosc);
         let zawartosc2=document.getElementById(id2);
         zawartosc2.innerHTML=elements.join('');
         
     }
     function dodajPytanie() {
       //pobieram wartości inputów z poprzedniego
       pytid="pytania" + k;
       k++;      
       nrpytania++;
       let nowePytanie=document.getElementById(pytid);
       id1="survervariant" + nrpytania;
       id2="subvariant" + nrpytania;
       idsuwaka = "#suwak" + nrpytania;
       suwid = "suwak" + nrpytania;
       wariantid="wariant" + nrpytania;
    //   console.log(id2);
     nowePytanie.innerHTML=nowePytanie.innerHTML + `<div class="card-header text-center"><h5>Pytanie `+ nrpytania +` 
        <!--<span class="red-text" onclick="deletePytanie('`+ pytid +`');" style="margin-left:30%"><i class="fas fa-trash-alt"></i></span>--></h5> 
        <div class="md-form form-sm"><input type="text" id="PYT_`+ nrpytania +`" name="+PYT_`+ nrpytania +`" class="form-control form-control-sm"> 
        <label for="PYT_`+ nrpytania +`">Treść pytania nr `+ nrpytania +`</label> <div class="row"><div class="col-md-4"><h6 class="text-warning"> 
        Rodzaj pola</h6></div><div class="col-md-4"><h6 class="text-warning">Ilość wariantów odpowiedzi</h6></div> 
        <div class="col-md-4"><h6 class="text-warning">warianty</h6></div></div><div class="row"><div class="col-md-4 text-left"> 
        <div class="form-check"><input type="radio" class="form-check-input" onclick="createText('`+ nrpytania +`');" 
        id="text`+ nrpytania +`" name="typ_pytania`+ nrpytania+`" value="text"><label class="form-check-label" for="text`+ nrpytania +`">  
        Tekst</label></div><div class="form-check"><input type="radio" class="form-check-input" onclick="createText('`+ nrpytania +`');" 
        id="textarea`+ nrpytania +`" name="typ_pytania`+ nrpytania+`" value="textarea"><label class="form-check-label" 
        for="textarea`+ nrpytania +`">Pole tekstowe</label></div><div class="form-check"> 
        <input type="radio" class="form-check-input" onclick="createRadio('`+ nrpytania +`');" 
        id="radio`+ nrpytania +`" name="typ_pytania`+ nrpytania+`" value="radio"><label class="form-check-label" for="radio`+ nrpytania +`"> 
       Pole jednokrotnego wyboru</label></div><div class="form-check"> 
       <input type="radio" class="form-check-input" onclick="createRadio('`+ nrpytania +`');" 
       id="checkbox`+ nrpytania +`" name="typ_pytania`+ nrpytania+`" value="checkbox"> 
       <label class="form-check-label" for="checkbox`+ nrpytania +`">Pole wielokrotnego wyboru</label></div> 
       <div class="form-check"><input type="radio" class="form-check-input" onclick="createRadio('`+ nrpytania +`');" 
       id="select`+ nrpytania +`" name="typ_pytania`+ nrpytania+`" value="select"> 
       <label class="form-check-label" for="select`+ nrpytania +`">Lista rozwijana</label> 
       </div></div><div class="col-md-4" id="` + id1 +`"></div><div class="col-md-4" id="` + id2 + `"></div>     
       </div></div><div class="row"></div></div><div id="pytania`+ k +`"></div>`;
   // console.log(pytid);
       
    }
    function deletePytanie(pyt) {
        
      let toDelete=document.getElementById(pyt);
      console.log(toDelete);
      toDelete.innerHtml="";
    }
</script>
 
</body>

</html>

