<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
error_reporting(1);
$dsn		 = 'mysql:host=localhost;dbname=kutuphane';
$dbusername	 = 'root';
$dbpassword	 = '';
$options	 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 
$dbh 		 = new PDO($dsn, $dbusername, $dbpassword, $options);

$q = 'SELECT * FROM uye WHERE kullanici_adi = :user';
$veriler = array(':user' => $username);
$sorgu = $dbh->prepare($q);
$sorgu->execute($veriler);
$kullaniciadi = $sorgu->fetchAll(PDO::FETCH_COLUMN, 2);
$sorgu->execute($veriler);
$sifre = $sorgu->fetchAll(PDO::FETCH_COLUMN, 5);

$login_status = 'invalid';
if ($username == $kullaniciadi[0] && $password == $sifre[0]) {
    $login_status = 'success';
}
$resp['login_status'] = $login_status;
if ($login_status == 'success') {
    $sorgu->execute($veriler);
    $userid = $sorgu->fetchAll(PDO::FETCH_COLUMN, 0);
    $_SESSION["gir"] = 1;
    $_SESSION["logged_user"] = $userid[0];
    $_SESSION["st"] = 1;
    // Set the redirect url after successful login
    $resp['redirect_url'] = 'http://localhost/kutuphane/anasayfa.php';
}
$resp = array('submitted_data'=>$_POST);
echo json_encode($resp);
