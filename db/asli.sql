-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 18, 2015 at 09:53 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `optik`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `barang`
-- 

CREATE TABLE `barang` (
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) default NULL,
  `harga_beli` int(10) default NULL,
  `harga_jual` int(10) default NULL,
  `nama_jenis` varchar(10) default NULL,
  `ukuran` int(11) default NULL,
  `merk` varchar(30) default NULL,
  `stok` int(11) default NULL,
  PRIMARY KEY  (`kd_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `barang`
-- 

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `nama_jenis`, `ukuran`, `merk`, `stok`) VALUES 
('BR150002', 'Puma', 4000, 4000, '-', 8, 'Sundul Glass', 8),
('BR150000', 'Puma', 1000, 2000, '-', 5, 'Sundul Glass', 7),
('BR150001', 'Lens Optik (Plus)', 1000, 2000, '+', 5, 'Red buluk', 8),
('BR150003', 'Lens Optik ', 3000, 5000, '-', 5, 'Red buluk', 9),
('BR150004', 'Nike', 1000, 2000, '+', 5, 'Transfaran', 9);

-- --------------------------------------------------------

-- 
-- Table structure for table `jenis`
-- 

CREATE TABLE `jenis` (
  `kd_jenis` int(11) NOT NULL auto_increment,
  `nama_jenis` varchar(10) default NULL,
  `ukuran` int(11) default NULL,
  PRIMARY KEY  (`kd_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `jenis`
-- 

INSERT INTO `jenis` (`kd_jenis`, `nama_jenis`, `ukuran`) VALUES 
(2, '-', 5),
(1, '-', 5),
(5, '+', 2),
(3, '+', 8),
(4, '-', 5),
(6, '+', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `merk`
-- 

CREATE TABLE `merk` (
  `kd_merk` int(11) NOT NULL auto_increment,
  `merk` varchar(20) default NULL,
  PRIMARY KEY  (`kd_merk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `merk`
-- 

INSERT INTO `merk` (`kd_merk`, `merk`) VALUES 
(1, 'Sundul Glass'),
(2, 'Red buluk'),
(4, 'Transfaran');

-- --------------------------------------------------------

-- 
-- Table structure for table `penjualan`
-- 

CREATE TABLE `penjualan` (
  `kd_jual` varchar(8) NOT NULL,
  `tgl_penjualan` date default NULL,
  `uang_bayar` int(12) default NULL,
  PRIMARY KEY  (`kd_jual`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `penjualan`
-- 

INSERT INTO `penjualan` (`kd_jual`, `tgl_penjualan`, `uang_bayar`) VALUES 
('JL150003', '2015-05-17', 40000),
('JL150002', '2015-05-17', 25000);

-- --------------------------------------------------------

-- 
-- Table structure for table `penjualan_item`
-- 

CREATE TABLE `penjualan_item` (
  `kd_jual` varchar(8) NOT NULL,
  `kd_barang` varchar(8) default NULL,
  `jumlah` int(12) default NULL,
  `harga` int(12) default NULL,
  PRIMARY KEY  (`kd_jual`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `penjualan_item`
-- 

INSERT INTO `penjualan_item` (`kd_jual`, `kd_barang`, `jumlah`, `harga`) VALUES 
('JL150003', 'BR150002', 5, 4000),
('JL150002', 'BR150002', 6, 4000);

-- --------------------------------------------------------

-- 
-- Table structure for table `tmp_penjualan`
-- 

CREATE TABLE `tmp_penjualan` (
  `id` int(11) NOT NULL auto_increment,
  `kd_barang` varchar(8) character set latin1 NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `kd_user` varchar(11) character set latin1 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `tmp_penjualan`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `kd_user` varchar(6) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `username` varchar(20) default NULL,
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`kd_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` (`kd_user`, `nm_user`, `username`, `password`) VALUES 
('USER00', 'Hendry Cahyana', 'admin', '21232f297a57a5a743894a0e4a801fc3');
