        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Dan List Falkutas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat Falkutas Baru
                        </div>
                             <div class="panel-body">
                                <div class="row">
                              <form action="./ext/input.php" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Nama Falkutas:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="falkutas" name="falkutas" type="text" placeholder="" class="input-xlarge" required>
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="Input-Falkutas" class="btn btn-primary btn-block">Simpan Mata Kuliah</button>
                                  </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Data List Falkutas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tabel-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="5%">ID Falkutas</th>
                                            <th width="5%">Nama Falkutas</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "SELECT idfalkutas,nama_fal from falkutas";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1;
                                            while ($r = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r[0]; ?></td>
                                                    <td><?php echo  $r[1]; ?></td>
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
                                                    <label for="nm">Nama Falkutas</label>
                                                    <input type="text" class="form-control input-xlarge" id="nm<?php echo $r[0]; ?>" value="<?php echo $r[1]; ?>">
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
	   url: "ext/update_data.php?update_falkutas="+id,
	   data: datas
	}).done(function( data ) {
          location.reload();
	});
    }
    function deletedata(str){
	
	var id = str;
      
	$.ajax({
	   type: "GET",
	   url: "ext/update_data.php?delete_falkutas="+id
	}).done(function( data ) {
          location.reload();
	});
    }
  
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
            falkutas: {
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