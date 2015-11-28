<?php
session_start();
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
if(isset($_POST['Input-Edit'])){
	
	//inlcude atau memasukkan file koneksi ke database
	//jika tombol tambah benar di klik maka lanjut prosesnya
//        echo "fuck";
	$nama           = $_POST['nama'];
        $telephone  	= $_POST['telp'];
	$email          = $_POST['email'];
        $user           = $_SESSION['username'];
	$pass           = $_POST['pass'];
        $npass          = $_POST['cpass'];
        $pass = sha1($pass);
//        echo $user." ".$pass;
        $cek = $dbcon->query("SELECT * FROM login_mhs WHERE id = '$user' AND pass = '$pass'");
	$cek1 = mysqli_num_rows($cek);
	if($cek1>0)
	{  
            if(empty($npass))
            {
                $dbcon->query("UPDATE detail_mhs SET nama='$nama', telephone='$telephone', email='$email' WHERE nim='$user'");
            
//                echo '<script> alert("PTEST!!");</script>';
            }
            else
            {
                $npass = sha1($npass);
                $dbcon->query("UPDATE detail_mhs SET nama='$nama', telephone='$telephone', email='$email' WHERE nim='$user'");
                $dbcon->query("UPDATE login_mhs SET pass='$npass', firsttime='NO' WHERE id='$user'");
            }
            $_SESSION['notif'] = "Update Data Sukses!!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
	} else {
            $_SESSION['notif'] = "Password Salah!!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
		
	}
}
$dbcon->close(); 
?>