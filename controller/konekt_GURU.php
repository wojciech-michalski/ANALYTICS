<?php 
//ODBC CONNECT
$serverName = "$myServer\\\\$myInstance,49928";
		$connectionInfo = array( "Database"=>"$myDB", "UID"=>"$myUser", "PWD"=>"$myPass", "TrustServerCertificate" =>"yes");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn ) {
     //echo "<!--Połączenie z MSSQL ustanowione.\n-->";
}else{
     echo "Connection could not be established.\n";
     die( print_r( sqlsrv_errors(), true));
}
?>