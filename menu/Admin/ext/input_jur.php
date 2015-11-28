<?php
   include "../../../database/db_conection.php"; 
   
   
   $option = '<option value=""></option>';
   
   $nim = isset($_POST['jur']) ?  $_POST['jur'] :'';
   $sql = "select b.idjurusan,b.nama_jur from detail_mhs a, jurusan b WHERE a.idjurusan = b.idjurusan AND a.nim='$nim' limit 1";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row[0]."'>".$row[1]."</option>";
      }
   echo $option;

   
   
   /* tutup koneksinya */
   $dbcon->close();
?>