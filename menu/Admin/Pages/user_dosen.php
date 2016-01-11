        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pengaturan Akun Dosen</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Membuat ID Dosen Baru
                        </div>
                             <div class="panel-body">
                                <div class="row">
                              <form action="./ext/input.php" name="registrationForm" id="registrationForm" class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">NIK:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="nik" name="nik" type="text" placeholder="" class="input-large" required="">
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Nama:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="nama" name="nama" type="text" placeholder="" class="input-xlarge" required="">
                                    
                                  </div>
                                </div>

                                    <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Alamat:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="alamat" name="alamat" type="text" placeholder="" class="input-xlarge" required="">
                                  </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Telephone:</label>
                                  <div class="col-lg-8">
                                    <input class="form-control" id="telp" name="telp" type="text" placeholder="" class="input-xlarge" required="">
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
                                    <button class="btn btn-primary" type="submit" name="User-Dosen" class="btn btn-primary btn-block">Simpan User</button>
                                  </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Data List Dosen
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="user-dosen-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="5%">NIK</th>
                                            <th width="5%">Nama</th>
                                            <th width="5%">Alamat</th>
                                            <th width="5%">Telephone</th>
                                            <th width="5%">Email</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "SELECT * FROM detail_dosen ORDER BY nik desc";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            $no = 1;
                                            while ($r = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $no;?></td>
                                                    <td><?php echo  $r['nik']; ?></td>
                                                    <td><?php echo  $r['nama']; ?></td>
                                                    <td><?php echo  $r['alamat']; ?></td>
                                                    <td><?php echo  $r['telephone']; ?></td>
                                                    <td><?php echo  $r['email']; ?></td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $r['nik']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                        <a class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $r['nik']; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                                    
                                                    <!-- Modal -->
                                            <div class="modal fade" id="myModal<?php echo $r['nik']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $r['nik']; ?>" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel<?php echo $r['nik']; ?>">Edit Data <?php echo $r['nik']; ?></h4>
                                                  </div>
                                                  <div class="modal-body">
                                                          <div class="row">
                                                          <label class="col-md-4" for="nm">Nama</label>
                                                              <div class="col-md-4">
                                                              <input type="text" class="form-control" id="nm<?php echo $r['nik']; ?>" value="<?php echo $r['nama']; ?>">
                                                              </div>
                                                          </div>
                                                        <div class="row">
                                                          <label class="col-md-4" for="almt">Alamat</label>
                                                          <div class="col-md-4">
                                                          <input type="text" class="form-control" id="almt<?php echo $r['nik']; ?>" value="<?php echo $r['alamat']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                          <label class="col-md-4" for="tlp">Telephone</label>
                                                          <div class="col-md-4">
                                                          <input type="text" class="form-control" id="tlp<?php echo $r['nik']; ?>" value="<?php echo $r['telephone']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                          <label class="col-md-4" for="eml">Email</label>
                                                          <div class="col-md-4">
                                                          <input type="text" class="form-control" id="eml<?php echo $r['nik']; ?>" value="<?php echo $r['email']; ?>">
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
    var nm = $('#nm'+str).val();
	var almt = $('#almt'+str).val();
	var tlp = $('#tlp'+str).val();
	var eml = $('#eml'+str).val();
	
	var datas="nm="+nm+"&almt="+almt+"&tlp="+tlp+"&eml="+eml;
      
	$.ajax({
	   type: "POST",
	   url: "ext/update_data.php?update_dosen="+id,
	   data: datas
	}).done(function( data ) {
          location.reload();
	});
    }
    function deletedata(str){
	
	var id = str;
      
	$.ajax({
	   type: "GET",
	   url: "ext/update_data.php?delete_dosen="+id
	}).done(function( data ) {
          location.reload();
	});
    }
        
        
    $(document).ready(function() {
        $('#user-dosen-list').DataTable( {
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
            nik: {
                validators: {
                    notEmpty: {
                        message: 'NIK harus di isi'
                    },
                    callback: {
                        message: 'NIK Tidak Valid',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            if (value.length < 8) {
                                return {
                                    valid: false,
                                    message: 'Panjang NIK Harus 8 digits'
                            }}
                            if (value.length >= 9) {
                                return {
                                    valid: false,
                                    message: 'Panjang NIK Harus 8 digits'
                            };
                        }
                    return true;
                }
            }}},
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama harus di isi'
                    }
                }
            },
            alamat: {
                validators: {
                    notEmpty: {
                        message: 'Alamat harus di isi'
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
});
    </script>