<?php
session_start();
if (isset($_POST['no'])) {
    $dsn = 'mysql:host=localhost;dbname=kutuphane';
    $dbusername = 'root';
    $dbpassword = '';
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
    $dbh = new PDO($dsn, $dbusername, $dbpassword, $options);
    $da = array(':oduncno'=>$_POST['no']);
    $qq = "UPDATE `odunc_alma` SET `odunc_iade`=1 WHERE `odunc_no`= :oduncno";
    $sorgu = $dbh->prepare($qq);
    $sorgu->execute($da);
    $qq = "SELECT `isbn` FROM `odunc_alma` WHERE `odunc_no`= :oduncno";
    $sorgu = $dbh->prepare($qq);
    $sorgu->execute($da);
    $isbn = $sorgu->fetchAll(PDO::FETCH_COLUMN, 0);
    $da = array(':isbn'=>$isbn[0]);
    $qq = "UPDATE `kitap` SET `rafta_mi`= 1 WHERE `isbn`= :isbn";
    $sorgu = $dbh->prepare($qq);
    $sorgu->execute($da);
    echo json_encode(array('resp'=>'tamam'));
}
