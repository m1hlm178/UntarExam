<?php
session_start();
$_SESSION['soal']='UAS';
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Soal UAS</h1>
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
                              <form action="./index.php?p=input_soal" id="registrationForm" class="form-horizontal" role="form" method="post">
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
                                    </select>
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Mata Kuliah:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="matkul" name="matkul" style="width:300px"></select>
                                  </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">TypeSoal:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="selecttype" name="selecttype" style="width:300px">
                                    <option value=""></option>
                                    <option value="A">Type A</option>
                                    <option value="B">Type B</option>
                                    </select>
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Jumlah Soal:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="jmlsoal" name="jmlsoal" type="text" placeholder="" class="input-xlarge" required>
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="Input-Soal" class="btn btn-primary btn-block">Simpan</button>
                                  </div>
                                </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    /*** script untuk mencari kota/kabupaten berdasarkan propinsi */
    $("#matkul").chosen();
    $("#selecttype").chosen();
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
    $("#selectjur").chosen().change(function(){
    var idjur = $("#selectjur").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/cari_matkul.php',
            data: 'jur=' + idjur,
            success: function(dt) {
            $('#matkul').html(dt).trigger("chosen:updated");
            },  
       error: function(e){  
            alert('Error: ' + e);  
            }  
     });
    });
    });
    /****************************************************************/
    $(document).ready(function() {
    $('#registrationForm')
    .formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            selectfal: {
                    validators: {
                        notEmpty: {
                            message: 'Pilih Falkutas Anda.'
                        }
                    }
                },
            selectjur: {
                validators: {
                    notEmpty: {
                        message: 'Please select your native language.'
                    }
                }
            },
            matkul: {
                validators: {
                    notEmpty: {
                        message: 'Pilih Mata Kuliah.'
                    }
                }
            },
            selecttype: {
                validators: {
                    notEmpty: {
                        message: 'Pilih Type Soal.'
                    }
                }
            },
            jmlsoal: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah Soal harus di isi'
                    },
                    callback: {
                        message: 'Jumlah Soal Tidak Valid',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            if (value.length < 1) {
                                return {
                                    valid: false,
                                    message: 'Soal Harus Lebih Dari 1 atau 1'
                            }}
                    return true;
                    }
                }
                }
            }
        }
    });
});
</script>