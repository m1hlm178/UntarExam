<?php
session_start();
//include "../ext/func.php";
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
$id=htmlspecialchars($_GET['id']); 
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
                                <form action="./ext/save_jawaban.php" name="" role="form" method="post">
                            <div class="form-group">
                                <?php
                                //Data mentah yang ditampilkan ke tabel 
                    
                                $getdata = "select a.nilai from nilai a, isi_kelas b, kelas c, jadwal_ujian d where a.isi_kelas_no = b.no and b.kelas_idkelas = c.idkelas and c.idkelas = d.kelas_idkelas and d.idjadwal = '$id' and a.isi_kelas_detail_mhs_nim = '".$_SESSION['username']."'";
                                $cek = $dbcon->query($getdata);
                                $cek1 = mysqli_num_rows($cek);
                                if($cek1>0)
                                {
                                        $_SESSION['notif'] = "Anda Sudah Mengikuti Ujian!!";	//Pesan jika proses tambah sukses
                                        echo "<script> location.replace('./index.php?p=lihat_ujian'); </script>";
                                } else
                                {
                                $soal = "select a.nosoal,a.soal,a.q1,a.q2,a.q3,a.q4,a.q5 from bank_soal a, soal_ujian b where b.bank_soal_nosoal = a.nosoal and b.jadwal_ujian_idjadwal = '".$id."' order by rand()";
                                $sql=mysqli_query($dbcon,$soal);
                                $jumlah=mysqli_num_rows($sql);
                                $i = 1;
                                while ($r = mysqli_fetch_array($sql)) {
                                ?>
                                <input type="hidden" name="id[]" value=<?php echo $r[0];?>>
                                <input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
                                <div class="form-group">
                                    <label><?php echo $i.'.'.$r[1];?></label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="pg[<?php echo $r[0];?>]"  value="A"><?php echo $r['2'];?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="pg[<?php echo $r[0];?>]"  value="B"><?php echo $r['3'];?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="pg[<?php echo $r[0];?>]"  value="C"><?php echo $r['4'];?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="pg[<?php echo $r[0];?>]"  value="D"><?php echo $r['5'];?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="pg[<?php echo $r[0];?>]"  value="E"><?php echo $r['6'];?>
                                        </label>
                                    </div>
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