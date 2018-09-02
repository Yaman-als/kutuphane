<?php
//error_reporting(1);
$dsn		 = 'mysql:host=localhost;dbname=kutuphane';
$dbusername	 = 'root';
$dbpassword	 = '';
$options	 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 
$dbh 		 = new PDO($dsn, $dbusername, $dbpassword, $options);

$adi            = $_POST["adi"];
$soyad          = $_POST["soyad"];
$telno          = $_POST["telno"];
$tcno           = $_POST["tcno"];
$kullaniciadi   = $_POST["kullaniciadi"];
$email          = $_POST["email"];
$sifre          = $_POST["sifre"];
$di 		= array(':adi' => $adi,':soyad' => $soyad, ':uyetc' => $tcno,
    ':kullaniciadi' =>$kullaniciadi,':sifre' => $sifre);
$qq 		= "INSERT INTO `uye`(`adi`,`soyadi`,`uye_tc`, `kullanici_adi`, `sifre`) 
            VALUES (:adi, :soyad, :uyetc, :kullaniciadi, :sifre)";
$sth 		= $dbh->prepare($qq);
$a          =$sth->execute($di);
$di 		= array(':kullaniciadi' =>$kullaniciadi);
$qq         = 'SELECT * FROM uye WHERE kullanici_adi= :kullaniciadi';
$sth        = $dbh->prepare($qq);
$sth->execute($di);
$row        = $sth->fetch(PDO::FETCH_ASSOC);
$uyeno      = $row['uye_no'];
$di 		= array(':uyeno' => $uyeno,':telno' => $telno);
$qq 		= "INSERT INTO `uye_tel`(`uye_no`,`tel`) VALUES (:uyeno, :telno)";
$sth 		= $dbh->prepare($qq);
$a          =$sth->execute($di);
$di 		= array(':uyeno' => $uyeno,':email' => $email);
$qq 		= "INSERT INTO `uye_eposta`(`uye_no`,`eposta`) VALUES (:uyeno, :email)";
$sth 		= $dbh->prepare($qq);
$a          =$sth->execute($di);

$resp = array('submitted_data'=>$_POST);
echo json_encode($resp);

