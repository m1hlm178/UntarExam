<?php
//mulai proses tambah data
session_start();
include "../../../database/db_conection.php"; 
set_include_path(get_include_path() . PATH_SEPARATOR . 'Excel/Classes/');
include 'PHPExcel/IOFactory.php';
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
}elseif (isset($_POST['Upload-Soal'])) {
        $dosen      = $_SESSION['username'];
        $falkutas   = $_POST['selectfal'];
        $jurusan    = $_POST['selectjur']; 
        $matkul     = $_POST['matkul'];
        $soaluji    = $_POST['selectsoal'];
        $soaltype   = $_POST['selecttype'];

        if(!empty($_FILES['excelupload']['name']))
        {
            echo "masuk";
            //print_r($_FILES['excelupload']);
            $namearr = explode(".",$_FILES['excelupload']['name']);
            if(end($namearr) != 'xls' && end($namearr) != 'xlsx')
            {
            echo '<p> Invalid File </p>';
            $invalid = 1;
            }
            if($invalid != 1)
            {
            $target_dir = "Excel/upload/";
            $target_file = $target_dir . basename($_FILES["excelupload"]["name"]);
            $response = move_uploaded_file($_FILES['excelupload']['tmp_name'],$target_file); // Upload the file to the current folder
            if($response)
            {
            try {
                echo "masuk ke dua";
            $objPHPExcel = PHPExcel_IOFactory::load($target_file);
            } catch(Exception $e) {
            die('Error : Unable to load the file : "'.pathinfo($_FILES['excelupload']['name'],PATHINFO_BASENAME).'": '.$e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            //print_r($allDataInSheet);
            $arrayCount = count($allDataInSheet); // Total Number of rows in the uploaded EXCEL file
            //echo $arrayCount;
            $string = "INSERT INTO bank_soal (detail_dosen_nik,matkul_idmatkul,matkul_idjurusan,matkul_idfalkutas,soal,q1,q2,q3,q4,q5,ans,type_soal,edisi,tanggal) VALUES ";

            for($i=7;$i<=$arrayCount;$i++){

            $soal= trim($allDataInSheet[$i]["B"]);
            $A = trim($allDataInSheet[$i]["C"]);
            $B = trim($allDataInSheet[$i]["D"]);
            $C = trim($allDataInSheet[$i]["E"]);
            $D = trim($allDataInSheet[$i]["F"]);
            $E = trim($allDataInSheet[$i]["G"]);
            $jawaban = trim($allDataInSheet[$i]["H"]);


            $string .= "('".$dosen."' , '".$matkul ."','".$jurusan."','".$falkutas."','".$soal."','".$A."','".$B."','".$C."','".$D."','".$E."','".$jawaban."','".$soaltype."','".$soaluji."',now()),";
            }
            $string = substr($string,0,-1);
            echo $string;
            echo "Batas";
            echo "";
            echo "";

            // mysql_query($string); // Insert all the data into one query
             if(false===$dbcon->query($string)){
                // echo  $dbcon->error;
                $_SESSION['notif'] = "Upload Gagal";        //Pesan jika proses tambah gagal
                header("location:../index.php?p=index");    //   membuat Link untuk kembali ke halaman tambah
                unlink($target_file);
            }else{
                $_SESSION['notif'] = "Upload Sukses";        //Pesan jika proses tambah gagal
                header("location:../index.php?p=index");
                unlink($target_file);
            }
            }
            }else{
                $_SESSION['notif'] = "Upload Gagal<br> File Harus Berbentuk Excel";        //Pesan jika proses tambah gagal
                header("location:../index.php?p=index");
            }
        }else{
                $_SESSION['notif'] = "Upload Gagal";        //Pesan jika proses tambah gagal
                header("location:../index.php?p=index");
        }
}
$dbcon->close();
?>