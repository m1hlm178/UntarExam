<?php
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Download</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Download File Excel
                        </div>
                            <div class="panel-body">
                            <div class="row">
                              <form action="./index.php?p=buat_ujian" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Download Contoh Excel:</label>
                                    <div class="col-lg-8">
                                      <a href="./ext/Excel/Sample/Contoh.xlsx" class="btn btn-info" role="button">Download</a>
                                      </select>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

