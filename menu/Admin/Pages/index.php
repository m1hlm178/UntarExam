<?php
//mulai proses tambah data
session_start();
//include "../ext/func.php";
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}


?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <CENTER>Selamat Datang,
                                <p><?php echo $_SESSION['username'];?></p></center>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> Jumlah Soal
                                    <span class="pull-right text-muted small"><em><?php echo mysqli_num_rows($dbcon->query("SELECT * FROM bank_soal"));?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-list fa-fw"></i> Jumlah Dosen
                                    <span class="pull-right text-muted small"><em><?php echo mysqli_num_rows($dbcon->query("SELECT * FROM login_dosen"));?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-list fa-fw"></i> Jumlah Mahasiswa
                                    <span class="pull-right text-muted small"><em><?php echo mysqli_num_rows($dbcon->query("SELECT * FROM detail_mhs"));?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-list fa-fw"></i> Jumlah Falkutas
                                    <span class="pull-right text-muted small"><em><?php echo mysqli_num_rows($dbcon->query("SELECT * FROM falkutas"));?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-list fa-fw"></i> Jumlah Jurusan
                                    <span class="pull-right text-muted small"><em><?php echo mysqli_num_rows($dbcon->query("SELECT * FROM jurusan"));$dbcon->close();?></em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>