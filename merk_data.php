<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<h2> MANAJEMEN DATA MERK </h2>
<a href="?open=Merk-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a>
<br /><br />

<table class="table table-striped table-bordered table-condensed">
  <tr>
    <th width="29" align="center" bgcolor="#CCCCCC"><b>No</b></th>
    <th width="208" bgcolor="#CCCCCC"><b>Merk</b></th>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b><b></b></td>
  </tr>
  <?php
	// Skrip menampilkan data dari database
	$mySql = "SELECT * FROM merk ORDER BY kd_merk ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_merk'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['merk']; ?></td>
    <td width="43" align="center"><a href="?open=Merk-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
    <td width="47" align="center"><a href="?open=Merk-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA SUPPLIER INI ... ?')">Delete</a></td>
  </tr>
  <?php } ?>
</table>
