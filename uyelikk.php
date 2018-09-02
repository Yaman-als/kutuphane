<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=kutuphane';
$dbusername = 'root';
$dbpassword = '';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
$dbh = new PDO($dsn, $dbusername, $dbpassword, $options);
if (isset($_POST['arac'])){
    if ($_POST['arac'] == 'tel'){
        $veri = array(':uyeno'=>$_SESSION['logged_user']);
        $qq = "SELECT COUNT(*) FROM `uye_tel` WHERE `uye_no` = :uyeno";
        $sth = $dbh->prepare($qq);
        $sth->execute($veri);
        $count = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
        if ($count[0] > 1){
            //$veri = array(':no'=>'1');
            $veri = array(':no'=>$_POST['no']);
            $qq= "DELETE FROM `uye_tel` WHERE `no` = :no";
            $sth = $dbh->prepare($qq);
            $sth->execute($veri);
            echo json_encode(array('resp'=>'tamam'));
        }else {
            echo json_encode(array('resp'=>'silinmedi'));
        }
    }elseif ($_POST['arac'] == 'eposta'){
        $veri = array(':uyeno'=>$_SESSION['logged_user']);
        $qq = "SELECT COUNT(*) FROM `uye_eposta` WHERE `uye_no` = :uyeno";
        $sth = $dbh->prepare($qq);
        $sth->execute($veri);
        $count = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
        if ($count[0] > 1){
            $veri = array(':no'=>$_POST['no']);
            $qq= "DELETE FROM `uye_eposta` WHERE `no` = :no";
            $sth = $dbh->prepare($qq);
            $sth->execute($veri);
            echo json_encode(array('resp'=>'tamam'));
        }else{
            echo json_encode(array('resp'=>'silinmedi'));
        }
    }
}
if (isset($_POST['iletisim'])){
    if ($_POST['iletisim'] == "Telefon"){
        $veri = array(':uyeno'=>$_SESSION['logged_user'], ':tel'=>$_POST['deger']);
        $qq = "INSERT INTO `uye_tel`(`uye_no`,`tel`) VALUES (:uyeno, :tel)";
        $sth=$dbh->prepare($qq);
        $aa = $sth->execute($veri);
        if ($aa){
            echo json_encode(array(0=>$aa));
        }else {
            echo json_encode(array(0=>0));
        }
    }else if ($_POST['iletisim'] == "Eposta"){
        $veri = array(':uyeno'=>$_SESSION['logged_user'], ':posta'=>$_POST['deger']);
        $qq = "INSERT INTO `uye_eposta`(`uye_no`,`eposta`) VALUES (:uyeno, :posta)";
        $sth=$dbh->prepare($qq);
        $aa = $sth->execute($veri);
        if ($aa){
            echo json_encode(array(0=>2));
        }else {
            echo json_encode(array(0=>0));
        }
    }
}

if (isset($_POST['sifre'])){
    $veri=array(':sifre'=>$_POST['sifre'],':uyeno'=>$_SESSION['logged_user']);
    $qq="UPDATE `uye` SET `sifre`= :sifre WHERE `uye_no`= :uyeno";
    $sth = $dbh->prepare($qq);
    $bb = $sth->execute($veri);
    if ($bb){
        echo json_encode(array(0=>$bb));
    }else{
        echo json_encode(array(0=>0));
    }
}
