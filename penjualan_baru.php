<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "../library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# HAPUS DAFTAR barang DI TMP
if(isset($_GET['Aksi'])){
	if(trim($_GET['Aksi'])=="Delete"){
		# Hapus Tmp jika datanya sudah dipindah
		$mySql = "DELETE FROM tmp_penjualan WHERE kd_barang='".mysql_real_escape_string($_GET['Kode'])."'";
		mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
	}
}
// =========================================================================

# TOMBOL TAMBAH (KODE barang) DIKLIK
if(isset($_POST['btnTambah'])){
	# Baca Data dari Form
	 $txtKode = mysql_real_escape_string($_POST['txtKode']);
	$txtHarga	= mysql_real_escape_string($_POST['txtHarga']);
	$txtJumlah	= mysql_real_escape_string($_POST['txtJumlah']);
   
	# Validasi Form
	$pesanError = array();
	
	if (trim($txtKode)=="") {
		$pesanError[] = "Data <b>Kode Barang belum dipilih</b>, silahkan pilih dari kode barang!";		
	}
	
	
	if (trim($txtJumlah)=="" or ! is_numeric(trim($txtJumlah))) {
		$pesanError[] = "Data <b>Jumlah Barang (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
	}
	
	# Cek Stok, jika stok Opname (stok bisa dijual) < kurang dari Jumlah yang dibeli, maka buat Pesan Error
	$cekSql	= "SELECT stok FROM barang WHERE kd_barang='$txtKode'";
	$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query".mysql_error());
	$cekRow = mysql_fetch_array($cekQry);
	if ($cekRow['stok'] < $txtJumlah) 
	{
		$pesanError[] = "Stok Barang untuk Kode <b>$txtKode</b> adalah <b> $cekRow[stok]</b>, tidak dapat dijual!";
	}
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else 
	{
		# SIMPAN KE DATABASE (tmp_penjualan)	
		// Jika Kode ditemukan, masukkan data ke Keranjang (TMP)
		if(!empty($txtKode))
		{
			$tmpSql = "INSERT INTO tmp_penjualan (kd_barang, harga, jumlah) 
					VALUES ('$txtKode', '$txtHarga', '$txtJumlah')";
		    mysql_query($tmpSql, $koneksidb) or die ("Gagal Query tmp : ".mysql_error());
			
		}
	}
}
// ============================================================================

# ========================================================================================================
# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan']))
{
	# Baca Variabel from
	$txtTanggal 	= $_POST['txtTanggal'];
	$txtUangBayar	= $_POST['txtUangBayar'];
	$txtTotBayar	= $_POST['txtTotBayar'];
			
	# Validasi Form
	$pesanError = array();
	if(trim($txtTanggal)=="") {
		$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi, pilih pada tanggal !";		
	}
	
	if(trim($txtUangBayar)==""  or ! is_numeric(trim($txtUangBayar))) {
		$pesanError[] = "Data <b>Uang Bayar</b> belum diisi, harus berupa angka !";		
	}
	if(trim($txtUangBayar) < trim($txtTotBayar)) {
		$pesanError[] = "Data <b> Uang Bayar Belum Cukup</b>.  
						 Total belanja adalah <b> Rp. ".format_angka($txtTotBayar)."</b>";		
	}
	
	# Periksa apakah sudah ada barang yang dimasukkan
	$tmpSql = "SELECT COUNT(*) As qty FROM tmp_penjualan";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmpData= mysql_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR BARANG MASIH KOSONG</b>, belum ada barang yang dimasukan, <b>minimal 1 barang</b>.";
	}
	
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	
		# SIMPAN DATA KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka penyimpanan dilakukan. Data dari tmp dipindah ke tabel penjualan dan penjualan_item
		$kd_jual = buatKode("penjualan", "JL15");
		$mySql	= "INSERT INTO penjualan SET 
						kd_jual='$kd_jual', 
						tgl_penjualan='".InggrisTgl($txtTanggal)."', 
						uang_bayar='$txtUangBayar'";
		mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		
		# …LANJUTAN, SIMPAN DATA
		# Ambil semua data barang yang dipilih, berdasarkan kasir yg login
		$tmpSql ="SELECT * FROM tmp_penjualan ORDER BY kd_barang";
		$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
		while ($tmpData = mysql_fetch_array($tmpQry)) {
			// Baca data dari tabel barang dan jumlah yang dibeli dari TMP
			$dataKode 	= $tmpData['kd_barang'];
			$dataHarga	= $tmpData['harga'];
			$dataJumlah	= $tmpData['jumlah'];
			
			// MEMINDAH DATA, Masukkan semua data di atas dari tabel TMP ke tabel ITEM
			$itemSql = "INSERT INTO penjualan_item SET 
									kd_jual='$kd_jual', 
									kd_barang='$dataKode', 
									harga='$dataHarga', 
									jumlah='$dataJumlah'";
			mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());
			
			
		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_penjualan";
		mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
		
		// Refresh form
		echo "<script>";
		echo "window.open('penjualan_nota.php?noNota=$no_jual', width=330,height=330,left=100, top=25)";
		echo "</script>";

	}	
}


if(isset($_POST['btnCek']))
{
	$txtKode = $_POST['txtKode'];
	$tmpSql = "SELECT * FROM barang WHERE kd_barang='$txtKode'";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmpData= mysql_fetch_array($tmpQry);
	$dataKode=$tmpData['kd_barang'];
	$dataNama=$tmpData['nama_barang'];
	$dataMerk=$tmpData['merk'];
	$dataJenis=$tmpData['nama_jenis'];
	$dataUkuran=$tmpData['ukuran'];
	$dataHargaJual=$tmpData['harga_jual']; //didie
}

# TAMPILKAN DATA KE FORM
$kd_jual 	= buatKode("penjualan", "JL15");
$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$dataUangBayar	= isset($_POST['txtUangBayar']) ? $_POST['txtUangBayar'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
   <table class="table table-striped table-bordered table-condensed">
    <tr>
      <td colspan="3"><h1>PENJUALAN BARANG</h1></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>DATA TRANSAKSI </strong></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="26%"><strong>No. Penjualan </strong></td>
      <td width="2%"><strong>:</strong></td>
      <td width="72%"><input name="txtNomor" value="<?php echo $kd_jual; ?>" size="23" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Tgl. Penjualan </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTanggal" type="text" class="tcal" value="<?php echo $dataTanggal; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>INPUT  BARANG </strong></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td><strong>Kode Barang</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtKode" value="<?php echo $dataKode; ?>" size="13" maxlength="13" />
	  <input name="btnCek" type="submit" value="Cek" /></td>
    </tr>
	<tr>
      <td><strong>Nama Barang</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="40" maxlength="40" readonly /></td>
    </tr>
    <tr>
      <td><strong>Merk</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtMerk" value="<?php echo $dataMerk; ?>" size="40" maxlength="40" readonly="readonly" /></td>
    </tr>
    <tr>
      <td><strong>Jenis Ukuran </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtJenis" value="<?php echo $dataJenis; ?>" size="5" maxlength="40" readonly="readonly" />
      <input name="txtUkuran" value="<?php echo $dataUkuran; ?>" size="5" maxlength="40" readonly="readonly" /></td>
    </tr>
    <tr>
      <td><b>Harga Jual (Rp)</b></td>
      <td><b>:</b></td>
      <td><b>
        <input name="txtHarga" value="<?php echo $dataHargaJual; ?>" size="40" maxlength="40" readonly="readonly" />
Jumlah :
<input class="angkaC" name="txtJumlah" size="4" maxlength="4" value="1" 
				 onblur="if (value == '') {value = '1'}" 
				 onfocus="if (value == '1') {value =''}"/>
        <input name="btnTambah" type="submit" style="cursor:pointer;" value=" Tambah " />
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   
  </table>
  <br>
   <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th colspan="7">DAFTAR BARANG </th>
    </tr>
    <tr>
      <td width="29" bgcolor="#CCCCCC"><strong>No</strong></td>
      <td width="85" bgcolor="#CCCCCC"><strong>Kode</strong></td>
      <td width="432" bgcolor="#CCCCCC"><strong>Nama Barang </strong></td>
      <td width="85" align="right" bgcolor="#CCCCCC"><strong>Harga (Rp) </strong></td>
      <td width="48" align="right" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
      <td width="100" align="right" bgcolor="#CCCCCC"><strong>Subtotal(Rp) </strong></td>
      <td width="22" align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
<?php
// deklarasi variabel
$hargaDiskon= 0; 
$totalBayar	= 0; 
$jumlahbarang	= 0;

// Qury menampilkan data dalam Grid TMP_Penjualan 
$tmpSql ="SELECT barang.nama_barang, tmp.* FROM tmp_penjualan As tmp
		LEFT JOIN barang ON tmp.kd_barang = barang.kd_barang ORDER BY barang.kd_barang ";
$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$nomor=0;  
while($tmpData = mysql_fetch_array($tmpQry)) {
	$nomor++;
	$subSotal 	= $tmpData['harga'] * $tmpData['jumlah'];
	$totalBayar	= $totalBayar + $subSotal;
	$jumlahbarang	= $jumlahbarang + $tmpData['jumlah'];
?>
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $tmpData['kd_barang']; ?></b></td>
      <td><?php echo $tmpData['nama_barang']; ?></td>
      <td align="right"><?php echo format_angka($tmpData['harga']); ?></td>
      <td align="right"><?php echo $tmpData['jumlah']; ?></td>
      <td align="right"><?php echo format_angka($subSotal); ?></td>
      <td><a href="?Aksi=Delete&Kode=<?php echo $tmpData['kd_barang']; ?>" target="_self">Delete</a></td>
    </tr>
<?php } ?>
    <tr>
      <td colspan="4" align="right" bgcolor="#F5F5F5"><strong>GRAND TOTAL : </strong></td>
      <td align="right" bgcolor="#F5F5F5"><b><?php echo $jumlahbarang; ?></b></td>
      <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($totalBayar); ?></b></td>
      <td bgcolor="#F5F5F5"><input name="txtTotBayar" type="hidden" value="<?php echo $totalBayar; ?>" /></td>
    </tr>
  </table>
  
   <table class="table table-striped table-bordered table-condensed">
	 <tr>
      <td bgcolor="#CCCCCC"><strong>PEMBAYARAN</strong></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Uang Bayar (Rp) </strong></td>
      <td><b>:</b></td>
      <td><input name="txtUangBayar" value="<?php echo $dataUangBayar; ?>" size="20" maxlength="12"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " /></td>
    </tr>
	</table>
  
</form>
