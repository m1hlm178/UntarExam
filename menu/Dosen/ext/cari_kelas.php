<?php
    session_start();
   include "../../../database/db_conection.php"; 
   $option = '<option value=""></option>';
   
   $matkul = isset($_POST['klas']) ?  $_POST['klas'] :'';
   $sql = "select idkelas,kelas from kelas where matkul_idmatkul='$matkul' and detail_dosen_nik = '".$_SESSION['username']."'";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row[0]."'>".$row[1]."</option>";
      }
   echo $option;

   
   
   /* tutup koneksinya */
   $dbcon->close();
?>