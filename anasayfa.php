<?php
session_start();
if ($_SESSION["gir"] == 1){
    $dsn = 'mysql:host=localhost;dbname=kutuphane';
    $dbusername = 'root';
    $dbpassword = '';
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
    $dbh = new PDO($dsn, $dbusername, $dbpassword, $options);
    ?>
    <!DOCTYPE html>
    <html lang="en" style="min-height: 100%;">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />

        <link rel="icon" href="assets/images/favicon.ico">

        <title>Neon | Tables</title>

        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="assets/css/custom.css">

        <script src="assets/js/jquery-1.11.3.min.js"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body" data-url="http://neon.dev" >

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        <div class="sidebar-menu">

            <div class="sidebar-menu-inner">

                <header class="logo-env">


                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>


                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>

                </header>


                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <li>
                        <a href="anasayfa.php">
                            <i class="entypo-search"></i>
                            <span class="title">Kitap Arama</span>
                        </a>
                    </li>
                    <li>
                        <a href="uyelik.php">
                            <i class="entypo-user"></i>
                            <span class="title">Üyelik bilgilerim</span>
                        </a>
                    </li>
                    <li>
                        <a href="aldiginodunc.php">
                            <i class="entypo-monitor"></i>
                            <span class="title">Ödünç Aldığım Kitaplar</span>
                        </a>
                    </li>
                    <li>
                        <a href="oduncver.php" >
                            <i class="entypo-monitor"></i>
                            <span class="title">Ödünç Verdiğim Kitaplar</span>
                        </a>
                    </li>


                </ul>

            </div>

        </div>

        <div class="main-content" style="margin: 0 0 100px; padding-bottom: 50px;">

            <div class="row">

                <!-- Profile Info and Notifications -->
                <div class="col-md-6 col-sm-8 clearfix" >

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php
                                $kullanicino = $_SESSION['logged_user'];
                                $arr = array(':kullanicino' => $kullanicino);
                                $qry = 'SELECT * FROM uye WHERE `uye_no` = :kullanicino ';
                                $sth = $dbh->prepare($qry);
                                $sth->execute($arr);
                                $row        = $sth->fetch(PDO::FETCH_ASSOC);
                                $uyeadi      = $row['adi'];
                                $uyesoyadi  = $row['soyadi'];
                                echo "<h2>".$uyeadi." ".$uyesoyadi."</h2>";
                                ?>
                            </a>
                </div>

                <!-- Raw Links -->
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                    <ul class="list-inline links-list pull-right">
                        <li class="sep"></li>
                        <li>
                            <a href="extra-login.php?cik=1">
                                Çıkış <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>

            <hr />

            <h2 style="padding-top: 50px; padding-bottom:50px;">Kitap Arama</h2>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"></label>
                <form>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <input type="text" class="form-control input-lg" name="ara" id="ara" placeholder="Search">
                            <span class="input-group-btn" style="height: 30px;">
                            <button class="btn btn-primary" style="padding: 5px 12px;" type="submit" id="arabutton">
                                <i class="entypo-search" style="font-size: 22px;"></i>
                            </button>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
            <br />
            <div class="row">

                <div class="col-md-12">

                    </br>
                    </br>

                    <table class="table table-striped" id="anatablo">
                        <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Kitap adı</th>
                            <th>Yazar adı</th>
                            <th>Basım yılı</th>
                            <th>Yayın evi</th>
                            <th>Salon no</th>
                            <th>Raf no</th>
                            <th>Dolap no</th>
                            <th>Demirbaş no</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_GET['ara'])) {
                            $ara = $_GET['ara'];
                            $ara = htmlspecialchars($ara);

                            $veri = array(':name' => '%'.$ara.'%');
                            $query = 'SELECT * FROM kitap WHERE (`kitap_adi` LIKE :name)';
                            $sth = $dbh->prepare($query);
                            $sth->execute($veri);
                            $n = 0;
                            while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                $n +=1;
                                $resp[0] = $row['isbn'];
                                $resp[1] = $row['kitap_adi'];
                                $resp[3] = $row['basim_yili'];
                                $resp[4] = $row['yayinevi'];
                                $resp[5] = $row['salon_numarasi'];
                                $resp[6] = $row['raf_numarasi'];
                                $resp[7] = $row['bulundugu_dolap'];
                                $resp[8] = $row['demirbas_numarasi'];
                                $resp[9] = $row['rafta_mi'];
                                $veri = array(':isbn' => $resp[0]);
                                $query = 'SELECT * FROM kitap_yazar WHERE `isbn` = :isbn';
                                $cmd = $dbh->prepare($query);
                                $cmd->execute($veri);
                                $yazarlar = $cmd->fetchAll(PDO::FETCH_COLUMN,2);
                                $query = 'SELECT * FROM yazar WHERE (`yazar_no` = ';
                                for($dd =0; $dd < sizeof($yazarlar)-1;$dd++){
                                    $query = $query . $yazarlar[$dd] . ") OR (`yazar_no` = ";
                                }
                                $query = $query . $yazarlar[sizeof($yazarlar)-1] . ") ";
                                $cmd = $dbh->prepare($query);
                                $cmd->execute();
                                $resp [2] = "";
                                while ($row = $cmd->fetch(PDO::FETCH_ASSOC)){
                                    $resp[2] = $resp[2] . $row['yazar_adi'] . " ";
                                }
                                echo "<tr>";
                                for ($i = 0; $i <9; $i++){
                                    if ($resp[9] == 1){
                                        if ($i == 1){
                                            echo "<td><a href=\"javascript:;\" onclick=\"jQuery('#modal-6').modal('show', 
                                                {backdrop: 'static'});\">".$resp[$i]."</a></td>";
                                        }else{
                                            echo "<td>".$resp[$i]."</td>";
                                        }
                                    }else {
                                        if ($i == 1){
                                            echo "<td><a href=\"javascript:;\" onclick=\"alert('Bu kitap şu an mevcut degil!')\">"
                                                .$resp[$i]."</a></td>";
                                        }else{
                                            echo "<td>".$resp[$i]."</td>";
                                        }
                                    }
                                }
                                echo "</tr>";
                                ?>
                                <script type="text/javascript">
                                    var bn = <?php echo json_encode($resp[0]); ?>;
                                </script>
                                <?php

                            } if($n == 0) {
                                echo "</tbody> </table>";
                                echo "<h3 style='padding-left: 380px;'> Kitap bulunamadı </h3>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 6 (Responsive Modal)-->
    <div class="modal fade" id="modal-6">
        <div class="modal-dialog">
            <div class="modal-content" style=" width: 500px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Kitap Geri Verme Tarihi</h4>
                </div>
                <div class="modal-body" style=" height: 300px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Tarih</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" id="tarih" class="form-control datepicker" data-format="D, dd MM yyyy">

                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button id ="odunc" type="button" class="btn btn-info">Kaydet</button>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/search.js"></script>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="assets/js/zurb-responsive-tables/responsive-tables.css">
    <!-- Bottom scripts (common) -->
    <script src="assets/js/gsap/TweenMax.min.js"></script>
    <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/neon-api.js"></script>
    <!-- Imported scripts on this page -->
    <script src="assets/js/zurb-responsive-tables/responsive-tables.js"></script>

    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/neon-chat.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="assets/js/neon-custom.js"></script>
    <!-- Demo Settings -->
    <script src="assets/js/neon-demo.js"></script>
    </body>
    </html>
<?php
} else {
    header("location: extra-login.php");
}
?>
