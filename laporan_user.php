<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<h2> DAFTAR USER </h2>
<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="30" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="70" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="349" bgcolor="#CCCCCC"><strong>Nama Kasir </strong></td>
    <td width="130" bgcolor="#CCCCCC"><strong>Username</strong></td>
  </tr>
	<?php
		// Skrip menampilkan data dari database
		$mySql 	= "SELECT * FROM user ORDER BY kd_user";
		$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$nomor  = 0; 
		while ($myData = mysql_fetch_array($myQry)) {
			$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_user']; ?></td>
    <td><?php echo $myData['nm_user']; ?></td>
    <td><?php echo $myData['username']; ?></td>
  </tr>
  <?php } ?>
</table>
