<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=kutuphane';
$dbusername = 'root';
$dbpassword = '';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
$dbh = new PDO($dsn, $dbusername, $dbpassword, $options);

if (isset($_POST['kitapadi'])){
    $veri = array(':kategori'=>$_POST['kategori']);
    $qq = "SELECT `kategori_no` FROM `kategori` WHERE `kategori_isim` = :kategori";
    $sth = $dbh->prepare($qq);
    $sth->execute($veri);
    $kategorino = $sth->fetchAll(PDO::FETCH_COLUMN,0);
    //echo "kategori no :";
    //var_dump($kategorino);
    //echo "</br>";
    $veri = array(':uyeno'=>$_SESSION['logged_user']);
    $qq = "SELECT `tedarikci_no` FROM `tedarikci` WHERE `tedarikci_adi` = :uyeno";
    $sth = $dbh->prepare($qq);
    $sth->execute($veri);
    $aa = $sth->fetchAll(PDO::FETCH_COLUMN,0);

    if(!isset($aa[0])){
        $veri = array(':uyeno'=>$_SESSION['logged_user']);
        $qq = "INSERT INTO `tedarikci`(`tedarikci_adi`, `tedarikci_tipi`) VALUES (:uyeno,0)";
        $sth = $dbh->prepare($qq);
        $sth->execute($veri);
        $qq = "SELECT `tedarikci_no` FROM `tedarikci` WHERE `tedarikci_adi` = :uyeno";
        $sth = $dbh->prepare($qq);
        $sth->execute($veri);
        $aa = $sth->fetchAll(PDO::FETCH_COLUMN,0);
        //echo "tedarici no after insert:".$aa[0];
    }
    $veri=array(':isbn'=>$_POST['isbn'],':kitapadi'=>$_POST['kitapadi'],':yayinevi'=>$_POST['yayinevi'],
        ':basimyili'=>$_POST['basimyili'],':salonno'=>$_POST['salonno'],':rafno'=>$_POST['rafno'],
        ':dolapno'=>$_POST['dolapno'],':demirno'=>$_POST['demirbasno'],':kategori'=>$kategorino[0],
        ':tedarikci'=>$aa[0]);
    $qq="INSERT INTO `kitap`(`isbn`, `kitap_adi`, `yayinevi`, `salon_numarasi`, `raf_numarasi`, 
          `bulundugu_dolap`, `demirbas_numarasi`, `tedarikci`, `rafta_mi`, `basim_yili`, `kategori_no`)
           VALUES (:isbn,:kitapadi,:yayinevi,:salonno,:rafno,:dolapno,:demirno
                    ,:tedarikci,0,:basimyili,:kategori)";
    $sth = $dbh->prepare($qq);
    $bb = $sth->execute($veri);
    $veri = array(':yazaradi'=>$_POST['yazaradi']);
    $qq = "SELECT `yazar_no` FROM `yazar` WHERE `yazar_adi` = :yazaradi";
    $sth = $dbh->prepare($qq);
    $sth->execute($veri);
    $sonuc = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
    if (!isset($sonuc[0])){
        $qq = "INSERT INTO `yazar`(`yazar_adi`) VALUES (:yazaradi)";
        $sth = $dbh->prepare($qq);
        $sth->execute($veri);
        $qq = "SELECT `yazar_no` FROM `yazar` WHERE `yazar_adi` = :yazaradi";
        $sth = $dbh->prepare($qq);
        $sth->execute($veri);
        $sonuc = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    $veri = array(':isbn'=>$_POST['isbn'], ':yazarno' => $sonuc[0]);
    $qq= "INSERT INTO `kitap_yazar`(`isbn`, `yazar_no`) VALUES (:isbn,:yazarno)";
    $sth = $dbh->prepare($qq);
    $dd = $sth->execute($veri);
    if ($bb AND $dd){
        echo json_encode(array(0=>$bb));
    }else{
        echo json_encode(array(0=>0));
    }
}
?>