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
                    <h1 class="page-header">Lihat Nilai</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Nilai
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tabel-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="5%">Mata Kuliah</th>
                                            <th width="5%">Kelas</th>
                                            <th width="5%">Edisi</th>
                                            <th width="5%">Nilai</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "select d.nama_matkul,c.kelas,a.edisi,a.nilai from nilai a, isi_kelas b, kelas c, matkul d where a.isi_kelas_no = b.no and b.kelas_idkelas = c.idkelas and b.kelas_matkul_idmatkul = d.idmatkul and a.isi_kelas_detail_mhs_nim = '".$_SESSION['username']."'";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1; 
                                            while ($r=mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r[0]; ?></td>
                                                    <td><?php echo  $r[1]; ?></td>
                                                    <td><?php echo  $r[2]; ?></td>
                                                    <td><?php echo  $r[3]; ?></td>
                                                </tr>
                                             <?php
                                            $no++;
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