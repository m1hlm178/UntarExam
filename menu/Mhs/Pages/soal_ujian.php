<?php
session_start();
//include "../ext/func.php";
include "../../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}
$id=htmlspecialchars($_GET['id']);
$getdetail = mysqli_fetch_array(mysqli_query($dbcon,"select * from jadwal_ujian WHERE idjadwal = '".$id."'"));
$_SESSION['edisi']=$getdetail['edisi'];
$_SESSION['idjadwal']=$id;
$start = strtotime($getdetail['mulai']);
$end = strtotime($getdetail['berakhir']);
$detik = $end - $start;
echo $detik .' '. $id .' START '.$getdetail['mulai'].' END '. $getdetail['berakhir'].' BERAKHIR '.$getdata['berakhir'];
?>
<html>
<header>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="Rizal Faizal"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>E-Exam Untar Ujian</title>
<link rel="stylesheet" href="../asset/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="../asset/css/screen2.css" type="text/css"/>
<link rel="stylesheet" href="../asset/css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="../asset/css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="../asset/css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="../asset/css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="../asset/css/visualize-light.css" type="text/css"/>
<!-- Bootstrap Basic CSS -->
<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css"/>
<!-- Bootstrap Core CSS -->
<link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
<!-- JQUERY -->
<script type="text/javascript" src="../asset/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- BootStrap JS -->
<script type="text/javascript" src="../../dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="../asset/js/jquery.visualize.js"></script>
<script type="text/javascript" src="../asset/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="../asset/js/jquery.idtabs.js"></script>
<script type="text/javascript" src="../asset/js/jquery.ui.js"></script>
<script type="text/javascript" src="../asset/js/clock.js"></script>

<script type="text/javascript" src="../asset/js/excanvas.js"></script>
<script type="text/javascript" src="../asset/js/cufon.js"></script>
<script type="text/javascript" src="../asset/js/Geometr231_Hv_BT_400.font.js"></script>


<style type="text/css">
<!--
.style3 {
	color: #62A621;
	font-weight: bold;
}
.garisbawah {
	padding-bottom: 5px;
	border-bottom: 1px dotted #CCC;
}
-->
</style>
<script>
$(window).unload(function () {
	keluar();		
});
var waktunya = <?php echo $detik?>;
console.log(waktunya);
$(window).load(function () { 
	if(waktunya) {
		init();
	}else{
		location.reload();
	}
});
// waktunya = "${TimerTest}";
console.log("woi " +waktunya);
// 	waktunya = 20;
var waktu;
var jalan = 0;
var habis = 0;
var check = 1;
waktunya = waktunya.substring(0, waktunya.length - 2);

function pausetime(){
	check = 0;
}

function init(){
 	console.log(waktunya);
    checkCookie();
    check = 1;
	mulai();
}
function keluar(){
    if(habis==0){
        setCookie('OnlineTime',waktu,365);
    }else{
        setCookie('OnlineTime',0,-1);
    }
	 document.getElementById("formulir").submit();
}
function mulai(){
    jam = Math.floor(waktu/3600);
    sisa = waktu%3600;
    menit = Math.floor(sisa/60);
    sisa2 = sisa%60
    detik = sisa2%60;
    console.log("masuk mulai");
    console.log
    if(detik<10){
        detikx = "0"+detik;
    }else{
        detikx = detik;
    }
    if(menit<10){
        menitx = "0"+menit;
    }else{
        menitx = menit;
    }
    if(jam<10){
        jamx = "0"+jam;
    }else{
        jamx = jam;
    }
    document.getElementById("divwaktu").innerHTML = jamx+" H : "+menitx+" M : "+detikx +" S";
	if(check>0){
		waktu --;
	    if(waktu>0){
	    	console.log(waktu);
	        t = setTimeout("mulai()",1000);
	        jalan = 1;
	    }else{
			selesai();
    }}
}
function selesai(){
	check = 0;
	$('#loaders').addClass('loader');
    if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
    document.getElementById("formulir").submit();
}
function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}

function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function checkCookie(){
    waktuy=getCookie('OnlineTime');
    if (waktuy!=null && waktuy!=""){
        waktu = waktuy;
        console.log("Waktu ada  isi");
    }else{
    	console.log("waktu ada gk isi");
    	console.log("didalam cokkie" + waktunya);
        waktu = waktunya;
        console.log("isinya aja kosong " + waktu);
        setCookie('OnlineTime',waktunya,7);
    }
}

</script>
<script type="text/javascript">
    window.history.forward();
    function noBack(){ window.history.forward(); }
</script>
<!--<script type="text/javascript">
function tombol()
{
document.getElementById("tombol").innerHTML= "<input type=button value=Simpan onclick=selesai()>";
}
</script>-->
</header>
<body>
<div class="sidebar">
		<div class="logo2 clear"><img src="../asset/images/logo.png" alt="" width="185" height="200" /></div>
                    <div class="waktu">
		  <ul><li><a>Sisa Waktu Anda</a>
			  <ul>
				  <div id=divwaktu></div>
			  </ul>
			</li>
                  </ul></div>
</div>


	<div class="main"> <!-- *** mainpage layout *** -->
	<div class="main-wrap">
		<div class="header clear">
		</div>

		<div class="page clear">
			<!-- MODAL WINDOW -->
			<div id="modal" class="modal-window">
				<!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->


			</div>

			<!-- CONTENT BOXES -->
			<!-- end of content-box -->
<div class="notification note-success">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="2%">&nbsp;</td>
      <td width="95%">

<form action=../ext/save_jawaban.php method=post id=formulir>
<br><b class='judul'>Daftar Soal Pilihan Ganda</b><br><p class='garisbawah'></p>
<?php
$getdata = "select a.nilai from nilai a, isi_kelas b, kelas c, jadwal_ujian d where a.isi_kelas_no = b.no and b.kelas_idkelas = c.idkelas and c.idkelas = d.kelas_idkelas and d.idjadwal = '$id' and a.isi_kelas_detail_mhs_nim = '".$_SESSION['username']."'";
$cek = $dbcon->query($getdata);
$cek1 = mysqli_num_rows($cek);
if($cek1>0)
{
        $_SESSION['notif'] = "Anda Sudah Mengikuti Ujian!!";	//Pesan jika proses tambah sukses
        echo "<script> location.replace('../index.php?p=lihat_ujian'); </script>";
} else
{
$soal = "select a.nosoal,a.soal,a.q1,a.q2,a.q3,a.q4,a.q5 from bank_soal a, soal_ujian b where b.bank_soal_nosoal = a.nosoal and b.jadwal_ujian_idjadwal = '".$id."' order by rand()";
$sql=mysqli_query($dbcon,$soal);
$jumlah=mysqli_num_rows($sql);
$i = 1;
while ($r = mysqli_fetch_array($sql)) {
?>
    <input type="hidden" name="id[]" value=<?php echo $r[0];?>>
    <input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
    <tr><td rowspan=5><h3><?php echo $i;?></h3></td><td><h3><?php echo $r[1];?></h3></td></tr>
    <tr><td><input type="radio" name="pg[<?php echo $r[0];?>]" value="A">A. <?php echo $r['2'];?></td></tr>
    <tr><td><input type="radio" name="pg[<?php echo $r[0];?>]" value="B">B. <?php echo $r['3'];?></td></tr>
    <tr><td><input type="radio" name="pg[<?php echo $r[0];?>]" value="C">C. <?php echo $r['4'];?></td></tr>
    <tr><td><input type="radio" name="pg[<?php echo $r[0];?>]" value="D">D. <?php echo $r['5'];?></td></tr>
    
<?php
$i++;
}
}
$dbcon->close();
?>
    </table>

<br><p class='garisbawah'></p>
<center>
<button class="btn btn-primary" type="submit" onclick="selesai()" name="Finish-Ujian" id="Simpan" class="btn btn-primary btn-block">Simpan</button>
</center>
</form>
</td>
      <td width="3%">&nbsp;</td>
    </tr>
  </table>
</div>
			<div class="clear">
				<!-- end of content-box -->

		</div><!-- end of page -->

		<div class="footer clear"></div>
	</div>
	</div>
</div>
</body>

<meta http-equiv="content-type" content="text/html;charset=UTF-8">
</body>
</html>