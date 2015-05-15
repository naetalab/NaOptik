<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SKRIP SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Data Form
	$txtNama		= mysql_real_escape_string($_POST['txtNama']);
	$txtHargaBeli	= mysql_real_escape_string($_POST['txtHargaBeli']);
	$txtHargaJual	= mysql_real_escape_string($_POST['txtHargaJual']);
	$cmbJenis		= mysql_real_escape_string($_POST['cmbJenis']);
	$cmbUkuran	= mysql_real_escape_string($_POST['cmbUkuran']);
	$cmbMerk	= mysql_real_escape_string($_POST['cmbMerk']);
	$txtStok		= mysql_real_escape_string($_POST['txtStok']);

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Barang</b> tidak boleh kosong !";		
	}
	if (trim($txtHargaBeli)=="" or ! is_numeric(trim($txtHargaBeli))) {
		$pesanError[] = "Data <b>Harga Beli (Rp.)</b> harus diisi angka!";		
	}
	if (trim($txtHargaJual)=="" or ! is_numeric(trim($txtHargaJual))) {
		$pesanError[] = "Data <b>Harga Jual (Rp.)</b> harus diisi angka!";		
	}
	
	if (trim($cmbJenis)=="KOSONG") {
		$pesanError[] = "Data <b>Jenis</b> belum ada yang dipilih !";		
	}
	if (trim($cmbUkuran)=="KOSONG") {
		$pesanError[] = "Data <b>Ukuran</b> tidak boleh kosong !";		
	}
	if (trim($cmbMerk)=="KOSONG") {
		$pesanError[] = "Data <b>Merk Barang</b> belum ada yang dipilih !";		
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
$mySql	= "UPDATE barang SET nama_barang	= '$txtNama', 
                        harga_beli = '$txtHargaBeli',
						harga_jual	= '$txtHargaJual',
						nama_jenis		= '$cmbJenis',
						ukuran		= '$cmbUkuran',
						merk	= '$cmbMerk',
						stok	= '$txtStok'
				WHERE kd_barang ='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
if($myQry){
	echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Data'>";
}
exit;
	}
} // Penutup POST
	
	
# TAMPILKAN DATA UNTUK DIEDIT
$Kode	= mysql_real_escape_string($_GET['Kode']); 
$mySql 	= "SELECT * FROM barang WHERE kd_barang='$Kode'";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query data salah : ".mysql_error());
$myData	= mysql_fetch_array($myQry);
	// Membaca data, lalu disimpan dalam variabel data
		$dataKode	= $myData['kd_barang'];

	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nama_barang'];
	$dataHargaBeli	= isset($_POST['txtHargaBeli']) ? $_POST['txtHargaBeli'] : $myData['harga_beli'];
	$dataHargaJual	= isset($_POST['txtHargaJual']) ? $_POST['txtHargaJual'] : $myData['harga_jual'];
	$dataJenis	= isset($_POST['cmbJenis']) ? $_POST['cmbJenis'] : $myData['nama_jenis'];
	$dataUkuran		= isset($_POST['cmbUkuran']) ? $_POST['cmbUkuran'] : $myData['ukuran'];
	$dataMerk	= isset($_POST['cmbMerk']) ? $_POST['cmbMerk'] : $myData['merk'];
	$dataStok		= isset($_POST['txtStok']) ? $_POST['txtStok'] :  $myData['stok'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
   <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th colspan="3" scope="col">UBAH DATA BARANG</th>
    </tr>
    <tr>
      <td width="16%"><strong>Nama Barang </strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="83%"><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" />
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Harga Beli (Rp.) </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtHargaBeli" value="<?php echo $dataHargaBeli; ?>" size="20" maxlength="12" 
	  			onblur="if (value == '') {value = '0'}" 
				onfocus="if (value == '0') {value =''}"/></td>
    </tr>
    <tr>
      <td><strong>Harga Jual (Rp.) </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtHargaJual" value="<?php echo $dataHargaJual; ?>" size="20" maxlength="12" 
	  			onblur="if (value == '') {value = '0'}" 
				onfocus="if (value == '0') {value =''}"/></td>
    </tr>
    <tr>
      <td><b>Jenis Ukuran</b></td>
      <td><b>:</b></td>
      <td><select name="cmbJenis">
        <option value="KOSONG">....</option>
        <?php
	  $bacaSql = "SELECT * FROM jenis ORDER BY kd_jenis";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['nama_jenis'] == $dataJenis) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[nama_jenis]' $cek>$bacaData[nama_jenis]</option>";
	  }
	  ?>
      </select>
        <select name="cmbUkuran">
          <option value="KOSONG">....</option>
          <?php
	  $bacaSql = "SELECT * FROM jenis ORDER BY kd_jenis";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['ukuran'] == $dataUkuran) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[ukuran]' $cek>$bacaData[ukuran]</option>";
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Merk</strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbMerk">
        <option value="KOSONG">....</option>
        <?php
	  $bacaSql = "SELECT * FROM merk ORDER BY kd_merk";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['merk'] == $dataMerk) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[merk]' $cek>$bacaData[merk]</option>";
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Stok</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtStok" value="<?php echo $dataStok; ?>" size="80" maxlength="200" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
  </table>
</form>
