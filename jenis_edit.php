<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SKRIP SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	$txtNama	= mysql_real_escape_string($_POST['txtNama']);
	$txtUkuran	= mysql_real_escape_string($_POST['txtUkuran']);
	
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Jenis</b> tidak boleh kosong !";		
	}
	if (trim($txtUkuran)=="") {
		$pesanError[] = "Data <b>Ukuran</b> tidak boleh kosong !";		
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
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		$Kode	= mysql_real_escape_string($_POST['txtKode']);
		$mySql	= "UPDATE jenis SET ukuran='$txtUkuran', nama_jenis='$txtNama' WHERE kd_jenis ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Jenis-Data'>";
		}
		exit;
	}	
}

# TAMPILKAN DATA LOGIN UNTUK DIEDIT
$Kode	 = mysql_real_escape_string($_GET['Kode']); 
$mySql	 = "SELECT * FROM jenis WHERE kd_jenis='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query data salah: ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

	// Menyimpan data ke variabel temporary (sementara)
	$dataKode	= $myData['kd_jenis'];
	$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nama_jenis'];
	$dataUkuran	= isset($_POST['txtUkuran']) ? $_POST['txtUkuran'] : $myData['ukuran'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
   <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th colspan="3" scope="col">UBAH DATA JENIS</th>
    </tr>
    <tr>
      <td width="181"><strong>Nama Jenis </strong></td>
      <td width="3">:</td>
      <td width="1019"><input name="txtNama" value="<?php echo $dataNama; ?>" size="70" maxlength="100" />
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Ukuran</strong></td>
      <td>:</td>
      <td><input name="txtUkuran" value="<?php echo $dataUkuran; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
  </table>
</form>
