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
            <span>ANKIETY SQL</span> <span>/</span>
             <span>Edycja ankiety <?php echo $_GET['ank'];?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         <?php
         $htmlarray=mysqli_query($kon,"SELECT `pytanie`,`tresc`,`html` FROM `metryki` "
                 . "WHERE `ankieta`='$_GET[ank]'");
         foreach($htmlarray as $ankieta){
             $html_array[]="<!--$ankieta[pytanie] $ankieta[tresc]-->$ankieta[html]";
         }
         $html2edit=implode("\n",$html_array);
         $html2edit=str_replace("<textarea","<text_area",$html2edit);
         $html2edit=str_replace("</textarea>","</text_area>",$html2edit);
         ?>
         <form method="POST" action="controller/update_survey.php">
             <input type="hidden" name="nazwa" value="<?php echo $_GET['ank'];?>"/>
                <div class="form-group">
  <label for="exampleFormControlTextarea1">Ankieta <?php echo $_GET['ank'];?></label>
  <textarea class="form-control rounded-0" name="ankieta" id="exampleFormControlTextarea1" rows="13">
      <?php echo $html2edit;?>
  </textarea>
</div>
             <button class="btn btn-indigo" type="submit">ZAPISZ</button><!-- comment -->  
         </form>
         

         
         <div class="card-header text-center"></div>
          
<div class="card-body">
    
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

    <?php
  //  $modale=implode("\n",$modal_array);
   // echo $modale;
    ?>
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
  
 
</body>

</html>