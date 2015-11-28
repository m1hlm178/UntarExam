<?php 
include "./database/db_conection.php";

if(isset($_POST['login']))  
{   
    
    $user_id=$_POST['username'];  
    $user_pass=sha1($_POST['password']);  
    
    if(is_numeric($user_id))  {
       if (strlen($user_id)<=8) {
            $check_user="select * from login_dosen WHERE id='$user_id'AND pass='$user_pass'";
            $status=1;
        }
        else {
            $check_user="select * from login_mhs WHERE id='$user_id'AND pass='$user_pass'";
            $status=2;
        }
    }
    else  {
        $check_user="select * from login_admin WHERE id='$user_id'AND pass='$user_pass'";
        $status=3;  
    }
    $run=mysqli_query($dbcon,$check_user);  
    if(mysqli_num_rows($run)) {  
        session_start();
        // $_SESSION['pesan'] = 'Username or Password is incorrect!';
        $_SESSION['username']=$user_id;
        $_SESSION['password']=$user_pass;
        if($status==1) {
            header("location:./menu/Dosen/index.php");
        } elseif ($status==2) {
            header("location:./menu/Mhs/index.php");
        } elseif ($status==3) {
            header("location:./menu/Admin/index.php");
            // echo "MASUK";
        }  
    }
    else  {
        session_start();
        $_SESSION['notiflogin'] = 'Username atau Password Anda Salah!!';
        // echo '<script>window.location="index.php"</script>';
        header("location:index.php");
        // echo "<script>alert('Username or Password is incorrect!')</script>";
    }  
}
?>