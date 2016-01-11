<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php
            $r = mysqli_fetch_array(mysqli_query($dbcon,"SELECT * FROM detail_mhs WHERE nim = '".$_SESSION['username']."'"));
            $r1 = mysqli_fetch_array(mysqli_query($dbcon,"select * from detail_mhs a, jurusan b, falkutas c where a.idfalkutas = c.idfalkutas and a.idjurusan = b.idjurusan and a.nim = '".$_SESSION['username']."'"));
            if(is_numeric($_SESSION['username']))  {
               if (strlen($_SESSION['username'])<=8) {
                    $status="Dosen";
                }
                else {
                    $status="Mahasiswa";
                }
            }
            else  {
                $status="Admin";  
            }
            $nim = $_SESSION['username'];
            $nmor = substr($nim,"3","2");
            $angkatan = "20" . $nmor;
            ?>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                <?php
                $r2 = mysqli_fetch_array(mysqli_query($dbcon, "SELECT * FROM fhoto_mhs WHERE detail_mhs_nim = '".$_SESSION['username']."'"));
                if(!empty($r2[4])){
                    echo "<img src='data:image;base64,".$r2[4]."' class='img-circle img-responsive' alt='PicProfile'>";
                }else{
                    echo "<img src='http://placehold.it/150' class='img-circle img-responsive' alt='PicProfile'>";
                }
                ?>
                </div>
                <div class="col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nama:</td>
                        <td><?php echo $r['nama'];?></td>
                      </tr>
                      <tr>
                        <td>Falkutas:</td>
                        <td><?php echo $r1['nama_fal'];?></td>
                      </tr>
                       <tr>
                        <td>Jurusan:</td>
                        <td><?php echo $r1['nama_jur'];?></td>
                      </tr>
                      <tr>
                        <td>Angkatan:</td>
                        <td><?php echo $angkatan;?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo $r['email'];?></td>
                      </tr>
                      <tr>
                        <td>Level:</td>
                        <td><?php echo $status;?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="index.php?p=user_edit" class="btn btn-primary">Ganti Data</a>
                </div>
              </div>
            </div>
</div>
