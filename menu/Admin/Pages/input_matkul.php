        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Dan List Mata Kuliah</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat Mata Kuliah Baru
                        </div>
                             <div class="panel-body">
                                <div class="row">
                              <form action="./ext/input.php" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <!-- Select Basic -->
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

                                <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Jurusan:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectjur" name="selectjur" style="width:300px">
                                    </select>
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Mata Kuliah:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="matkul" name="matkul" type="text" placeholder="" class="input-xlarge" required>
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="Input-Matkul" class="btn btn-primary btn-block">Simpan Mata Kuliah</button>
                                  </div>
                                </div>
                    </div>
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
                                            <th width="5%">Kode MatKul</th>
                                            <th width="5%">Mata Kuliah</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "SELECT a.idmatkul,a.nama_matkul,b.nama_fal,c.nama_jur FROM matkul a, falkutas b, jurusan c where a.idjurusan = c.idjurusan AND a.idfalkutas = b.idfalkutas";
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
                                                    <td>
                                                        <a class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $r[0]; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
    function deletedata(str){
	
	var id = str;
      
	$.ajax({
	   type: "GET",
	   url: "ext/update_data.php?delete_matkul="+id
	}).done(function( data ) {
          location.reload();
	});
    }

    /*** script untuk mencari kota/kabupaten berdasarkan propinsi */

    $("#selectfal").chosen({no_results_text: "Tidak ditemukan....!"});
    $("#selectjur").chosen();
    $(function(){
     $("#selectfal").chosen().change(function(){
    var idfal = $("#selectfal").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/cari_jurusan.php',
            data: 'fal=' + idfal,
            success: function(dt) {
            $('#selectjur').html(dt).trigger("chosen:updated");
            },  
       error: function(e){  
            alert('Error: ' + e);  
            }  
     });
    });
    });
  
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
            // selectmatakul: {
            //         validators: {
            //             notEmpty: {
            //                 message: 'Please select your native language.'
            //             }
            //         }
            //     },
            // selectkelas: {
            //         validators: {
            //             notEmpty: {
            //                 message: 'Please select your native language.'
            //             }
            //         }
            //     },
            selectfal: {
                validators: {
                    notEmpty: {
                        message: 'Falkutas harus di isi'
                    }
                }
            },
            selectjur: {
                validators: {
                    notEmpty: {
                        message: 'Jurusan harus di isi'
                    }
                }
            },
            matkul: {
                validators: {
                    notEmpty: {
                        message: 'Mata Kuliah harus di isi'
                    }
                }
            }
        }
    });
});
</script>