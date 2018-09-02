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
                        <a href="oduncver.php">
                            <i class="entypo-monitor"></i>
                            <span class="title">Ödünç Verdiğim Kitaplar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content" style="margin: 0 0 100px; padding-bottom: 40px;">

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
            <h2 style="padding-top: 10px; padding-bottom:0px;  ">Ödünç Verme</h2>
            <br class="row">
            <br class="col-md-12">
            <br class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    Kitap detayları
                </div>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal form-groups-bordered">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="isbn" placeholder="ISBN">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kitapadi" placeholder="Kitap Adi">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="yazaradi" placeholder="Yazar Adi">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="yayinevi" placeholder="Yayın Evi">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="basimyili" placeholder="Basım Yılı">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="salonno" placeholder="Salon No">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="rafno" placeholder="Raf No">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="dolapno" placeholder="Dolap No">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="demirbasno" placeholder="Demirbaş No">
                        </div></br></br></br>
                        <label for="field-1" class="col-sm-3 control-label"></label>

                        <div class="col-sm-4">
                            <select id="kategori" class="form-control">
                                <?php
                                $qq = "SELECT * FROM `kategori`";
                                $sth = $dbh->prepare($qq);
                                $sth->execute();
                                while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option>".$row['kategori_isim']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <a href="javascript: kitapekle();" class="btn btn-primary">
                            Kitap Ekle
                        </a>
                    </div>
                </form>
            </div>
            <div>
                <!-- Footer -->
                <footer class="main" style="position:absolute; bottom:5px; ">
                    &copy; 2018 <strong>Kütüphane</strong> Erkan TEMEL tarafından yapılmıştır.
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal 6 (Responsive Modal)-->
    <div class="modal fade" id="modal-6">
        <div class="modal-dialog">
            <div class="modal-content" style=" width: 500px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal Content is Responsive</h4>
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select List</label>
                                <div class="col-sm-8">
                                    <select id="arac" class="form-control">
                                        <option>Telefon</option>
                                        <option>Eposta</option>
                                    </select>
                                </div>
                            </div></br></br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date Picker</label>
                                <div class="col-sm-8">
                                    <input type="text" id="deger" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id ="telpost" type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/ekle.js"></script>
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