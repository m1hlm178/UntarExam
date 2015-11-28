<?php
session_start();
//include "../ext/func.php";
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
$now = new DateTime();
$sekarang = $now->format('Y-m-d H:i:s');
//$r1 = mysqli_fetch_array(mysqli_query($dbcon,"SELECT * FROM isi_kelas WHERE detail_mhs_nim = '".$_SESSION['username']."'"));
//$idkelas = $r['kelas_idkelas'];
//echo '<script> alert("'.$idkelas.'");</script>';
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Jadwal Ujian</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Data List Ujian
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tabel-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="5%">ID</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="5%">Mata Kuliah</th>
                                            <th width="5%">Kelas</th>
                                            <th width="5%">Edisi</th>
                                            <th width="5%">Mulai</th>
                                            <th width="5%">Selesai</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "SELECT * FROM isi_kelas WHERE detail_mhs_nim = '".$_SESSION['username']."'";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1; 
                                            while ($r1 = mysqli_fetch_array($sql)) {
                                            $r = mysqli_fetch_array(mysqli_query($dbcon,"select a.idjadwal,e.nama_fal,d.nama_jur,c.nama_matkul,b.kelas,a.edisi,a.mulai,a.berakhir from jadwal_ujian a,kelas b, matkul c, jurusan d, falkutas e where a.kelas_idkelas = b.idkelas and a.kelas_matkul_idmatkul = c.idmatkul and c.idfalkutas = e.idfalkutas and '$sekarang' >= a.mulai and '$sekarang' <= a.berakhir  and c.idjurusan = d.idjurusan and a.kelas_idkelas = '".$r1['kelas_idkelas']."'"));
                                            if($r[0]=='')
                                            {   } else {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r[0]; ?></td>
                                                    <td><?php echo  $r[1]; ?></td>
                                                    <td><?php echo  $r[2]; ?></td>
                                                    <td><?php echo  $r[3]; ?></td>
                                                    <td><?php echo  $r[4]; ?></td>
                                                    <td><?php echo  $r[5]; ?></td>
                                                    <td><?php echo  $r[6]; ?></td>
                                                    <td><?php echo  $r[7]; ?></td>
                                                    <td>
                                                        <a href="./Pages/soal_ujian.php?id=<?php echo  $r[0]; ?>">Ikut Ujian</a> | 
                                                    </td>
                                                </tr>
                                             <?php
                                            $no++;
                                            }
                                            }
                                            $dbcon->close();
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#tabel-list').DataTable( {
                "sPaginationType": "full_numbers",
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf"
            }
        } );
    } );
</script>