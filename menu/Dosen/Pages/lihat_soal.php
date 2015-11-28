<?php
session_start();
$s=htmlspecialchars($_GET['s']); 
$t=htmlspecialchars($_GET['t']);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List Soal <?php echo $s.' Type '.$t;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Data List Soal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="tabel-list">
                                    <thead>
                                        <tr>
                                            <th width="2%">ID</th>
                                            <th width="5%">Mata Kuliah</th>
                                            <th width="5%">Falkutas</th>
                                            <th width="5%">Jurusan</th>
                                            <th width="5%">Soal</th>
                                            <th width="5%">Q1</th>
                                            <th width="5%">Q2</th>
                                            <th width="5%">Q3</th>
                                            <th width="5%">Q4</th>
                                            <th width="5%">Q5</th>
                                            <th width="3%">Ans</th>
                                            <th width="3%">Status</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                            //Data mentah yang ditampilkan ke tabel 
                                            $getdata = "select a.nosoal,b.nama_matkul,c.nama_fal,d.nama_jur,a.soal,a.q1,a.q2,a.q3,a.q4,a.q5,a.ans,a.used from bank_soal a, matkul b, falkutas c, jurusan d where a.matkul_idmatkul = b.idmatkul and a.matkul_idjurusan = d.idjurusan and a.matkul_idfalkutas = c.idfalkutas and detail_dosen_nik = '".$_SESSION['username']."' and a.type_soal = '$t' and a.edisi = '$s'";
                                            $sql=mysqli_query($dbcon,$getdata);
                                            while ($r = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr align='left'>
                                                    <td><?php echo  $r[0]; ?></td>
                                                    <td><?php echo  $r[1]; ?></td>
                                                    <td><?php echo  $r[2]; ?></td>
                                                    <td><?php echo  $r[3]; ?></td>
                                                    <td><?php echo  $r[4]; ?></td>
                                                    <td><?php echo  $r[5]; ?></td>
                                                    <td><?php echo  $r[6]; ?></td>
                                                    <td><?php echo  $r[7]; ?></td>
                                                    <td><?php echo  $r[8]; ?></td>
                                                    <td><?php echo  $r[9]; ?></td>
                                                    <td><?php echo  $r[10]; ?></td>
                                                    <td><?php echo  $r[11]; ?></td>
                                                    
                                                    <td>
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

                                                    <form>
                                                       <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="sl">Soal</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="sl<?php echo $r[0]; ?>" value="<?php echo $r[4]; ?>">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="q1">Q1</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="q1<?php echo $r[0]; ?>" value="<?php echo $r[5]; ?>">
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="q2">Q2</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="q2<?php echo $r[0]; ?>" value="<?php echo $r[6]; ?>">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="q3">Q3</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="q3<?php echo $r[0]; ?>" value="<?php echo $r[7]; ?>">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="q4">Q4</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="q4<?php echo $r[0]; ?>" value="<?php echo $r[8]; ?>">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="q5">Q5</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="q5<?php echo $r[0]; ?>" value="<?php echo $r[9]; ?>">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="ans">Answer</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="ans<?php echo $r[0]; ?>" value="<?php echo $r[10]; ?>">
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="col-xs-6 col-sm-4 control-label" for="sts">Status</label>
                                                        <div class="col-xs-6 col-sm-4">
                                                        <input type="text" class="form-control" id="sts<?php echo $r[0]; ?>" value="<?php echo $r[11]; ?>">
                                                        </div>
                                                      </div>
                                                    </form>

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
        var sl = $('#sl'+str).val();
	var q1 = $('#q1'+str).val();
	var q2 = $('#q2'+str).val();
	var q3 = $('#q3'+str).val();
        var q4 = $('#q4'+str).val();
	var q5 = $('#q5'+str).val();
        var ans = $('#ans'+str).val();
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
	   type: "GET",
	   url: "ext/update_data.php?delete_soal="+id
	}).done(function( data ) {
          location.reload();
	});
    }
    
    $(document).ready(function() {
        $('#tabel-list').DataTable( {
                "sPaginationType": "full_numbers",
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf"
            }
        } );
    } );
</script>
