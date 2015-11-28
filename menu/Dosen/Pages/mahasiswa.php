        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List Mahasiswa</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Data List Mahasiswa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tabel-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="5%">NIM</th>
                                            <th width="5%">Nama</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="10%">Mata Kuliah</th>
                                            <th width="5%">Kelas</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "select a.detail_mhs_nim,b.nama,c.nama_fal,d.nama_jur,e.nama_matkul,f.kelas from isi_kelas a,detail_mhs b,falkutas c, jurusan d, matkul e,kelas f where a.detail_mhs_nim = b.nim and a.detail_mhs_idfalkutas = c.idfalkutas and a.detail_mhs_idjurusan = d.idjurusan and a.kelas_matkul_idmatkul = e.idmatkul and a.kelas_idkelas = f.idkelas and a.kelas_detail_dosen_nik = '".$_SESSION['username']."'";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1;
                                            while ($r = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r[0]; ?></td>
                                                    <td><?php echo  $r[1]; ?></td>
                                                    <td><?php echo  $r[2]; ?></td>
                                                    <td><?php echo  $r[3]; ?></td>
                                                    <td><?php echo  $r[4]; ?></td>
                                                    <td><?php echo  $r[5]; ?></td>
                                                    
                                                </tr>
                                             <?php
                                            $no++;
                                            }
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
    $("#NIM").chosen();
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