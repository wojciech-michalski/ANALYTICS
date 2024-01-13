<?php
//include('view/header_intro.php');
require('config/config.php');
$filteredpassword=addslashes($_POST['pass']);
    $hash=crypt($filteredpassword,$salt);
  
require('controller/konekt_MySQL.php');
session_start();
	
	if ((!isset($_POST['user'])) || (!isset($_POST['pass'])))
	{
		header('Location: index.php');
		exit();
	}
        else {
            $query=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `users` WHERE `name`='".$_POST['user']."' "
                    . "AND `password`='$hash' AND `active`=1"));
            if($query>0) {
                //uprawnienia
                $grupa=mysqli_fetch_array(mysqli_query($kon,"SELECT groups.module_privileges FROM `groups` "
                        . "INNER JOIN `users` ON users.group_id=groups.id WHERE users.name='$_POST[user]'"));
                //
                $_SESSION['uprawnienia']=$grupa[0];
                $_SESSION['zalogowany'] = true;
		$_SESSION['user']=$_POST['user'];
                header('Location: main.php');
		exit();
            }
            else
           {
		header('Location: index.php');
		exit();
	}
        }



