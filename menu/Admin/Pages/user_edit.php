<?php
//echo "<input class='form-control' value='".$id."' type='text' disabled>";
$r = mysqli_fetch_array(mysqli_query($dbcon,"SELECT * FROM detail_admin WHERE login_admin_id = '".$_SESSION['username']."'"));
$r1 = mysqli_fetch_array(mysqli_query($dbcon, "SELECT * FROM login_admin WHERE id = '".$_SESSION['username']."'"))
?>
       <div id="page-wrapper">
            <div class="container" style="padding-top: 10px;">
              <h1 class="page-header">Edit Data Pribadi</h1>
              <div class="row">
                <!-- edit form column -->
                <div class="col-md-8 col-xs-12 personal-info">
                  <form action="./ext/input.php" id="useredit" class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Nama:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' name='nama' id='nama' value='".$r['nama']."' type='text'>";
                        ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Alamat:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='alamat' name='alamat' value='".$r['alamat']."' type='text'>";
                        ?>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Telephone:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='telp' name='telp' value='".$r['hp']."' type='text'>";
                        ?>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Email:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='email' name='email' value='".$r['email']."' type='text'>";
                        ?>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Username:</label>
                      <div class="col-md-8">
                          <?php
                          echo "<input class='form-control' id='username' name='username' value='".$_SESSION['username']."' type='text' disabled>";
                          ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Password:</label>
                      <div class="col-md-8">
                      <input class='form-control' id='pass' name='pass' value='' type='password'>
<!--                           <?php
                         // echo "<input class='form-control' id='pass' name='pass' value='".$r1[pass]."' type='password'>";
                          ?> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">New password:</label>
                      <div class="col-md-8">
                        <input class="form-control" id="cpass" name="cpass" value="" type="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label"></label>
                      <div class="col-md-8">
                        <button class="btn btn-primary" type="submit" name="Input-Edit" class="btn btn-primary btn-block">Simpan</button>
                        <span></span>
                        <a href="index.php?p=user_profiles"><input class="btn btn-default" value="Cancel" type="button">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    <script>
    $(document).ready(function() {
        $('#useredit')
        .formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
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
            },
            pass: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            },
            cpass: {
                validators: {
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            }
        }
    });
});
    </script>