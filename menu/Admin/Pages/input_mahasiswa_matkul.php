        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input dan List Kelas Mahasiswa</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Menginput Kelas Mahasiswa
                        </div>
                             <div class="panel-body">
                                <div class="row">
                              <form action="./ext/input.php" id="registrationForm" class="form-horizontal" role="form" method="post">
                              <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">NIM/Nama:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectnim" name="selectnim" style="width:300px">
                                    <option value=""></option>
                                    <?php
                                    $getdata = "SELECT * FROM detail_mhs";
                                    $sql=mysqli_query($dbcon,$getdata);
                                    // echo "<option value='kosong' selected>- Pilih Falkutas -</option>";
                                    while($get=mysqli_fetch_array($sql))
                                    {
                                        // echo "<option value='$get[idfalkutas]' selected> $get[nama]</option>";
                                        echo "<option value='".$get['nim']."'>".$get['nim']." / ".$get['nama']."</option>";    
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

                                <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Mata Kuliah:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectmatkul" name="selectmatkul" style="width:300px">
                                    </select>
                                  </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Kelas:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selectkls" name="selectkls" style="width:300px">
                                    </select>
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <input class="btn btn-primary" value="Simpan" name="Input-Matkul-Mhs" type="submit">
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
                                            <th width="5%">NIM</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="10%">Mata Kuliah</th>
                                            <th width="5%">Kelas</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "select a.detail_mhs_nim,e.nama_fal,d.nama_jur,c.nama_matkul,b.kelas from isi_kelas a, kelas b,matkul c, jurusan d, falkutas e where a.kelas_idkelas = b.idkelas and b.matkul_idmatkul = c.idmatkul and c.idjurusan = d.idjurusan and c.idfalkutas = e.idfalkutas";
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
                                                    <td>
                                                        <a class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $r[0]; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                                    </td>
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
    
    function deletedata(str){

    var id = str;

    $.ajax({
       type: "GET",
       url: "ext/update_data.php?delete_mhs_matkul="+id
    }).done(function( data ) {
      location.reload();
    });
    }
        
    $("#selectnim").chosen({no_results_text: "Tidak ditemukan....!"});
    $("#selectfal").chosen({no_results_text: "Tidak ditemukan....!"});
    $("#selectjur").chosen({no_results_text: "Tidak ditemukan....!"});
    $("#selectmatkul").chosen({no_results_text: "Tidak ditemukan....!"});
    $("#selectkls").chosen({no_results_text: "Tidak ditemukan....!"});
    $(function(){
    $("#selectnim").chosen().change(function(){
    var idfal = $("#selectnim").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/input_fal.php',
            data: 'fal=' + idfal,
            success: function(dt) {
            $('#selectfal').html(dt).trigger("chosen:updated");
            },  
       error: function(e){  
            alert('Error: ' + e);  
            }  
     });
    });
    $("#selectnim").chosen().change(function(){
    var idjur = $("#selectnim").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/input_jur.php',
            data: 'jur=' + idjur,
            success: function(dt) {
            $('#selectjur').html(dt).trigger("chosen:updated");
            },  
       error: function(e){  
            alert('Error: ' + e);  
            }  
     });
    });
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
    $("#selectmatkul").chosen().change(function(){
    var idjur = $("#selectmatkul").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/cari_kelas.php',
            data: 'jur=' + idjur,
            success: function(dt) {
            $('#selectkls').html(dt).trigger("chosen:updated");
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
            selectnim: {
                validators: {
                    notEmpty: {
                        message: 'NIM harus di isi'
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
            selectfal: {
                validators: {
                    notEmpty: {
                        message: 'Falkutas harus di isi'
                    }
                }
            },
            selectmatkul: {
                validators: {
                    notEmpty: {
                        message: 'Mata Kuliah harus di isi'
                    }
                }
            },
            selectkls: {
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