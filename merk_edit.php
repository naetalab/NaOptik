<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SKRIP SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtMerk= mysql_real_escape_string($_POST['txtMerk']);
	
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtMerk)=="") {
		$pesanError[] = "Data <b>Merk</b> tidak boleh kosong !";		
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
		# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$Kode	= $_POST['txtKode'];
		$mySql	= "UPDATE merk SET merk='$txtMerk' WHERE kd_merk ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Merk-Data'>";
		}
		exit;
	}	
} // Penutup POST

# TAMPILKAN DATA DARI DATABASE
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT * FROM merk WHERE kd_merk='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	# MASUKKAN DATA KE VARIABEL FORM
	$dataKode	= $myData['kd_merk'];
	$dataMerk	= isset($_POST['txtMerk']) ? $_POST['txtMerk'] : $myData['merk'];
	
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
 <table class="table table-striped table-bordered table-condensed">
	<tr>
	  <th colspan="3">UBAH DATA MERK </th>
	</tr>
	<tr>
	  <td width="20%"><b>Merk</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="79%"><input name="txtMerk" type="text" value="<?php echo $dataMerk; ?>" size="80" maxlength="100" />
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

