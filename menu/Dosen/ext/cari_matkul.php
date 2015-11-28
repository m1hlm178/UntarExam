<?php
   include "../../../database/db_conection.php"; 
   session_start();
   $option = '<option value=""></option>';
   
   $jurusan = isset($_POST['jur']) ?  $_POST['jur'] :'';
   $sql = "select b.idmatkul,b.nama_matkul from kelas a, matkul b where a.matkul_idmatkul = b.idmatkul AND b.idjurusan = '$jurusan' AND a.detail_dosen_nik = '".$_SESSION['username']."'";
   $sqls=mysqli_query($dbcon,$sql);
    while($row=mysqli_fetch_array($sqls)){
       $option .= "<option value='".$row[0]."'>".$row[1]."</option>";
      }
   echo $option;
   /* tutup koneksinya */
   $dbcon->close();
?>