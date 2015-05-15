<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SKRIP SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNama	= mysql_real_escape_string($_POST['txtNama']);
	$txtUsername= mysql_real_escape_string($_POST['txtUsername']);
	$txtPassword= mysql_real_escape_string($_POST['txtPassword']);

	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";		
	}
	if (trim($txtUsername)=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# Cek Password baru
		if (trim($txtPassword)=="") {
			$txtPassLama= $_POST['txtPassLama'];
			
			$sqlSub = " password='$txtPassLama'";
		}
		else {
			$sqlSub = "  password ='".md5($txtPassword)."'";
		}
		
		// Jika tidak menemukan error, simpan data ke database
		$Kode	= mysql_real_escape_string($_POST['txtKode']);
		$mySql  = "UPDATE user SET nm_user='$txtNama', username='$txtUsername', 
					$sqlSub  WHERE kd_user='$Kode'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=User-Data'>";
		}
		exit;
	}	
} // Penutup POST


# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
$Kode	= isset($_GET['Kode']) ?  @mysql_real_escape_string($_GET['Kode']) : @mysql_real_escape_string($_POST['txtKode']); 
$mySql 	= "SELECT * FROM user WHERE kd_user='$Kode'";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData	= mysql_fetch_array($myQry);
	$dataKode		= $myData['kd_user'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_user'];
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username'];
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
   <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th colspan="3"><b> UBAH DATA USER </b></th>
    </tr>
    <tr>
      <td width="181"><b>Kode</b></td>
      <td width="5"><b>:</b></td>
      <td width="1017"> <input name="textfield" type="text"  value="<?php echo $dataKode; ?>" size="10" maxlength="5"  readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><b>Nama Kasir </b></td>
      <td><b>:</b></td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><b>Username</b></td>
      <td><b>:</b></td>
      <td><input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="60" maxlength="20" /> </td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword" type="password" size="60" maxlength="100" />
      <input name="txtPassLama" type="hidden" value="<?php echo $myData['password']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value=" Simpan " /> </td>
    </tr>
  </table>
</form>
