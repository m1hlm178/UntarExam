        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input dan List Dosen Mata Kuliah</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat Kelas Kuliah Baru
                        </div>
                             <div class="panel-body">
                                <div class="row">
                                    <form action="./ext/input.php" id="registrationForm" class="form-horizontal" role="form" method="post">
                              <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Dosen:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectdo" name="selectdo" style="width:300px">
                                    <option value=""></option>
                                    <?php
                                    $getdata = "SELECT * FROM detail_dosen";
                                    $sql=mysqli_query($dbcon,$getdata);
                                    // echo "<option value='kosong' selected>- Pilih Falkutas -</option>";
                                    while($get=mysqli_fetch_array($sql))
                                    {
                                        // echo "<option value='$get[idfalkutas]' selected> $get[nama]</option>";
                                        echo "<option value='".$get['nik']."'>".$get['nik']." / ".$get['nama']."</option>";    
                                    }
                                    ?>
                                    </select>
                                  </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Falkutas:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectfal" name="selectfal" style="width:300px">
                                    <option value=""></option>
                                    <?php
                                    $getdata = "SELECT * FROM falkutas";
                                    $sql=mysqli_query($dbcon,$getdata);
                                    // echo "<option value='kosong' selected>- Pilih Falkutas -</option>";
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
                                    <option value=""></option>
                                    </select>
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Mata Kuliah:</label>
                                  <div class="col-lg-8">
                                   <select class="form-control" id="selectmatkul" name="selectmatkul" style="width:300px">
                                    <option value=""></option>   
                                   </select>
                                  </div>
                                </div>

                                 <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Kelas:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="kelas" name="kelas" type="text" placeholder="" class="input-xlarge" required>
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="Dosen-Matkul" class="btn btn-primary btn-block">Simpan</button>
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
                                            <th width="5%">Kode Kelas</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="5%">Mata Kuliah</th>
                                            <th width="5%">Dosen</th>
                                            <th width="5%">Kelas</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "SELECT kelas.idkelas, falkutas.nama_fal, jurusan.nama_jur, matkul.nama_matkul, detail_dosen.nama, kelas.kelas FROM kelas JOIN detail_dosen ON kelas.detail_dosen_nik = detail_dosen.nik JOIN matkul ON kelas.matkul_idmatkul = matkul.idmatkul JOIN jurusan ON matkul.idjurusan = jurusan.idjurusan JOIN falkutas ON matkul.idfalkutas = falkutas.idfalkutas";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1;
                                            while ($r = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r['0']; ?></td>
                                                    <td><?php echo  $r['1']; ?></td>
                                                    <td><?php echo  $r['2']; ?></td>
                                                    <td><?php echo  $r['3']; ?></td>
                                                    <td><?php echo  $r['4']; ?></td>
                                                    <td><?php echo  $r['5']; ?></td>
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
	   url: "ext/update_data.php?delete_dosen_matkul="+id
	}).done(function( data ) {
          location.reload();
	});
    }
    
    $("#selectdo").chosen({no_results_text: "Tidak ditemukan....!"});
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
    $("#selectmatkul").chosen();
    $(function(){
     $("#selectjur").chosen().change(function(){
    var idjur = $("#selectjur").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/cari_matkul.php',
            data: 'jur=' + idjur,
            success: function(dt) {
            $('#selectmatkul').html(dt).trigger("chosen:updated");
            },  
       error: function(e){  
            alert('Error: ' + e);  
            }  
     });
    });
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
            selectdo: {
                validators: {
                    notEmpty: {
                        message: 'Dosen harus di isi'
                    }
                }
            },
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
            },
            kelas: {
                validators: {
                    notEmpty: {
                        message: 'Kelas harus di isi'
                    }
                }
            }
        }
    });
});
</script>