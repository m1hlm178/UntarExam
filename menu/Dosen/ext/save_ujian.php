<?php
//mulai proses tambah data
session_start();
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
//cek dahulu, jika tombol tambah di klik
if(isset($_POST['Finish-Ujian'])){
        $id_soal         = $_POST["id"];
        $dosen          = $_SESSION['username'];	
	$matkul		= $_SESSION['matkul'];
        $edisi          = $_SESSION['edisi'];
        $soaltype	= $_SESSION['type'];
        $kelas          = $_SESSION['kelas'];
        $datestart      = $_SESSION['mulai'].' '.$_SESSION['wktmulai'];
        $dateend        = $_SESSION['selesai'].' '.$_SESSION['wktselesai'];
        $jumlah         = $_SESSION['jml'];
        $month = date('m');
        if($month<6){
           $tahun = date('Y') .'/'.date('Y', strtotime('+1 year'));
        }else
        {
           $tahun = date('Y',strtotime('+1 year')) .'/'.date('Y', strtotime('+2 year'));
        }
        $cek = $dbcon->query("SELECT * FROM jadwal_ujian WHERE kelas_idkelas ='$kelas' and kelas_detail_dosen_nik = '$dosen'  and kelas_matkul_idmatkul = '$matkul' and edisi = '$edisi' and tahun = '$tahun'");
	$cek1 = mysqli_num_rows($cek);
//        echo $nik.$nama.$alamay.$telephone.$email.$passencrypt;
	if($cek1>0)
	{
		
		$_SESSION['notif'] = "Jadwal Sudah Ada!!!, silahkan diulang kembali";
		header("location:../index.php?p=input_ujian");
        }
        else
        {
        $r1 = mysqli_fetch_array(mysqli_query($dbcon,"Select * from jadwal_ujian ORDER BY idjadwal DESC LIMIT 1"));
        $idmax = $r1['idjadwal'];
        $nourut = (int) substr($idmax, 3,5);
        $nourut++;
        $IDbaru = $edisi . sprintf("%05s", $nourut);
        echo $IDbaru;
        $dbcon->query("INSERT into jadwal_ujian(idjadwal,kelas_idkelas,kelas_detail_dosen_nik,kelas_matkul_idmatkul,edisi,tahun,mulai,berakhir) values ('$IDbaru','$kelas','$dosen','$matkul','$edisi','$tahun','$datestart','$dateend')");
        for($i = 0;$i <= $jumlah ; $i++)
        {
            $nomor=$id_soal[$i];
            
//            echo $dosen.' MATKUL '.$matkul.' JURUSAN '.$jurusan.' FALKUTAS '.$falkutas.' SOAL  '.$soal[$i].' SOAL A '.$soala[$i].' SOAL B '.$soalb[$i].' SOAL C '.$soalc[$i].' SOAL D '.$soald[$i].'SOAL E '.$soale[$i].' JAWABAN '.$jawaban[$i].' TYPE '.$soaltype.' SOAL '.$_SESSION['soal'];
            $dbcon->query("UPDATE bank_soal SET used='YES' WHERE nosoal='$nomor'");
            $dbcon->query("INSERT into soal_ujian(bank_soal_nosoal,jadwal_ujian_idjadwal) values ('$nomor','$IDbaru')");
        }

        $_SESSION['notif'] = "Prosses Complete";		//Pesan jika proses tambah gagal
        header("location:../index.php?p=index");	//membuat Link untuk kembali ke halaman tambah
        }
}
$dbcon->close();
?>