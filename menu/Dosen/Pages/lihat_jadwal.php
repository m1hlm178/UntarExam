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
                                            $getdata = "select a.idjadwal,e.nama_fal,d.nama_jur,c.nama_matkul,b.kelas,a.edisi,a.mulai,a.berakhir from jadwal_ujian a,kelas b, matkul c, jurusan d, falkutas e where a.kelas_idkelas = b.idkelas and a.kelas_matkul_idmatkul = c.idmatkul and c.idfalkutas = e.idfalkutas and c.idjurusan = d.idjurusan and a.kelas_detail_dosen_nik = '".$_SESSION['username']."'";
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
                                                    <td><?php echo  $r[6]; ?></td>
                                                    <td><?php echo  $r[7]; ?></td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $r[0]; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                        
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal<?php echo $r[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $r[0]; ?>" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel<?php echo $r[0]; ?>">Edit Data</h4>
                                                          </div>
                                                          <div class="modal-body">

                                                        <div class="form-group">
                                                        <label class="col-lg-3 control-label" for="tgldanwaktu">Tanggal dan Waktu Ujian:</label>
                                                        <div class="col-lg-8">
                                                          <p id="TglUjian">
                                                              <input type="text" name="tanggalmulai" id="d1<?php echo $r[0]; ?>" class="date start" />
                                                              <input type="text" name="waktustart" id="t1<?php echo $r[0]; ?>" class="time start" />
                                                          </p>
                                                          <p id="TglUjian">
                                                              <input type="text" name="tanggalselesai" id=d2<?php echo $r[0]; ?>" class="date end" />
                                                              <input type="text" name="waktuend" id="t2<?php echo $r[0]; ?>" class="time end" /> 
                                                          </p>
                                                        </div>
                                                        </div>

                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" onclick="updatedata('<?php echo $r[0]; ?>')" class="btn btn-primary">Save changes</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    </td>
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
    function updatedata(str){
	
	var id = str;
        var d1 = $('#d1'+str).val();
	var t1 = $('#t1'+str).val();
	var d2 = $('#d2'+str).val();
	var t2 = $('#t2'+str).val();
	
	var datas="d1="+d1+"&t1="+t1+"&d2="+d2+"&t2="+t2;
      
	$.ajax({
	   type: "POST",
	   url: "ext/update_data.php?update_jadwal="+id,
	   data: datas
	}).done(function( data ) {
          location.reload();
	});
    }
    
    $('#TglUjian .time').timepicker({
        'minTime': '08:30:00am',
        'maxTime': '15:00:00pm',
        'showDuration': true,
        'timeFormat': 'H:i:s'
    });

    $('#TglUjian .date').datepicker({
        'format': 'yyyy-mm-d',
        
        'autoclose': true
    });
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