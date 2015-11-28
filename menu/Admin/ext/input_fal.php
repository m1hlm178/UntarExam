<?php
   include "../../../database/db_conection.php"; 
   
   
   $option = '<option value=""></option>';
   
   $nim = isset($_POST['fal']) ?  $_POST['fal'] :'';
   $sql = "select b.idfalkutas,b.nama_fal from detail_mhs a, falkutas b WHERE a.idfalkutas = b.idfalkutas AND a.nim='$nim' limit 1";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row[0]."'>".$row[1]."</option>";
      }
   echo $option;

   
   
   /* tutup koneksinya */
   $dbcon->close();
?>