<?php
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
if(isset($_POST['Input-Soal'])){
	
	$_SESSION['falkutas']=$_POST['selectfal'];
        $_SESSION['jurusan']=$_POST['selectjur'];
        $_SESSION['matkul']=$_POST['matkul'];
        $_SESSION['type']=$_POST['selecttype'];
        $_SESSION['bnyksoal']=$_POST['jmlsoal'];
        $jmlh = $_POST['jmlsoal'];
}
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Soal <?php echo $_SESSION['soal'];?></h1>
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
                                <?php
                                for ($i = 1; $i <= $jmlh; $i++)
                                { 
                                ?>
                                <form name="list-soal" method="post" action="./ext/save_soal.php">
                                <div class="col-md-6 form-group">
                                <label><?php echo "Soal No ".$i?></label>
                                <input class="form-control input-sm col-md-6" name="soal[<?php echo $i; ?>]" type="text">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pg[<?php echo $i;?>]" value="A">A<input class="form-control input-sm col-md-6" name="pta[<?php echo $i;?>]" type="text">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pg[<?php echo $i;?>]" value="B">B<input class="form-control input-sm col-md-6" name="ptb[<?php echo $i;?>]" type="text">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pg[<?php echo $i;?>]" value="C">C<input class="form-control input-sm col-md-6" name="ptc[<?php echo $i;?>]" type="text">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pg[<?php echo $i;?>]" value="D">D<input class="form-control input-sm col-md-6" name="ptd[<?php echo $i;?>]" type="text">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pg[<?php echo $i;?>]" value="E">E<input class="form-control input-sm col-md-6" name="pte[<?php echo $i;?>]" type="text">
                                    </label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                                <div class="form-group">
                                  <label class="col-md-4 control-label"></label>
                                  <div class="col-md-4">
                                    <button class="btn btn-primary" type="submit" name="Save-Soal" class="btn btn-primary btn-block">Simpan</button>
                                  </div>
                                </div>
                                </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
<!--    <script>
    $(document).ready(function() {
    $('#list-soal')
    .formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        soal[1]: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah Soal harus di isi'
                    }
                }
        },
        soal[2]: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah Soal harus di isi'
                    }
                }
        }
        }
    });
});
    </script>-->