<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=kutuphane';
$dbusername = 'root';
$dbpassword = '';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
$dbh = new PDO($dsn, $dbusername, $dbpassword, $options);



if (isset($_POST['ara'])) {
    $ara = $_POST['ara'];
//$ara = "veritabanı yönetim sistemleri";
    $ara = htmlspecialchars($ara);

    $veri = array(':name' => $ara);
    $query = 'SELECT * FROM kitap WHERE (`kitap_adi` LIKE :name)';
    $sth = $dbh->prepare($query);
    $sth->execute($veri);


    while ($row = $sth->fetch(PDO::FETCH_ASSOC)){

        $resp[0] = $row['isbn'];
        $resp[1] = $row['kitap_adi'];
        $resp[3] = $row['basim_yili'];
        $resp[4] = $row['yayinevi'];
        $resp[5] = $row['salon_numarasi'];
        $resp[6] = $row['raf_numarasi'];
        $resp[7] = $row['bulundugu_dolap'];
        $resp[8] = $row['demirbas_numarasi'];
        $resp[9] = $row['rafta_mi'];
    }
    if (isset($resp[0])){
        $veri = array(':isbn' => $resp[0]);
        $query = 'SELECT * FROM kitap_yazar WHERE `isbn` = :isbn';
        $sth = $dbh->prepare($query);
        $sth->execute($veri);
        $yazarlar = $sth->fetchAll(PDO::FETCH_COLUMN,2);
        $query = 'SELECT * FROM yazar WHERE (`yazar_no` = ';
        for($dd =0; $dd < sizeof($yazarlar)-1;$dd++){
            $query = $query . $yazarlar[$dd] . ") OR (`yazar_no` = ";
        }
        $query = $query . $yazarlar[sizeof($yazarlar)-1] . ") ";
        $sth = $dbh->prepare($query);
        $sth->execute();
        $resp [2] = "";
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $resp[2] = $resp[2] . $row['yazar_adi'] . " ";
        }

        $cev['resp'] = $resp;
        echo json_encode($cev,JSON_UNESCAPED_UNICODE);
    } else {
        $cev['resp'] = "no results found";
        echo json_encode($cev);
    }
} else {
    $cev['resp'] = "no results found";
    echo json_encode($cev);
}


//for ($i = 2; $i <= 12; $i++){}
//$resp['sonuc'] = $row;
//echo json_encode($resp);


