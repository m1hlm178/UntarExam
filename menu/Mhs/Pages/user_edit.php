<?php
session_start();
//include "../ext/func.php";
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
//echo "<input class='form-control' value='".$id."' type='text' disabled>";
$r = mysqli_fetch_array(mysqli_query($dbcon,"select * from detail_mhs a, jurusan b, falkutas c where a.idfalkutas = c.idfalkutas and a.idjurusan = b.idjurusan and a.nim = '".$_SESSION['username']."'"));
$r1 = mysqli_fetch_array(mysqli_query($dbcon, "SELECT * FROM login_mhs WHERE id = '".$_SESSION['username']."'"));
$nim = $_SESSION['username'];
$nmor = substr($nim,"3","2");
$angkatan = "20" . $nmor;
?>
       <div id="page-wrapper">
            <div class="container" style="padding-top: 10px;">
              <h1 class="page-header">Edit Data Pribadi</h1>
              <div class="row">
                <!-- edit form column -->
                <div class="col-md-8 col-xs-12 personal-info">
                  <form action="./ext/save_profile.php" id="useredit" class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Nama:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' name='nama' id='nama' value='".$r['nama']."' type='text'>";
                        ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Falkutas:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='falkutas' name='falkutas' value='".$r['nama_fal']."' type='text' disabled>";
                        ?>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Jurusan:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='jurusan' name='jurusan' value='".$r['nama_jur']."' type='text' disabled>";
                        ?>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Angkatan:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='angkatan' name='angkatan' value='".$angkatan."' type='text' disabled>";
                        ?>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Telephone:</label>
                      <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='telp' name='telp' value='".$r['telephone']."' type='text'>";
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
<?php
$dbcon->close();
?>    