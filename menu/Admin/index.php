<?php  
session_start();
include "../../database/db_conection.php"; 
echo $_SESSION['notiflogin'];
//echo $_SESSION['notif'];
//echo $_SESSION['notif'] = '';
if(!$_SESSION['username'] || is_numeric($_SESSION['username']))  
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
    <!-- <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css"/> -->

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

    <!-- JQUERY JS -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/jquery/dist/jquery.js"></script>

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
                <a class="navbar-brand" href="index.php"><img class="img-responsive" src="../../assets/img/logo.png" alt="UNTAR LOGO"></a>
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
            <!-- /.navba- SideMenu Samping -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-home fa-fw"></i> Menu Awal</a>
                        </li>
                        <li>
                            <a href="index.php?p=input_falkutas"><i class="fa fa-home fa-fw"></i> Input Falkutas</a>
                        </li>
                        <li>
                            <a href="index.php?p=input_jurusan"><i class="fa fa-home fa-fw"></i> Input Jurusan</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i> Pengaturan Akun<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?p=user_dosen"><i class="fa fa-cog fa-fw"></i> Pengaturan Akun Dosen</a>
                                </li>
                                <li>
                                    <a href="index.php?p=user_mahasiswa"><i class="fa fa-cog fa-fw"></i> Pengaturan Akun Mahasiswa</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i> Pengaturan Mata Kuliah<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?p=input_matkul"><i class="fa fa-pencil fa-fw"></i> Input Mata Kuliah</a>
                                </li>
                                <li>
                                    <a href="index.php?p=input_dosen_matkul"><i class="fa fa-pencil fa-fw"></i> Input Kelas Mata Kuliah</a>
                                </li>
                                </li>
                                <li>
                                    <a href="index.php?p=input_mahasiswa_matkul"><i class="fa fa-pencil fa-fw"></i> Input Kelas Mahasiswa</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Data Page Tengah -->
        
        <?php
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
 
            $p = $_GET['p'];
            if(in_array($p.'.php', $pages)){
                include($pages_dir.'/'.$p.'.php');
            } else {
                echo 'Halaman tidak ditemukan! :(';
            }
        } else {
            include($pages_dir.'/index.php');
        }
        ?>
        <!-- /#page-wrapper -->

    </div>

</body>
<script>
    $(".alert").addClass("in").fadeOut(3500);
</script>

</html>
