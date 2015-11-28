<?php
session_start();
//include "../ext/func.php";
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}

if(isset($_GET['update_soal'])){
$sl = $_POST['sl'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q5 = $_POST['q5'];
$ans = $_POST['ans'];
$status = $_POST['sts'];
$id = $_GET['update_soal'];
$cek = $dbcon->query("UPDATE bank_soal SET soal='$sl',q1='$q1',q2='$q2',q3='$q3',q4='$q4',q5='$q5',ans='$ans',used='$status' WHERE nosoal='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_soal'])){
$id = $_GET['update_soal'];
$cek = $dbcon->query("DELETE FROM bank_soal WHERE nosoal='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['update_jadwal'])){
$tgl1 = $_GET['d1'].$_GET['t1'];
$tgl2 = $_GET['d2'].$_GET['t2'];
$id = $_GET['update_jadwal'];
$cek = $dbcon->query("UPDATE jadwal_ujian SET mulai = '$tgl1',berakhir = '$tgl2' WHERE idjadwal='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}
$dbcon->close();
?>