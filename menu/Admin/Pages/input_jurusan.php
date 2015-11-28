        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Dan List Jurusan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat Jurusan Baru
                        </div>
                             <div class="panel-body">
                                <div class="row">
                              <form action="./ext/input.php" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Falkutas:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectfal" name="selectfal"  style="width:300px">
                                    <option value=""></option>
                                    <?php
                                    $getdata = "SELECT * FROM falkutas";
                                    $sql=mysqli_query($dbcon,$getdata);
                                     echo "<option value='kosong' selected>- Pilih Falkutas -</option>";
                                    while($get=mysqli_fetch_array($sql))
                                    {
                                        // echo "<option value='$get[idfalkutas]' selected> $get[nama]</option>";
                                        echo "<option value='".$get['idfalkutas']."'>".$get['nama_fal']."</option>";    
                                    }
                                    ?>
                                    </select>
                                  </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Nama Jurusan:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="Jurusan" name="Jurusan" type="text" placeholder="" class="input-xlarge" required>
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="Input-Jurusan" class="btn btn-primary btn-block">Simpan Mata Kuliah</button>
                                  </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Data List Jurusan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tabel-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="5%">ID Jurusan</th>
                                            <th width="5%">Nama Falkutas</th>
                                            <th width="5%">Nama Jurusan</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "SELECT a.idjurusan,b.nama_fal,a.nama_jur from jurusan a, falkutas b where a.falkutas_idfalkutas = b.idfalkutas";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1;
                                            while ($r = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r[0]; ?></td>
                                                    <td><?php echo  $r[1]; ?></td>
                                                    <td><?php echo  $r[2]; ?></td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $r[0]; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                        <a class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $r[0]; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal<?php echo $r[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $r[0]; ?>" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel<?php echo $r[0]; ?>">Edit Data</h4>
                                                          </div>
                                                          <div class="modal-body">

                                                    <form>
                                                      <div class="form-group">
                                                        <label for="nm">Nama Jurusan</label>
                                                        <input type="text" class="form-control input-xlarge" id="nm<?php echo $r[0]; ?>" value="<?php echo $r[2]; ?>">
                                                      </div>
                                                    </form>

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
	var nm = $('#nm'+str).val();
	
	var datas="nm="+nm;
      
	$.ajax({
	   type: "POST",
	   url: "ext/update_data.php?update_jurusan="+id,
	   data: datas
	}).done(function( data ) {
          location.reload();
	});
    }
    function deletedata(str){
	
	var id = str;
      
	$.ajax({
	   type: "GET",
	   url: "ext/update_data.php?delete_jurusan="+id
	}).done(function( data ) {
          location.reload();
	});
    }

    /*** script untuk mencari kota/kabupaten berdasarkan propinsi */

    $("#selectfal").chosen({no_results_text: "Tidak ditemukan....!"});
  
    /****************************************************************/

    $(document).ready(function() {
        $('#tabel-list').DataTable( {
                "sPaginationType": "full_numbers",
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf"
            }
        } );
    } );
    $(document).ready(function() {
    $('#registrationForm')
        // .find('[name="selectmatakul"]')
        //     .selectpicker()
        //     .change(function(e) {
        //         // revalidate the color when it is changed
        //         $('#registrationForm').formValidation('revalidateField', 'selectmatakul');
        //     })
        //     .end()
        // .find('[name="selectkelas"]')
        //     .selectpicker()
        //     .change(function(e) {
        //         // revalidate the language when it is changed
        //         $('#registrationForm').formValidation('revalidateField', 'selectkelas');
        //     })
            // .end()
    .formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Jurusan: {
                validators: {
                    notEmpty: {
                        message: 'Falkutas harus di isi'
                    }
                }
            }
        }
    });
});
</script>