<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<h2>  DATA JENIS </h2>
<a href="?open=Jenis-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a>
<br /><br />

<table class="table table-striped table-bordered table-condensed">
  <tr>
    <th width="9%" bgcolor="#CCCCCC"><strong>No</strong></th>
    <th width="14%" bgcolor="#CCCCCC"><strong>Kode</strong></th>
    <th width="19%" bgcolor="#CCCCCC"><strong> Jenis </strong></th>
    <th width="33%" bgcolor="#CCCCCC"><strong>Ukuran </strong></th>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
		// Skrip menampilkan data dari database
		$mySql = "SELECT * FROM jenis ORDER BY kd_jenis ASC";
		$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$nomor = 0; 
		while ($myData = mysql_fetch_array($myQry)) {
			$nomor++;
			$Kode = $myData['kd_jenis'];
		?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_jenis']; ?></td>
    <td><?php echo $myData['nama_jenis']; ?></td>
    <td><?php echo $myData['ukuran']; ?></td>
    <td width="10%" align="center"><a href="?open=Jenis-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
    <td width="15%" align="center"><a href="?open=Jenis-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA KATEGORI INI ... ?')">Delete</a></td>
  </tr>
  <?php } ?>
</table>
