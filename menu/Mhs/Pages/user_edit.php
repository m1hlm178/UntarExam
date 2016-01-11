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
$r2 = mysqli_fetch_array(mysqli_query($dbcon, "SELECT * FROM fhoto_mhs WHERE detail_mhs_nim = '".$_SESSION['username']."'"));
$nim = $_SESSION['username'];
$nmor = substr($nim,"3","2");
$angkatan = "20" . $nmor;
?>
<div id="page-wrapper">
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">User Profile</h1>
              </div>
              <!-- /.col-lg-12 -->
          </div>
          <!-- left column -->
          <div class="panel-body">
          <form action="./ext/save_profile.php" id="useredit" enctype="multipart/form-data" class="form-horizontal" role="form" method="post">
            <div class="col-md-3">
                <div class="text-center">
                <?php
                if(!empty($r2[4])){
                    echo "<img id='imgpreview' src='data:image;base64,".$r2[4]."' class='img-circle img-responsive' alt='ImgUpload'>";
                }else{
                    echo "<img id='imgpreview' src='http://placehold.it/150' class='img-circle img-responsive' alt='ImgUpload'>";
                }
                ?>
                    <h6>Upload a different photo...</h6>
                    <div class="input-group">
                        <!-- <span class="input-group-btn"> -->
                            <span class="btn btn-primary btn-file" style="padding: 0px;">
                                <input id="imageupload" type="file" name="image" />
                            </span>
                        <!-- </span> -->
                        <!-- <input type="text" class="form-control"> -->
                    </div>
                </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-9 personal-info">
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
                    <label class="col-lg-3 control-label">Username:</label>
                    <div class="col-lg-8">
                        <?php
                        echo "<input class='form-control' id='username' name='username' value='".$_SESSION['username']."' type='text' disabled>";
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Password:</label>
                    <div class="col-lg-8">
                        <input class='form-control' id='pass' name='pass' value='' type='password'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">New password:</label>
                    <div class="col-lg-8">
                        <input class="form-control" id="cpass" name="cpass" value="" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                    <button class="btn btn-primary" type="submit" name="Input-Edit">Save Changes</button>
                        <span></span>
                        <a href="index.php?p=user_profiles" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </form>
    </div>
  </div>
    <script>
    $(function() {
    $("#imageupload").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imgpreview").attr("src", this.result);

            }
        }
        });
    });
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