<?php
   include "../../../database/db_conection.php"; 
   
   
   $option = '<option value=""></option>';
   
   $matkul = isset($_POST['jur']) ?  $_POST['jur'] :'';
   $sql = "select b.idkelas,b.kelas from matkul a,kelas b where b.matkul_idmatkul = a.idmatkul and a.idmatkul ='".$matkul."'";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row[0]."'>".$row[1]."</option>";
      }
   echo $option;

   
   
   /* tutup koneksinya */
   $dbcon->close();
?>