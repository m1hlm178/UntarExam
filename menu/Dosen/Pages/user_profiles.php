    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detail User</h1>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8">
                                        <h4>Selamat Datang : <?php echo $_SESSION['username'];?></h4>
                                        <p>
                                        <?php
                                        $r = mysqli_fetch_array(mysqli_query($dbcon,"SELECT * FROM detail_dosen WHERE nik = '".$_SESSION['username']."'"));
                                        ?>
                                            <i class="glyphicon glyphicon-envelope"></i> 
                                            Nama : <?php echo $r['nama'];?>
                                            <br />
                                            <i class="glyphicon glyphicon-home"></i> 
                                            Alamat : <?php echo $r['alamat'];?>
                                            <br />
                                            <i class="glyphicon glyphicon-phone"></i> 
                                            Telephone : <?php echo $r['telephone'];?>
                                            <br />
                                            <i class="glyphicon glyphicon-send"></i> 
                                            Email : <?php echo $r['email'];?>
                                            <br />
                                        </p>
                                        <!-- Split button -->
                                        <a href="index.php?p=user_edit"><button type="button" class="btn btn-success">Ganti Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>