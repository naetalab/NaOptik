<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
# KONTROL MENU PROGRAM
if(!isset($_SESSION['SES_LOGIN']))
{
	include "login.php";
}
else if($_GET) 
{
	// Jika mendapatkan variabel URL ?open
	if(isset($_GET['open']))
	{
		
	 switch($_GET['open'])
	 {				
		case '' :
			if(!file_exists ("main.php")) die ("File tidak ada!"); 
			include "main.php";	break;
			
		case 'Halaman-Utama' :
			if(!file_exists ("main.php")) die ("File tidak ada!"); 
			include "main.php";	break;
			
		case 'Login' :
			if(!file_exists ("login.php")) die ("File tidak ada!"); 
			include "login.php"; break;
			
		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("File tidak ada!"); 
			include "login_validasi.php"; break;
			
		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("File tidak ada!"); 
			include "login_out.php"; break;	

        
		

		# DATA User
		case 'User-Data' :
			if(!file_exists ("user_data.php")) die ("File tidak ada!"); 
			include "user_data.php";	 break;		
		case 'User-Add' :
			if(!file_exists ("user_add.php")) die ("File tidak ada!"); 
			include "user_add.php";	 break;		
		case 'User-Delete' :
			if(!file_exists ("user_delete.php")) die ("File tidak ada!"); 
			include "user_delete.php"; break;		
		case 'User-Edit' :
			if(!file_exists ("user_edit.php")) die ("File tidak ada!"); 
			include "user_edit.php"; break;	

		# JENIS
		case 'Jenis-Data' :
			if(!file_exists ("jenis_data.php")) die ("File tidak ada!"); 
			include "jenis_data.php"; break;		
		case 'Jenis-Add' :
			if(!file_exists ("jenis_add.php")) die ("File tidak ada!"); 
			include "jenis_add.php";	break;		
		case 'Jenis-Delete' :
			if(!file_exists ("jenis_delete.php")) die ("File tidak ada!"); 
			include "jenis_delete.php"; break;		
		case 'Jenis-Edit' :
			if(!file_exists ("jenis_edit.php")) die ("File tidak ada!"); 
			include "jenis_edit.php"; break;	
			
		# DATA BARANG
		case 'Barang-Data' :
			if(!file_exists ("barang_data.php")) die ("File tidak ada!"); 
			include "barang_data.php"; break;		
		case 'Barang-Add' :
			if(!file_exists ("barang_add.php")) die ("File tidak ada!"); 
			include "barang_add.php"; break;		
		case 'Barang-Delete' :
			if(!file_exists ("barang_delete.php")) die ("File tidak ada!"); 
			include "barang_delete.php"; break;		
		case 'Barang-Edit' :
			if(!file_exists ("barang_edit.php")) die ("File tidak ada!"); 
			include "barang_edit.php"; break;

		# Merk
		case 'Merk-Data' :
			if(!file_exists ("merk_data.php")) die ("File tidak ada!"); 
			include "merk_data.php"; break;		
		case 'Merk-Add' :
			if(!file_exists ("merk_add.php")) die ("File tidak ada!"); 
			include "merk_add.php"; break;
		case 'Merk-Delete' :
			if(!file_exists ("merk_delete.php")) die ("File tidak ada!"); 
			include "merk_delete.php"; break;
		case 'Merk-Edit' :
			if(!file_exists ("merk_edit.php")) die ("File tidak ada!"); 
			include "merk_edit.php"; break;

		case 'Pencarian-Barang' :
			if(!file_exists ("pencarian_barang.php")) die ("File tidak ada!"); 
			include "pencarian_barang.php"; break;		

			
		# Penjualan
		case 'Penjualan-Baru' :
			if(!file_exists ("penjualan_baru.php")) die ("Empty Main Page!"); 
			include "penjualan_baru.php";	break;
		case 'Penjualan-Tampil' : 
			if(!file_exists ("penjualan_tampil.php")) die ("Empty Main Page!"); 
			include "penjualan_tampil.php";	break;
		case 'Penjualan-Hapus' : 
			if(!file_exists ("penjualan_hapus.php")) die ("Empty Main Page!"); 
			include "penjualan_hapus.php";	break;
			
		
		

		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan' :
				if(!file_exists ("menu_laporan.php")) die ("File tidak ada!"); 
				include "menu_laporan.php"; break;

			# LAPORAN MASTER DATA
			
			
			
			case 'Laporan-User' :
				if(!file_exists ("laporan_user.php")) die ("File tidak ada!"); 
				include "laporan_user.php"; break;
	
			case 'Laporan-Merk' :	
				if(!file_exists ("laporan_merk.php")) die ("File tidak ada!"); 
				include "laporan_merk.php"; break;
				
			
			case 'Laporan-Barang' :	
				if(!file_exists ("laporan_barang.php")) die ("File tidak ada!"); 
				include "laporan_barang.php"; break;
				
			
															
			# LAPORAN PENJUALAN 
			case 'Laporan-Penjualan' :
				if(!file_exists ("laporan_penjualan.php")) die ("File tidak ada!"); 
				include "laporan_penjualan.php"; break;
				
			case 'Laporan-Penjualan-Periode' :
				if(!file_exists ("laporan_penjualan_periode.php")) die ("File tidak ada!"); 
				include "laporan_penjualan_periode.php"; break;
				
		default:
			if(!file_exists ("main.php")) die ("File tidak ada!"); 
			include "main.php";						
		break;
	 }
	}
	else
	{
	 if(!file_exists ("main.php")) die ("File tidak ada!"); 
	 include "main.php";	
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("main.php")) die ("File tidak ada!"); 
	include "main.php";	
}
?>