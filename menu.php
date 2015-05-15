<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if(isset($_SESSION['SES_LOGIN'])){
# JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
?>
	
	  <ul class="nav navbar-nav">
						<li><a href='?open' title='Halaman Utama'>Beranda</a></li>
	
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money"></i> Transaksi Data <b class="caret"></b></a>
							<ul class="dropdown-menu">
								
								<li>
								<a href="?open=Penjualan-Baru"><i class="fa fa-money"> </i> Add Transaksi Penjualan </a>								
								</li>
								
								
								
							
								
								
	                            <li><a href='?open=Penjualan-Tampil' title='Penjualan Barang' ><i class="fa fa-money"> </i> Transaksi Penjualan</a></li>
	
							</ul>
						</li>
						
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-alt"> </i> Report<b class="caret"></b></a>
							<ul class="dropdown-menu">
								
								<li><a href="?open=Laporan-User"><i class="fa fa-list-alt"> </i> Laporan Data User</a></li>
								<li class="divider"></li>
								
								<li><a href="?open=Laporan-Merk"><i class="fa fa-list-alt"> </i> Laporan Data Merk Barang</a></li>
								
								<li><a href="?open=Laporan-Barang"><i class="fa fa-list-alt"> </i> Laporan Data Barang</a></li>

								<li><a href="?open=Laporan-Penjualan"><i class="fa fa-list-alt"> </i> Laporan Penjualan</a></li>
								<li><a href="?open=Laporan-Penjualan-Periode"><i class="fa fa-list-alt"> </i> Laporan Penjualan per Periode</a></li>
								
								
								
								
								<!--
								<li class="divider"></li>
								
								<li>
								
								
								<a href="http://localhost/ecanteen_ws/admin/mastertrans/charttotalmonth"><i class="fa fa-list-alt"> </i> Month Chart Total Report</a>								
								<a href="http://localhost/ecanteen_ws/admin/mastertrans/charttotalyear"><i class="fa fa-list-alt"> </i> Year Chart Total Report</a>								
								
								</li>
								-->
								
							</ul>
						</li>
						
						
						
						
								
																
								
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-archive"></i> Data Master <b class="caret"></b></a>
									<ul class="dropdown-menu">
									
									<li><a href='?open=User-Data' title='User Login'><i class="fa fa-archive"></i> Data User</a></li>
									
									<li class="divider"></li>
									<li><a href='?open=Jenis-Data' title='Jenis Lensa'><i class="fa fa-archive"></i> Data Jenis Lensa</a></li>
									<li><a href='?open=Merk-Data' title='Merk Data'> <i class="fa fa-archive"></i> Data Merk Data</a></li>
									<li><a href='?open=Barang-Data' title='Data Barang'><i class="fa fa-archive"></i> Data Barang</a></li>
									
									
									
									
									</ul>
								</li>
								
																
								
							
						
						
						

						
					
					</ul>
					
					
	  
	  
   
      <ul class="nav navbar-nav navbar-right">
        
		
						
		
        <li class="dropdown">
		  </li><li class="dropdown pull-right">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp;<?php echo $_SESSION['NAMA_LOGIN']; ?><b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="?open=User-Edit&Kode=<?php echo $_SESSION['SES_LOGIN']; ?>">Profile Settings</a></li>
				<li class="divider"></li>
				<li><a href='?open=Logout' title='Logout (Exit)' onclick="if (confirm(&quot;Do you want Logout ?&quot;)) { return true; } return false;">Logout</a></li>
			</ul>
		</li>         
          
        
      </ul>
	
</ul>
<?php
}
else {
# JIKA BELUM LOGIN (BELUM ADA SESION LEVEL YG DIBACA)
?>
<ul>
	<li><a href='?open=Login' title='Login System'>Login</a></li>	
</ul>
<?php
}
?>