<?php
session_start();
if (isset($_POST['odunc'])) {
    $dsn = 'mysql:host=localhost;dbname=kutuphane';
    $dbusername = 'root';
    $dbpassword = '';
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
    $dbh = new PDO($dsn, $dbusername, $dbpassword, $options);
    $arr[0] = $_SESSION['logged_user'];
    $arr[0] = (integer)$arr[0];
    $arr[1] = $_POST['isbn'];
    $arr[2] = date("Y-m-d", time());
    $arr[3] = new DateTime($_POST['odunc']);
    $arr[3] = $arr[3]->format("Y-m-d");
    $butarih = new DateTime($arr[2]);
    $bitistarih = new DateTime($arr[3]);
    $arr[4] = $bitistarih->diff($butarih)->days;
    $arr[5] = 0;
    $dizi = array(':uyeno'=>$arr[0], ':isbn'=>$arr[1], ':baslangic'=>$arr[2], ':bitis'=>$arr[3],
                    ':sure'=>$arr[4], ':iade'=>$arr[5]);
    $qq = "INSERT INTO `odunc_alma`(`uye_no`, `isbn`, `balangic_tarihi`, `bitis_tarihi`, `odunc_suresi`, `odunc_iade`)
            VALUES (:uyeno,:isbn,:baslangic,:bitis,:sure,:iade)";
    $cc = $dbh->prepare($qq);
    $aa = $cc->execute($dizi);
    //echo $aa;
    $dizi2 = array(':isbn'=>$arr[1]);
    $qq2 = 'UPDATE `kitap` SET `rafta_mi`= 0 WHERE `isbn`= :isbn';
    $cc2 = $dbh->prepare($qq2);
    $aa = $cc2->execute($dizi2);
    $cev['resp'] = "Tamam";
    echo json_encode($cev);
}