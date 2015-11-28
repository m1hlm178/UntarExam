<?php 
session_start();
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
       if(isset($_POST['Finish-Ujian'])){
                $pilihan=$_POST["pg"];
                $id_soal=$_POST["id"];
                $jumlah=$_POST['jumlah'];

                $score=0;
                $benar=0;
                $salah=0;
                $kosong=0;

                for ($i=0;$i<$jumlah;$i++){
                        //id nomor soal
                        $nomor=$id_soal[$i];

                        //jika user tidak memilih jawaban
                        if (empty($pilihan[$nomor])){
                                $kosong++;
                        }else{
                                //jawaban dari user
                                $jawaban=$pilihan[$nomor];

                                //cocokan jawaban user dengan jawaban di database
                                $q=$dbcon->query("select * from bank_soal where nosoal='$nomor' and ans='$jawaban'");

                                $cek=mysqli_num_rows($q);

                                if($cek){
                                        //jika jawaban cocok (benar)
                                        $benar++;
                                }else{
                                        //jika salah
                                        $salah++;
                                }

                        } 
                        $score = $benar*5;
                }
        }
$data = mysqli_fetch_array(mysqli_query($dbcon, "select a.no,a.detail_mhs_nim,a.detail_mhs_idfalkutas,a.detail_mhs_idjurusan from isi_kelas a, kelas b, jadwal_ujian c where a.kelas_idkelas = b.idkelas and c.kelas_idkelas = b.idkelas and c.idjadwal = '".$_SESSION['idjadwal']."' and a.detail_mhs_nim = '".$_SESSION['username']."'"));
//echo $score.' '.$_SESSION['edisi'].' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[3];
$cek = $dbcon->query("INSERT into nilai(nilai,edisi,isi_kelas_no,isi_kelas_detail_mhs_nim,isi_kelas_detail_mhs_idjurusan,isi_kelas_detail_mhs_idfalkutas) values ('$score','".$_SESSION['edisi']."','$data[0]','$data[1]','$data[3]','$data[2]')");
if($cek){

        $_SESSION['notif'] = "Nilai Input Sukses!!";		//Pesan jika proses tambah sukses
        header("location:../index.php?p=lihat_nilai");
} else{
$_SESSION['notif'] = "Insert Data Gagal!!";		//Pesan jika proses tambah gagal
header("location:../index.php?p=index");	//membuat Link untuk kembali ke halaman tambah
$dbcon->close();
}
?>