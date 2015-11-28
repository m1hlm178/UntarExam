<?php
session_start();
//include "../ext/func.php";
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}

if(isset($_GET['update_falkutas'])){
$nm = $_POST['nm'];
$id = $_GET['update_falkutas'];
$cek = $dbcon->query("UPDATE falkutas SET nama_fal='$nm' WHERE idfalkutas='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_falkutas'])){
$id = $_GET['delete_falkutas'];
$cek = $dbcon->query("DELETE FROM falkutas WHERE idfalkutas='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['update_jurusan'])){
$nm = $_POST['nm'];
$id = $_GET['update_jurusan'];
$cek = $dbcon->query("UPDATE jurusan SET nama_jur='$nm' WHERE idjurusan='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_jurusan'])){
$id = $_GET['delete_jurusan'];
$cek = $dbcon->query("DELETE FROM jurusan WHERE idjurusan='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['update_dosen'])){
$nm = $_POST['nm'];
$almt = $_POST['almt'];
$tlp = $_POST['tlp'];
$eml = $_POST['eml'];
$id = $_GET['update_dosen'];
$cek = $dbcon->query("UPDATE detail_dosen SET nama='$nm',alamat='$almt',telephone='$tlp',email='$eml' WHERE nik='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_dosen'])){
$id = $_GET['delete_dosen'];
$cek = $dbcon->query("DELETE FROM detail_dosen WHERE nik='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['update_mhs'])){
$nm = $_POST['nm'];
$tlp = $_POST['tlp'];
$eml = $_POST['eml'];
$id = $_GET['update_mhs'];
$cek = $dbcon->query("UPDATE detail_mhs SET nama='$nm',telephone='$tlp',email='$eml' WHERE nim='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_mhs'])){
$id = $_GET['delete_mhs'];
$cek = $dbcon->query("DELETE FROM detail_mhs WHERE nim='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_matkul'])){
$id = $_GET['delete_matkul'];
$cek = $dbcon->query("DELETE FROM matkul WHERE idmatkul='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_dosen_matkul'])){
$id = $_GET['delete_dosen_matkul'];
$cek = $dbcon->query("DELETE FROM kelas WHERE idkelas='$id'");
if($cek)
{
$_SESSION['notif'] = "Anda berhasil mengubah data.";
}
else
{
$_SESSION['notif'] = "Maaf terjadi kesalahan, data error.";
}
}

if(isset($_GET['delete_mhs_matkul'])){
$id = $_GET['delete_mhs_matkul'];
$cek = $dbcon->query("DELETE FROM isi_kelas WHERE detail_mhs_nim='$id'");
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