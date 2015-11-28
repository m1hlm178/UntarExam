<?php
   include "../../../database/db_conection.php"; 
   
   
   $option = '<option value=""></option>';
   
   $jurusan = isset($_POST['jur']) ?  $_POST['jur'] :'';
   $sql = "select * from matkul where idjurusan='".$jurusan."'";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row['idmatkul']."'>".$row['nama_matkul']."</option>";
      }
   echo $option;

   
   
   /* tutup koneksinya */
   $dbcon->close();
?>