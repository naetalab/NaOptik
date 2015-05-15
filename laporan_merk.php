<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<h2>DAFTAR MERK BARANG</h2>
<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="27" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    
    <td width="166" bgcolor="#CCCCCC"><strong>Nama Merk </strong></td>
   
  </tr>
	<?php
	// Skrip menampilkan data dari Database
	$mySql = "SELECT * FROM merk ORDER BY merk ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
   
    <td><?php echo $myData['merk']; ?></td>
    </tr>
  <?php } ?>
</table>
