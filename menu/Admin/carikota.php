<?php
   include "../../database/db_conection.php"; //menyisipkan file koneksi.php
   
   $option = '<option value=""></option>';
   
   $falkutas = isset($_POST['prop']) ?  $_POST['prop'] :'';
   $sql = "select * from jurusan where falkutas_idfalkutas='".$falkutas."'";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row['idjurusan']."'>".$row['nama']."</option>";
      }
   echo $option;
   
   /* tutup koneksinya */
   $dbcon->close();
?>