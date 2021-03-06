<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca variabel URL browser
$kodeMerk = isset($_GET['kodeMerk']) ? mysql_real_escape_string($_GET['kodeMerk']) : 'SEMUA'; 
// Baca variabel dari Form setelah di Post
$kodeMerk = isset($_POST['cmbMerk']) ? mysql_real_escape_string($_POST['cmbMerk']) : $kodeMerk;

// Membuat filter SQL
if ($kodeMerk=="SEMUA") {
	//Query #1 (semua data)
	$filterSQL 	= "";
}
else {
	//Query #2 (filter)
	$filterSQL 	= " WHERE barang.merk ='$kodeMerk'";
}


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris 		= 50;
$halaman 	= isset($_GET['hal']) ? mysql_real_escape_string($_GET['hal']) : 0;
$pageSql 	= "SELECT * FROM barang $filterSQL";
$pageQry 	= mysql_query($pageSql, $koneksidb) or die("Error paging:".mysql_error());
$jmlData	= mysql_num_rows($pageQry);
$maksData	= ceil($jmlData/$baris);
?>
<h2> LAPORAN DATA BARANG </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table class="table table-striped table-bordered table-condensed">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="84"><strong> Merk </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="397">
	  <select name="cmbMerk">
        <option value="SEMUA">....</option>
        <?php
	  $bacaSql = "SELECT * FROM merk ORDER BY kd_merk";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_merk'] == $kodeMerk) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[merk]' $cek>$bacaData[merk]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/></td>
    </tr>
  </table>
</form>

<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="26" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="58" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="273" bgcolor="#CCCCCC"><strong>Nama Barang</strong></td>
    <td width="76" bgcolor="#CCCCCC"><strong>Jenis Ukuran</strong></td>
    <td width="31" align="right" bgcolor="#CCCCCC"><strong>Stok</strong></td>
    <td width="100" align="right" bgcolor="#CCCCCC"><strong>Hrg. Beli  (Rp) </strong></td>
    <td width="100" align="right" bgcolor="#CCCCCC"><strong>Hrg. Jual  (Rp) </strong></td>
  </tr>
  <?php
	// Skrip menampilkan data dari database
	$mySql 	= "SELECT * FROM barang $filterSQL ORDER BY kd_barang ASC LIMIT $halaman, $baris";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $halaman; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['kd_barang']; ?> </td>
    <td> <?php echo $myData['nama_barang']; ?> </td>
    <td> <?php echo $myData['nama_jenis']; ?><?php echo $myData['ukuran']; ?></td>
    <td align="right"> <?php echo $myData['stok']; ?> </td>
    <td align="right"><?php echo format_angka($myData['harga_beli']); ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
  </tr>
  <?php } ?>
  <tr class="selKecil">
    <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jmlData; ?> </td>
    <td colspan="4" align="right">
	<strong>Halaman ke :</strong>
    <?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?open=Laporan-Barang&hal=$list[$h]&kodeKategori=$kodeKategori'>$h</a> ";
	}
	?></td>
  </tr>
</table>
