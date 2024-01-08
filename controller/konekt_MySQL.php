<?php
//MySQL CONNECT
		$kon=mysqli_connect($chmurka,$user_DB,$haselo,$baza);
	if($kon) {
	//
	}
		else die("Brak połączenia z bazą MySQL");
mysqli_set_charset($kon, "utf8");
?>