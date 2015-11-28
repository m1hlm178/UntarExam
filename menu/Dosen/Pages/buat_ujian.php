<?php
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
if(isset($_POST['Save-Ujian'])){
$_SESSION['matkul']=$_POST['matkul'];
$_SESSION['edisi']=$_POST['edisi'];
$_SESSION['kelas']=$_POST['kelas'];
$_SESSION['type']=$_POST['selecttype'];
$_SESSION['mulai']=$_POST['tanggalmulai'];
$_SESSION['wktmulai']=$_POST['waktustart'];
$_SESSION['selesai']=$_POST['tanggalselesai'];
$_SESSION['wktselesai']=$_POST['waktuend'];
$_SESSION['jml']=$_POST['jmlsoal'];
$jmlh=$_POST['jmlsoal'];
}
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Liat Soal <?php echo $_SESSION['edisi'];?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat Soal Baru
                        </div>
                            <div class="panel-body">
                            <div class="row">
                                <form action="./ext/save_ujian.php" name="" role="form" method="post">
                            <div class="form-group">
                                <?php
                                //Data mentah yang ditampilkan ke tabel 
                                $getdata = "select * from bank_soal where edisi = '".$_SESSION['edisi']."' and type_soal = '".$_SESSION['type']."' and matkul_idmatkul = '".$_SESSION['matkul']."' and detail_dosen_nik = '".$_SESSION['username']."' and used='NO' limit $jmlh";
                                $cek = $dbcon->query($getdata);
                                $cek1 = mysqli_num_rows($cek);
                                if($cek1<$jmlh)
                                {
                                        $_SESSION['notif'] = "Soal Tidak Mencukupi Mohon Diulang!!";		//Pesan jika proses tambah sukses
                                        echo "<script> location.replace('./index.php?p=input_ujian'); </script>";
                                }
                                else
                                {
                                $sql=mysqli_query($dbcon,$getdata);
                                $i = 1;
                                while ($r = mysqli_fetch_array($sql)) {
//                                echo $jml;
//                                for($i=0;$i<5;$i++)
//                                {
                                ?>
                                <input type="hidden" name="id[]" value=<?php echo $r['nosoal'];?>>
                                        <div class="col-md-9 form-group">
                                            <label><?php echo $i.". ".$r['soal'];?></label>
                                            <p class="form-control-static">A.<?php echo $r['q1'];?></p>
                                            <p class="form-control-static">B.<?php echo $r['q2'];?></p>
                                            <p class="form-control-static">C.<?php echo $r['q3'];?></p>
                                            <p class="form-control-static">D.<?php echo $r['q4'];?></p>
                                            <p class="form-control-static">E.<?php echo $r['q5'];?></p>
                                            <p class="form-control-static">Jawaban : <?php echo $r['ans'];?></p>
                                        </div>
                                <?php
                                $i++;
                                }
                                }
                                ?>
                                <div class="form-group">
                                  <label class="col-xs-6 col-sm-4 form-group"></label>
                                  <div class="col-xs-6 col-sm-4">
                                    <button class="btn btn-primary" type="submit" name="Finish-Ujian" class="btn btn-primary btn-block">Simpan</button>
                                  </div>
                                </div>
                                </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
                </div>
            </div>
