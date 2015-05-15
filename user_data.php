<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<h2> MANAJEMEN DATA USER </h2>
<a href="?open=User-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a>
<br /><br />

<table class="table table-striped table-bordered table-condensed">
   <tr>
    <th width="30"><b>No</b></th>
    <th width="74"><b>Kode</b></th>
    <th width="394"><b>Nama User </b></th>
    <th width="175"><b>Username</b></th>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	// Skrip menampilkan data dari database
	$mySql 	= "SELECT * FROM user ORDER BY kd_user ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode	= $myData['kd_user'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_user']; ?></td>
    <td><?php echo $myData['nm_user']; ?></td>
    <td><?php echo $myData['username']; ?></td>
    <td width="45" align="center"><a href="?open=User-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
    <td width="45" align="center"><a href="?open=User-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self">Delete</a></td>
  </tr>
  <?php } ?>
</table>
