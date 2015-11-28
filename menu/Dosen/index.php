<?php  
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>E-EXAM</title>

    <style type="text/css" class="init">

    body { font-size: 140%; }
    div.DTTT { margin-bottom: 0.5em; float: right; }
    div.dataTables_wrapper { clear: both; }

    </style>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Form Validation CSS -->
    <link rel="stylesheet" href="../dist/css/formValidation.css"/>

    <!-- Bootstrap Basic CSS -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css"/>

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/dataTables.tableTools.css" rel="stylesheet">

    <!-- Chosen CSS -->
    <link href="../../assets/chosen/chosen.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bower_components/jquery/jdate/css/jquery.timepicker.css" rel="stylesheet" type="text/css">
    <link href="../bower_components/jquery/jdate/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
    <link href="../bower_components/jquery/jdate/css/pikaday.css" rel="stylesheet" type="text/css">
    <link href="../bower_components/jquery/jdate/css/jquery.ptTimeSelect.css" rel="stylesheet" type="text/css">

    <!-- JQUERY JS -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <script src="../bower_components/jquery/jdate/jquery.timepicker.js"></script>
    <script src="../bower_components/jquery/jdate/bootstrap-datepicker.js"></script>
    <script src="../bower_components/jquery/jdate/pikaday.js"></script>
    <script src="../bower_components/jquery/jdate/jquery.ptTimeSelect.js"></script>
    <script src="../bower_components/jquery/jdate/moment.min.js"></script>
    <script src="../bower_components/jquery/jdate/datepair.js"></script>
    <script src="../bower_components/jquery/jdate/jquery.datepair.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Form Validation JS -->
    <script type="text/javascript" src="../dist/js/formValidation.js"></script>

    <!-- BootStrap JS -->
    <script type="text/javascript" src="../dist/js/framework/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../dist/js/dataTables.tableTools.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Chosen JS -->
    <script src="../../assets/chosen/chosen.jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img class="img-responsive" src="../../assets/img/LOGO-UNTAR.png" alt="UNTAR LOGO"></a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Welcome, <?php echo $_SESSION['username'] ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?p=user_profiles"><i class="fa fa-user fa-fw"></i> Detail User</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=index.php"><i class="fa fa-home fa-fw"></i> Menu Awal</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Input Soal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li>
                                 <a href="index.php?p=input_soal_uts">Input Soal UTS <span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="index.php?p=input_soal_uas">Input Soal UAS <span class="fa arrow"></span></a>
                            </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Lihat Soal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li>
                                 <a href="#">Lihat Soal UTS <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="index.php?p=lihat_soal&s=UTS&t=A">Type Soal A</a>
                                        </li>
                                        <li>
                                            <a href="index.php?p=lihat_soal&s=UTS&t=B">Type Soal B</a>
                                        </li>
                                    </ul>
                            </li>
                            <li>
                                <a href="#">Lihat Soal UAS <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="index.php?p=lihat_soal&s=UAS&t=A">Type Soal A</a>
                                        </li>
                                        <li>
                                            <a href="index.php?p=lihat_soal&s=UAS&t=B">Type Soal B</a>
                                        </li>
                                    </ul>
                            </li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.php?p=input_ujian"><i class="fa fa-calendar fa-fw"></i> Buat Ujian</a>
                        </li>
                        <li>
                            <a href="index.php?p=lihat_jadwal"><i class="fa fa-flag fa-fw"></i> Lihat Jadwal Ujian</a>
                        </li>
                        <li>
                            <a href="index.php?p=lihat_nilai"><i class="fa fa-flag fa-fw"></i> Lihat Nilai</a>
                        </li>
                        <li>
                            <a href="index.php?p=mahasiswa"><i class="fa fa-group fa-fw"></i> Lihat Mahasiswa</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        
        <?php
        $cek = $dbcon->query("SELECT * FROM login_dosen WHERE id = '".$_SESSION['username']."' AND firsttime = 'YES'");
        $cek1 = mysqli_num_rows($cek);
        if($_SESSION['notif']!='')
        {
            echo "<div class='alert alert-info'><center>".$_SESSION['notif']."</center></div>";
            $_SESSION['notif'] = '';
        }
        else
        {
            $_SESSION['notif'] = '';
        }
        $pages_dir = 'Pages';
        if(!empty($_GET['p'])){
            $pages = scandir($pages_dir, 0);
            unset($pages[0], $pages[1]);
            if($cek1>0)
            {
                include($pages_dir.'/user_edit.php');
                $_SESSION['notif'] = 'Silakan Ganti Password Anda!!';
            }
            else
            {
            $p = $_GET['p'];
            if(in_array($p.'.php', $pages)){
                include($pages_dir.'/'.$p.'.php');
            } else {
                echo 'Halaman tidak ditemukan! :(';
            }  
            }
        }
        else if($cek1>0)
        {
            include($pages_dir.'/user_edit.php');
            $_SESSION['notif'] = 'Silakan Ganti Password Anda!!';
        }
        else {
            include($pages_dir.'/index.php');
        }
        ?>

        
        <!-- /#page-wrapper -->

    </div>
<script>
    $(".alert").addClass("in").fadeOut(3500);
</script>
</body>

</html>
