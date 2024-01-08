<?php

    include('../config/config.php');
    include('konekt_MySQL.php');
        if(isset($_POST['request'])) {
            $hatemenel_=$_POST['hatemenel'];
            $htarray=explode("<!-- form cut -->",$hatemenel_);
            $hatemenel="$htarray[0] $htarray[1]";
            $javascript= mysqli_real_escape_string($kon,$_POST['javascript']);
            $kierunek_nazwa=$_POST['kierunek'];
            $q="INSERT INTO `shared_views`(`hatemenel`,`javascript`,`kierunek`) VALUES('$hatemenel','$javascript','$kierunek_nazwa')";
            if(mysqli_query($kon,$q)){
            $response['status']=1;
            $id=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `shared_views` WHERE 1"));
            $response['comment']="Jest OK - token=$id[0]";
            $response['link']="$surveyurl/view_mla.php?token=$id[0]";
            echo json_encode($response);
          exit;
            }
            else $response['status']=0;
            echo json_encode($response);
          exit;
        }
        else {
            $response['status']=0;
            echo json_encode($response);
          exit;
        }
