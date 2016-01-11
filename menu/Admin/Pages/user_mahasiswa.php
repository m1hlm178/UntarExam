        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pengaturan Akun Mahasiswa</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat ID Mahasiswa Baru
                        </div>
                             <div class="panel-body">
                                <div class="row">
                              <form action="./ext/input.php" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">NIM:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="nim" name="nim" type="text" placeholder="" class="input-large" required>
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
                                    // $dbcon->close();
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
                                  <label class="col-lg-3 control-label">Nama:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="nama" name="nama" type="text" placeholder="" class="input-xlarge" required>
                                    
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Telephone:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="telp" name="telp" type="text" placeholder="" class="input-xlarge" required>
                                    
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Email:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="email" name="email" type="text">
                                  </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                 <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit" name="User-Mhs" class="btn btn-primary btn-block">Simpan User</button>
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
                                            <th width="5%">NIK</th>
                                            <th width="10%">Nama</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="5%">Telephone</th>
                                            <th width="5%">Email</th>
                                            <th width="5%">Angkatan</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
<?php
//Data mentah yang ditampilkan ke tabel 
$getdata = "select * from detail_mhs a, falkutas b, jurusan c where c.idjurusan = a.idjurusan and a.idfalkutas= b.idfalkutas";
$sql=mysqli_query($dbcon,$getdata);
$no = 1;
while ($r = mysqli_fetch_array($sql)) {
?>
    <tr align='left'>
        <td><?php echo  $no;?></td>
        <td><?php echo  $r['nim']; ?></td>
        <td><?php echo  $r['nama']; ?></td>
        <td><?php echo  $r['nama_fal']; ?></td>
        <td><?php echo  $r['nama_jur']; ?></td>
        <td><?php echo  $r['telephone']; ?></td>
        <td><?php echo  $r['email']; ?></td>
        <td><?php echo  $r['angkatan']; ?></td>
        <td>
            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $r['nim']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <a class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $r['nim']; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo $r['nim']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $r['nim']; ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel<?php echo $r['nim']; ?>">Edit Data</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <label class="col-md-4" for="nm">Nama</label>
                  <div class="col-md-4">
                  <input type="text" class="form-control" id="nm<?php echo $r['nim']; ?>" value="<?php echo $r['nama']; ?>">
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-4" for="tlp">Telephone</label>
                  <div class="col-md-4">
                  <input type="text" class="form-control" id="tlp<?php echo $r['nim']; ?>" value="<?php echo $r['telephone']; ?>">
                    </div>
                </div>
                <div class="row">
                  <label class="col-md-4" for="eml">Email</label>
                  <div class="col-md-4">
                  <input type="text" class="form-control" id="eml<?php echo $r['nim']; ?>" value="<?php echo $r['email']; ?>">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="updatedata('<?php echo $r['nim']; ?>')" class="btn btn-primary">Save changes</button>
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
	var tlp = $('#tlp'+str).val();
	var eml = $('#eml'+str).val();
	
	var datas="nm="+nm+"&tlp="+tlp+"&eml="+eml;
      
	$.ajax({
	   type: "POST",
	   url: "ext/update_data.php?update_mhs="+id,
	   data: datas
	}).done(function( data ) {
          location.reload();
	});
    }
    function deletedata(str){
	
	var id = str;
      
	$.ajax({
	   type: "GET",
	   url: "ext/update_data.php?delete_mhs="+id
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
            url: './ext/cari_jurusan.php',
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
            nim: {
                validators: {
                    digits: {
                        message: 'NIM Hanya dalam bentuk digit'
                    },
                    notEmpty: {
                        message: 'NIM harus di isi'
                    },
                    callback: {
                        message: 'NIM Tidak Valid',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            if (value.length < 9) {
                                return {
                                    valid: false,
                                    message: 'Panjang NIM Harus 9 digits'
                            };
                        }
                    return true;
                }
            }}
            },
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama harus di isi'
                    }
                }
            },
            telp: {
                validators: {
                    digits: {
                        message: 'Hanya dalam bentuk digit'
                    },
                    notEmpty: {
                        message: 'Telephone harus di isi'
                    },
                     callback: {
                        message: 'Telephone Tidak Valid',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            if (value.length < 9) {
                                return {
                                    valid: false,
                                    message: 'Panjang Telephone Harus 9 digits'
                            };
                        }
                    return true;
                }
            }}
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'Masukan email yang valid'
                    }
                }
            }
        }
    });
</script>