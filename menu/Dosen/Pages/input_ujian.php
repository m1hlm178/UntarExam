<?php
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Membuat Ujian Baru</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Membuat Ujian Baru
                        </div>
                            <div class="panel-body">
                            <div class="row">
                              <form action="./index.php?p=buat_ujian" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                    <!-- Select Basic -->
                                                                  
                                <label class="col-lg-3 control-label">Mata Kuliah:</label>
                                  <div class="col-lg-8">
                                      <select class="form-control" id="matkul" name="matkul" style="width:300px">
                                        <option value=""></option>
                                        <?php
                                        $getdata = "select b.idmatkul,b.nama_matkul from kelas a, matkul b where a.matkul_idmatkul = b.idmatkul AND a.detail_dosen_nik = '".$_SESSION['username']."'";
                                        $sql=mysqli_query($dbcon,$getdata);
                                        // echo "<option value='kosong' selected>- Pilih Falkutas -</option>";
                                        while($get=mysqli_fetch_array($sql))
                                        {
                                            // echo "<option value='$get[idfalkutas]' selected> $get[nama]</option>";
                                            echo "<option value='".$get[0]."'>".$get[1]."</option>";    
                                        }
                                        ?>
                                      </select>
                                  </div>
                                </div>
                                  
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ujian:</label>
                                    <div class="col-lg-8">
                                      <select class="form-control" id="edisi" name="edisi" style="width:300px">
                                      <option value="UAS">UAS</option>
                                      <option value="UTS">UTS</option>
                                      </select>
                                    </div>
                                </div>
                                  
                                <!-- Select Basic -->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Kelas:</label>
                                  <div class="col-lg-8">
                                    <select class="form-control" id="kelas" name="kelas" style="width:300px">
                                    <option value=""></option>
                                    
                                    </select>
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
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Tanggal dan Waktu Ujian:</label>
                                  <div class="col-lg-8">
                                    <p id="TglUjian">
                                        <input type="text" name="tanggalmulai" class="date start" />
                                        <input type="text" name="waktustart" class="time start" />

                                    </p>
                                    <p id="TglUjian">
                                        <input type="text" name="tanggalselesai" class="date end" />
                                        <input type="text" name="waktuend" class="time end" /> 
                                    </p>
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Jumlah Soal:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="jmlsoal" name="jmlsoal" type="text" placeholder="" class="input-xlarge">
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="Save-Ujian" class="btn btn-primary btn-block">Simpan</button>
                                  </div>
                                </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
//    jQuery('#datetimepicker').datetimepicker({
//    format:'Y-m-d H:i:00',
//    allowTimes:[
//                '08:30','10:30','10:40','12:40','13:00','15:00'
//              ],
//    lang:'id',
//    minDate:0
//  });
 
    /*** script untuk mencari kota/kabupaten berdasarkan propinsi */ 
    $("#edisi").chosen();
    $("#selecttype").chosen();
    $("#matkul").chosen();
    $("#kelas").chosen();
    $(function(){
    $("#matkul").chosen().change(function(){
    var idfal = $("#matkul").val();
        var html = '';
        $.ajax({
        type: "POST",
            url: 'ext/cari_kelas.php',
            data: 'klas=' + idfal,
            success: function(dt) {
            $('#kelas').html(dt).trigger("chosen:updated");
            },  
       error: function(e){  
            alert('Error: ' + e);  
            }  
     });
    });
    });
    
//jQuery(function(){
//    jQuery('#datestart').datetimepicker({
//     format:'Y-m-d H:i:00',
//     allowTimes:[
//                   '08:30','10:30','10:40','12:40','13:00','15:00'
//                 ],
//       lang:'id',
//     minDate:0
//    });
//    jQuery('#dateend').datetimepicker({
//       format:'Y-m-d H:i:00',
//       startDate:new Date(),
//       allowTimes:[
//                   '08:30','10:30','10:40','12:40','13:00','15:00'
//                 ],
//       lang:'id',
//       minDate:0
//    });
//   });
    // initialize input widgets first
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

    // initialize datepair
    $('#jqueryExample').datepair();
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
            tanggalmulai: {
                validators: {
                    notEmpty: {
                        message: 'Pilih Tanggal Mulai.'
                    }
                }
            },
            tanggalselesai: {
                validators: {
                    notEmpty: {
                        message: 'Piliih Tanggal Selesai.'
                    }
                }
            },
            waktustart: {
                validators: {
                    notEmpty: {
                        message: 'Pilih Waktu Start.'
                    }
                }
            },
            waktuend: {
                validators: {
                    notEmpty: {
                        message: 'Pilih Waktu Selesai.'
                    }
                }
            },
            kelas: {
                validators: {
                    notEmpty: {
                        message: 'Pilih Kelas Anda.'
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