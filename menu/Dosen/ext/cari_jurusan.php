<?php
   include "../../../database/db_conection.php"; 
   
   
   $option = '<option value=""></option>';
   
   $falkutas = isset($_POST['fal']) ?  $_POST['fal'] :'';
   $sql = "select * from jurusan where falkutas_idfalkutas='".$falkutas."'";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row['idjurusan']."'>".$row['nama_jur']."</option>";
      }
   echo $option;

   
   
   /* tutup koneksinya */
   $dbcon->close();
?>