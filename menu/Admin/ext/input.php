<?php
//mulai proses tambah data
session_start();
//include "../ext/func.php";
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
//cek dahulu, jika tombol tambah di klik
if(isset($_POST['User-Dosen'])){
	
	//inlcude atau memasukkan file koneksi ke database
	
	//jika tombol tambah benar di klik maka lanjut prosesnya
	$nik		= $_POST['nik'];	//membuat variabel $nis dan datanya dari inputan NIS
	$nama		= $_POST['nama'];	//membuat variabel $nama dan datanya dari inputan Nama Lengkap
	$alamat		= $_POST['alamat'];
	$telephone	= $_POST['telp'];	//membuat variabel $kelas dan datanya dari inputan dropdown Kelas
	$email		= $_POST['email']; 	//membuat variabel $jurusan dan datanya dari inputan dropdown Jurusan
	$passencrypt = sha1($nik);
	$cek = $dbcon->query("SELECT * FROM login_dosen WHERE id = '$nik'");
	$cek1 = mysqli_num_rows($cek);
//        echo $nik.$nama.$alamay.$telephone.$email.$passencrypt;
	if($cek1>0)
	{
		
		$_SESSION['notif'] = "ID Dosen sudah dipakai !, silahkan diulang kembali";
		header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
                $dbcon->query("INSERT into login_dosen(id,pass) values ('$nik','$passencrypt')");
                $sql = $dbcon->query("INSERT INTO detail_dosen VALUES ('$nik','$nama','$alamat','$telephone','$email')");
                if($sql){

                        $_SESSION['notif'] = "Insert Data Sukses!!";		//Pesan jika proses tambah sukses
                        header("Location: {$_SERVER['HTTP_REFERER']}");
                } else{
                $_SESSION['notif'] = "Insert Data Gagal!!";		//Pesan jika proses tambah gagal
                header("Location: {$_SERVER['HTTP_REFERER']}");	//membuat Link untuk kembali ke halaman tambah
		
	}
    }
}

if(isset($_POST['User-Mhs'])){
	
	//inlcude atau memasukkan file koneksi ke database
	
	//jika tombol tambah benar di klik maka lanjut prosesnya
	$nim		= $_POST['nim'];	//membuat variabel $nis dan datanya dari inputan NIS
	$selectfal	= $_POST['selectfal'];	//membuat variabel $nama dan datanya dari inputan Nama Lengkap
	$selectjur	= $_POST['selectjur'];
	$nama		= $_POST['nama'];	//membuat variabel $kelas dan datanya dari inputan dropdown Kelas
	$telp		= $_POST['telp']; 	//membuat variabel $jurusan dan datanya dari inputan dropdown Jurusan
	$email 		= $_POST['email'];
	$nmor = substr("$nim","3","2");
	$angkatan = "20" . $nmor;
	$passencrypt = sha1($nim);
	$cek = $dbcon->query("SELECT * FROM login_mhs WHERE id = '$nim'");
	$cek1 = mysqli_num_rows($cek);
//        echo $nim . $selectfal . $selectjur .$nama.$telp.$email.$angkatan;
	if($cek1>0)
	{
		
		$_SESSION['notif'] = '<script> alert("ID Mahasiswa sudah dipakai !, silahkan diulang kembali");</script>';
		header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {

		$dbcon->query("INSERT into login_mhs(id,pass) values ('$nim','$passencrypt')");
		$sql = $dbcon->query("INSERT INTO detail_mhs VALUES ('$nim','$nama','$email','$telp','$angkatan','$selectjur','$selectfal')");
		if($sql){
			
			$_SESSION['notif'] = "Insert Data Sukses!!";		//Pesan jika proses tambah sukses
			header("Location: {$_SERVER['HTTP_REFERER']}");
		} else{
		$_SESSION['notif'] = "Insert Data Gagal!!";		//Pesan jika proses tambah gagal
		header("Location: {$_SERVER['HTTP_REFERER']}");	//membuat Link untuk kembali ke halaman tambah
		
	}
    }
}

if(isset($_POST['Input-Matkul'])){
	
	//inlcude atau memasukkan file koneksi ke database
	
	//jika tombol tambah benar di klik maka lanjut prosesnya
	$selectfal	= $_POST['selectfal'];	//membuat variabel $nama dan datanya dari inputan Nama Lengkap
	$selectjur	= $_POST['selectjur'];
	$matkul		= $_POST['matkul'];	//membuat variabel $kelas dan datanya dari inputan dropdown Kelas
        $r = mysqli_fetch_array(mysqli_query($dbcon,"Select * from falkutas WHERE idfalkutas = '$selectfal'"));
        $fal = substr($r['nama_fal'], 9, 2);
        //$getdata = "Select * from matkul ORDER BY idmatkul DESC LIMIT 1";
        //$sql=mysqli_query($dbcon,"Select * from matkul ORDER BY idmatkul DESC LIMIT 1");
        $r1 = mysqli_fetch_array(mysqli_query($dbcon,"Select * from matkul ORDER BY idmatkul DESC LIMIT 1"));
        $idmax = $r1['idmatkul'];
        $nourut = (int) substr($idmax, 3,5);
        $nourut++;
        $IDbaru = 'F'.strtoupper ($fal) . sprintf("%05s", $nourut);
	$cek = $dbcon->query("SELECT * FROM matkul WHERE idjurusan = '$selectjur' AND nama_matkul = '$matkul'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{
		
		$_SESSION['notif'] = "Matakuliah Sudah Ada!!";
		header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
		$sql = $dbcon->query("INSERT into matkul values ('$IDbaru','$selectjur','$selectfal','$matkul')");
		if($sql){
			
			echo "Insert Data Sukses!!";		//Pesan jika proses tambah sukses
			header("Location: {$_SERVER['HTTP_REFERER']}");
		} else{
		$_SESSION['notif'] = "Insert Data Gagal!!";		//Pesan jika proses tambah gagal
		header("Location: {$_SERVER['HTTP_REFERER']}");	//membuat Link untuk kembali ke halaman tambah
		
	}}
}

if(isset($_POST['Input-Edit'])){
	
	//inlcude atau memasukkan file koneksi ke database
	//jika tombol tambah benar di klik maka lanjut prosesnya
//        echo "fuck";
	$nama           = $_POST['nama'];
    $alamat         = $_POST['alamat'];
    $telephone  	= $_POST['telp'];
	$email          = $_POST['email'];
    $user           = $_SESSION['username'];
	$pass           = $_POST['pass'];
    $npass          = $_POST['cpass'];
    $pass = sha1($pass);
    $cek = $dbcon->query("SELECT * FROM login_admin WHERE id = '$user' AND pass = '$pass'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{  
			$errors = array();
		    if($_FILES['image']['size'] > 0){
		    $fileName = $_FILES['image']['name'];
		    $fileSize = $_FILES['image']['size'];
		    $fileType = $_FILES['image']['type'];
	    	$filecontent = addslashes($_FILES['image']['tmp_name']);
	    	$filecontent = file_get_contents($filecontent);
	    	$filecontent = base64_encode($filecontent);

		    $fileType=strtolower(end(explode('.',$_FILES['image']['name'])));
			$expensions= array("jpeg","jpg","png");

			if(in_array($fileType,$expensions)=== false){
			$errors="Format Yang Di UPLOAD Salah!!";
			}elseif ($fileSize > 1457390){
			$errors='File size must be excately 1.5 MB';
			}


			if(empty($errors)==true){
			$r = mysqli_fetch_array(mysqli_query($dbcon,"SELECT * FROM detail_admin WHERE login_admin_id = '".$_SESSION['username']."'"));
 			$cekfhoto = $dbcon->query("SELECT * FROM fhoto_admin WHERE detail_admin_no = '$r[0]' AND detail_admin_login_admin_id = '$r[1]'");
			$cekfhoto1 = mysqli_num_rows($cekfhoto);
			if($cekfhoto1>0){
				$dbcon->query("UPDATE fhoto_admin SET name='$fileName',size='$fileSize',type='$fileType',content='$filecontent' WHERE detail_admin_no='$r[0]'");
			}else{
				$dbcon->query("INSERT into fhoto_admin(name, size, type, content, detail_admin_no, detail_admin_login_admin_id) values ('$fileName', '$fileSize', '$fileType', '$filecontent', '$r[0]', '$r[1]')");
			}}}
            if(empty($npass)==true AND empty($errors)==true)
            {
                $dbcon->query("UPDATE detail_admin SET nama='$nama', alamat='$alamat', hp='$telephone', email='$email' WHERE login_admin_id='$user'");
            	$_SESSION['notif'] = "Update Data Sukses!!";
            	// $_SESSION['notif'] = "a".$fileSize;
            	header("Location: {$_SERVER['HTTP_REFERER']}");
                
            }
            elseif (empty($errors)==true)
            {
                $npass = sha1($npass);
                $dbcon->query("UPDATE detail_admin SET nama='$nama', alamat='$alamat', hp='$telephone', email='$email' WHERE login_admin_id='$user'");
                $dbcon->query("UPDATE login_admin SET pass='$npass' WHERE id='$user'");
                $_SESSION['notif'] = "Update Data Sukses!!";
            	header("Location: {$_SERVER['HTTP_REFERER']}");
            }else{
            	$_SESSION['notif'] = "Data Yang Dimasukan Tidak Valids!!<br>".$errors;
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
			} else {
                $_SESSION['notif'] = "Password Salah!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");
	}
}

if(isset($_POST['Input-Falkutas'])){
	
	//inlcude atau memasukkan file koneksi ke database
	//jika tombol tambah benar di klik maka lanjut prosesnya
//        echo "fuck";
	$falkutas = 'Falkutas ' . $_POST['falkutas'];
//        echo $user." ".$pass;
        $cek = $dbcon->query("SELECT * FROM falkutas WHERE nama_fal = '$falkutas'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{  
            $_SESSION['notif'] = "Data Falkutas Sudah Ada!!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
            $hasil = $dbcon->query("INSERT INTO falkutas(nama_fal) VALUES ('$falkutas')");
            if($hasil)
            {
                $_SESSION['notif'] = "Insert Data Berhasil!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $_SESSION['notif'] = "Insert Data Gagal!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");   
            }
	}
}

if(isset($_POST['Input-Jurusan'])){
	
	//inlcude atau memasukkan file koneksi ke database
	//jika tombol tambah benar di klik maka lanjut prosesnya
//        echo "fuck";
        $falkutas = $_POST['selectfal'];
	$jurusan = $_POST['Jurusan'];
//        echo $user." ".$pass;
        $cek = $dbcon->query("SELECT * FROM jurusan WHERE nama_fal = '$jurusan' AND falkutas_idfalkutas = '$falkutas'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{  
            $_SESSION['notif'] = "Data Jurusan Sudah Ada!!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
            $hasil = $dbcon->query("INSERT INTO jurusan(falkutas_idfalkutas,nama_jur) VALUES ('$falkutas','$jurusan')");
            if($hasil)
            {
                $_SESSION['notif'] = "Insert Data Berhasil!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $_SESSION['notif'] = "Insert Data Gagal!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");   
            }
	}
}

if(isset($_POST['Dosen-Matkul'])){
	
	//inlcude atau memasukkan file koneksi ke database
	//jika tombol tambah benar di klik maka lanjut prosesnya
//        echo "fuck";
        $dosen = $_POST['selectdo'];
        $matkul = $_POST['selectmatkul'];
        $kelas = $_POST['kelas'];
        $month = date('m');
        if($month<6){
           $tahun = date('Y') .'/'.date('Y', strtotime('+1 year'));
        }else
        {
           $tahun = date('Y',strtotime('+1 year')) .'/'.date('Y', strtotime('+2 year'));
        }
//        echo $user." ".$pass;
        $cek = $dbcon->query("SELECT * FROM kelas WHERE matkul_idmatkul = '$matkul' AND kelas = '$kelas' and tahun = '$tahun'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{  
            $_SESSION['notif'] = "Data Kuliah Sudah Ada!!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
            $hasil = $dbcon->query("INSERT INTO kelas(detail_dosen_nik,matkul_idmatkul,kelas,tahun) VALUES ('$dosen','$matkul','$kelas','$tahun')");
            if($hasil)
            {
                $_SESSION['notif'] = "Insert Data Berhasil!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $_SESSION['notif'] = "Insert Data Gagal!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");   
            }
	}
}

if(isset($_POST['Input-Matkul-Mhs'])){
	
	//inlcude atau memasukkan file koneksi ke database
	//jika tombol tambah benar di klik maka lanjut prosesnya
//        echo "fuck";
        $nim = $_POST['selectnim'];
        $falkutas = $_POST['selectfal'];
        $jurusan = $_POST['selectjur'];
        $matkul = $_POST['selectmatkul'];
        $kelas = $_POST['selectkls'];
        
//        echo $user." ".$pass;
        $cek = $dbcon->query("select * from isi_kelas where detail_mhs_nim = '$nim' and kelas_idkelas = '$kelas'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{  
            $_SESSION['notif'] = "Data Kuliah Sudah Ada!!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
            $sql = mysqli_fetch_array(mysqli_query($dbcon,"Select * from kelas WHERE idkelas = '$kelas'"));
            $dosen = $sql['detail_dosen_nik'];
//            echo $nim.' '.$jurusan.' '.$falkutas.' '.$kelas.' APA INI!! '.$dosen.' '.$matkul;
            $hasil = $dbcon->query("INSERT INTO isi_kelas(detail_mhs_nim,detail_mhs_idjurusan,detail_mhs_idfalkutas,kelas_idkelas,kelas_detail_dosen_nik,kelas_matkul_idmatkul) VALUES ('$nim','$jurusan','$falkutas','$kelas','$dosen','$matkul')");
            if($hasil)
            {
                $_SESSION['notif'] = "Insert Data Berhasil!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
            else
            {
                $_SESSION['notif'] = "Insert Data Gagal!!";
                header("Location: {$_SERVER['HTTP_REFERER']}");   
            }
	}
}
$dbcon->close();
?>