<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# MEMBACA TOMBOL KOGIN DARI FILE login.php
if(isset($_POST['username']) && isset($_POST['password']))
{
	# Baca variabel form
	$txtUser 		= @mysql_real_escape_string($_POST[username]);
	$txtUser 		= str_replace("'","&acute;",$txtUser);
	
	$txtPassword	= @mysql_real_escape_string($_POST[password]);
	$txtPassword	= str_replace("'","&acute;",$txtPassword);
	
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if ( trim($txtUser)=="") {
		$pesanError[] = "Data <b> Username </b>  tidak boleh kosong !";		
	}
	if (trim($txtPassword)=="") {
		$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";		
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 )
	{
		
		// Tampilkan lagi form login
		
		header("Location: login.php?error=1");
	}
	else {
		# LOGIN CEK KE TABEL USER LOGIN
		$mySql = "SELECT * FROM user WHERE username='$txtUser' AND password='".md5($txtPassword)."'";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Query Salah : ".mysql_error());
		$myData= mysql_fetch_array($myQry);
		
		# JIKA LOGIN SUKSES
		if(mysql_num_rows($myQry) >=1) {
			// Menyimpan Kode yang Login
			$_SESSION['SES_LOGIN'] = $myData['kd_user']; 
			$_SESSION['NAMA_LOGIN'] = $myData['nm_user']; 
			
			 header("Location:index.php");
		}
		else 
		{   
			 header("Location:login.php?error=2");
		}
	}
}
// End POST
?>
 
