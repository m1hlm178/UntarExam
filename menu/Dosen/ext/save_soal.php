<?php
//mulai proses tambah data
session_start();
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
//cek dahulu, jika tombol tambah di klik
if(isset($_POST['Save-Soal'])){
        $dosen          = $_SESSION['username'];
	$falkutas 	= $_SESSION['falkutas'];
	$jurusan	= $_SESSION['jurusan'];	
	$matkul		= $_SESSION['matkul'];
	$soaltype	= $_SESSION['type'];
        $jumlah         = $_SESSION['bnyksoal'];
        $soal           = $_POST['soal'];
        $jawaban        = $_POST['pg'];
        $soala         = $_POST['pta'];
        $soalb         = $_POST['ptb'];
        $soalc         = $_POST['ptc'];
        $soald         = $_POST['ptd'];
        $soale         = $_POST['pte'];
        for($i = 1;$i <= $jumlah ; $i++)
        {
//            echo $dosen.' MATKUL '.$matkul.' JURUSAN '.$jurusan.' FALKUTAS '.$falkutas.' SOAL  '.$soal[$i].' SOAL A '.$soala[$i].' SOAL B '.$soalb[$i].' SOAL C '.$soalc[$i].' SOAL D '.$soald[$i].'SOAL E '.$soale[$i].' JAWABAN '.$jawaban[$i].' TYPE '.$soaltype.' SOAL '.$_SESSION['soal'];
            $dbcon->query("INSERT into bank_soal(detail_dosen_nik,matkul_idmatkul,matkul_idjurusan,matkul_idfalkutas,soal,q1,q2,q3,q4,q5,ans,type_soal,edisi,tanggal) values ('$dosen','$matkul','$jurusan','$falkutas','$soal[$i]','$soala[$i]','$soalb[$i]','$soalc[$i]','$soald[$i]','$soale[$i]','$jawaban[$i]','$soaltype','".$_SESSION['soal']."',now())");
        }
        $_SESSION['notif'] = "Prosses Complete";		//Pesan jika proses tambah gagal
        header("location:../index.php?p=index");	//membuat Link untuk kembali ke halaman tambah
}
$dbcon->close();
?>