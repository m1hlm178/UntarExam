<?php
include "../../../database/db_conection.php"; 

        
        
function AutoNumber($falkutas){    
$r1 = mysqli_fetch_array(mysqli_query($dbcon,"Select * from falkutas WHERE idfalkutas = '1'"));
$fal = substr($r1['nama_fal'], 9, 2);
//$getdata = "Select * from matkul ORDER BY idmatkul DESC LIMIT 1";
//$sql=mysqli_query($dbcon,"Select * from matkul ORDER BY idmatkul DESC LIMIT 1");
$r = mysqli_fetch_array(mysqli_query($dbcon,"Select * from matkul ORDER BY idmatkul DESC LIMIT 1"));
$idmax = $r['idmatkul'];
$nourut = (int) substr($idmax, 3,5);
$nourut++;
$IDbaru = 'F'.strtoupper ($fal) . sprintf("%05s", $nourut);
return $fal;
//$dbcon->close();
}

//Sumber: http://phpbejo.blogspot.com/2013/10/membuat-script-fungsi-autonumber-dengan-php.html
//Konten adalah milik dan hak cipta phpbejo.blogspot.com
?>