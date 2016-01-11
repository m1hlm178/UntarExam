<?php
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
$s=htmlspecialchars($_GET['s']); 
$t=htmlspecialchars($_GET['t']);
$matkulnya = htmlspecialchars($_GET['mtk']) ? (string)$_GET['mtk'] : kosong;
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lihat Soal <?php echo $s." Type ".$t;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                      <label class="col-lg-3 ">Mata Kuliah:</label>
                      <div class="col-lg-8">
                        <select class="form-control" id="seletmatkul" name="seletmatkul" style="width:300px">
                        <option value="kosong">---</option>
                        <?php

                        $getdata = "select a.matkul_idmatkul,b.nama_matkul from bank_soal a, matkul b where a.matkul_idmatkul = b.idmatkul and a.detail_dosen_nik = '12345678' and a.type_soal = 'A' and a.edisi = 'UTS' Group By a.matkul_idmatkul";
                        $sql=mysqli_query($dbcon,$getdata);
                        while($get=mysqli_fetch_array($sql))
                        {
                            echo "<option value='".$get[0]."'>".$get[1]."</option>";    
                        }
                        ?>
                        </select>
                      </div>
                    </div>
            <hr>
            <?php
            //paging
            $per_hal = 5;
            $jumlah_record = $dbcon->query("SELECT COUNT(*) FROM bank_soal WHERE type_soal = '".$t."' AND edisi = '".$s."' AND detail_dosen_nik = '12345678'");
            $jum =  mysqli_fetch_array($jumlah_record);
            $halaman = ceil($jum[0]/$per_hal);
            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $per_hal;
            if($matkulnya=='kosong'){
                $getdata = "select a.nosoal,b.nama_matkul,c.nama_fal,d.nama_jur,a.soal,a.q1,a.q2,a.q3,a.q4,a.q5,a.ans,a.used from bank_soal a, matkul b, falkutas c, jurusan d where a.matkul_idmatkul = b.idmatkul and a.matkul_idjurusan = d.idjurusan and a.matkul_idfalkutas = c.idfalkutas and detail_dosen_nik = '".$_SESSION['username']."' and a.type_soal = '".$t."' and a.edisi = '".$s."' ORDER BY a.nosoal DESC LIMIT $start, $per_hal";
            }else{
                 $getdata = "select a.nosoal,b.nama_matkul,c.nama_fal,d.nama_jur,a.soal,a.q1,a.q2,a.q3,a.q4,a.q5,a.ans,a.used from bank_soal a, matkul b, falkutas c, jurusan d where a.matkul_idmatkul = b.idmatkul and a.matkul_idjurusan = d.idjurusan and a.matkul_idfalkutas = c.idfalkutas and detail_dosen_nik = '".$_SESSION['username']."' and a.type_soal = '".$t."' and a.edisi = '".$s."' and a.matkul_idmatkul = '".$matkulnya."' ORDER BY a.nosoal DESC LIMIT $start, $per_hal";
            }
            $sql=$dbcon->query($getdata);
            if(false===$sql){
                echo "hasi" .$dbcon->error;
            }
            $no = 1;
            while ($r = mysqli_fetch_array ($sql))
            {
            $num = 4;
            ?>
                <div id="" class="row">

                    <div class="col-md-6">
                        <label><?php echo $no.".".$r[4];?></label>
                        <?php
                        for ($i=65; $i < 70; $i++) {
                        $num = $num+1;
                        echo "<div class='radio'>";
                        if(chr($i)==$r[10]){
                            echo chr($i).".<label><input type='radio' name='pg[".$i."]' checked='checked' disabled >".$r[$num]."</label>";
                        }else{
                            echo chr($i).".<label><input type='radio' name='pg[".$i."]' disabled>".$r[$num]."</label>";
                        }
                        echo "</div>";
                        }
                        ?>
                    </div>
                    <div class="col-md-3">
                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $r[0]; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a class="btn btn-danger btn-sm"  onclick="deletedata('<?php echo $r[0]; ?>')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $r[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $r[0]; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel<?php echo $r[0]; ?>">Edit Data</h4>
                          </div>
                          <div class="modal-body">

                      <div class="row">
                        <label class="col-md-4" for="sl">Soal</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="sl<?php echo $r[0]; ?>" value="<?php echo $r[4]; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="q1">Q1</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="q1<?php echo $r[0]; ?>" value="<?php echo $r[5]; ?>">
                          </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="q2">Q2</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="q2<?php echo $r[0]; ?>" value="<?php echo $r[6]; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="q3">Q3</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="q3<?php echo $r[0]; ?>" value="<?php echo $r[7]; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="q4">Q4</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="q4<?php echo $r[0]; ?>" value="<?php echo $r[8]; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="q5">Q5</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="q5<?php echo $r[0]; ?>" value="<?php echo $r[9]; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="ans">Answer</label>
                        <div class="col-md-4">
                        <!-- <input type="text" class="form-control" id="ans<?php echo $r[0]; ?>" value="<?php echo $r[10]; ?>"> -->
                        <?php 
                            for ($i=65; $i < 70; $i++) { 
                        ?>
                                <!-- <div class="radio"> -->
                                  <label>
                                    <?php 
                                        if (chr($i)==$r[10]) {
                                            echo "<input type='radio' name='ans".$r[0]."' id='ans".$r[0]."' value='".chr($i)."' checked='''>".chr($i);
                                        }else{
                                             echo "<input type='radio' name='ans".$r[0]."' id='ans".$r[0]."' value='".chr($i)."'>".chr($i);
                                        }
                                     ?>
                                  </label>
                                <!-- </div> -->
                        <?php
                            }
                         ?>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-md-4" for="sts">Status</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" id="sts<?php echo $r[0]; ?>" value="<?php echo $r[11]; ?>">
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
                    </div>
                </div>
            <?php
            $no++;
            }
            ?>
            <center>
            <ul class="pagination">
                <?php 
                if($page > 1){
                    echo "<li><a href='index.php?p=lihat_soal&s=$s&t=$t&mtk=$matkulnya&page=$page-1'> &laquo; </a></li>";
                }
                ?>
                </ul>
                <?php
                for($x=1;$x<=$halaman;$x++)
                {
                ?>
                    <ul class="pagination">
                        <li><a href="index.php?p=lihat_soal<?php echo "&s=".$s."&t=".$t."&mtk=".$matkulnya."&page=".$x ?>"><?php echo $x ?></a></li>
                    </ul>
                <?php
                }
                ?>
                <ul class="pagination">
                <?php
                if($page < $halaman){
                    echo "<li><a href='index.php?p=lihat_soal&s=$s&t=$t&mtk=$matkulnya&page=$page+1'> &laquo; </a></li>";
                }
                ?>
            </ul>   
            </center>
            </div>
            </div>
            <!-- /.row -->
</div>
<script type="text/javascript">
    $("#seletmatkul").chosen();
    $('#seletmatkul').on('change', function() {
      var d1 = "<?php echo $s?>";
      var d2 = "<?php echo $t?>";
      var d3 = this.value;
      var alldt = "&s="+d1+"&t="+d2+"&mtk="+d3;
      window.location.replace("index.php?p=lihat_soal"+alldt);
    });
    function updatedata(str){
    
    var id = str;
    var selectedVal = "";
    var selected = $("#myModal"+id+" input[type='radio']:checked");
    if (selected.length > 0) {
        selectedVal = selected.val();
        console.log(selectedVal)
    }
    var sl = $('#sl'+str).val();
    var q1 = $('#q1'+str).val();
    var q2 = $('#q2'+str).val();
    var q3 = $('#q3'+str).val();
    var q4 = $('#q4'+str).val();
    var q5 = $('#q5'+str).val();
    var ans = selectedVal;
    var sts = $('#sts'+str).val();
    
    var datas="sl="+sl+"&q1="+q1+"&q2="+q2+"&q3="+q3+"&q4="+q4+"&q5="+q5+"&ans="+ans+"&sts="+sts;
      
    $.ajax({
       type: "POST",
       url: "ext/update_data.php?update_soal="+id,
       data: datas
    }).done(function( data ) {
          location.reload();
    });
    }
    function deletedata(str){
    
    var id = str;
      
    $.ajax({
       type: "POST",
       url: "ext/update_data.php?delete_soal="+id
    }).done(function( data ) {
          location.reload();
    });
    }
</script>
