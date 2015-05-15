<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Membaca data dari URL
$Kode	= mysql_real_escape_string($_GET['Kode']);
if(isset($Kode)){
	// Skrip menghapus data dari tabel database
	$mySql = "DELETE FROM user WHERE kd_user='$Kode' AND username !='admin'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Error query".mysql_error());
	
	// Refresh
	echo "<meta http-equiv='refresh' content='0; url=?open=User-Data'>";
}
else {
	echo "Data yang dihapus tidak ada";
}
?>