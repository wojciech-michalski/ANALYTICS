<?php
require('config/config.php');
include('controller/konekt_MySQL.php');
include('view/header_intro.php');
if(!isset($_GET['token'])||!is_numeric($_GET['token'])){
    header('Location: index.php');
		exit();
    }
    else {$token=$_GET['token'];}
    $ankieta=mysqli_fetch_array(mysqli_query($kon,"SELECT `hatemenel`,`javascript`,`kierunek` FROM `shared_views` WHERE `id`=$token"));
    ?><div class="container"><?php
    echo "<section id=\"pyc\"></section>";
    echo $ankieta[0];
    ?>
    </div>
    <?php
include('view/footer.php');
?><script>
    window.onload = function () {
       // let formularz=document.getElementsByClassName('form-inline')[0];
       // formularz.innerHTML="";
        document.getElementById('pyc').innerHTML='<div class="card"><div class="card-body">' +
                'Wyniki dla: <?php echo $ankieta[2];?></div></div><br/>'; 
    };
<?php echo $ankieta[1]; ?>
    
</script>

