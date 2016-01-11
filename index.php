<?php
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
    <title>E-Exam Login</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/login.css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <section class="container login-form">
        <section>
            <form method="POST" action="login.php" role="login">
                <img src="assets/img/logo.png" alt="" class="img-responsive" />
                <div class="form-group">
                    <?php
                        //        menampilkan pesan jika ada pesan
                        if (isset($_SESSION['notiflogin']) && $_SESSION['notiflogin'] <> '') {
                            echo '<div class="notiflogin">'.$_SESSION['notiflogin'].'</div>';
                        }
                        //        mengatur session pesan menjadi kosong
                        $_SESSION['notiflogin'] = '';
                    ?>
                    <input type="text" name="username" required class="form-control" placeholder="Username" />
                </div>
                <div class="input-group">
                    <input type="password" name="password" required class="form-control" placeholder="Password" />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="tooltip" data-toggle="tooltip" data-placement="top" title="Forgot password ?">?</button>
                    </span>
                </div>
                
                <a href="./login.php"><button type="submit" name="login" class="btn btn-primary btn-block">Login Now</button>
            </form>
        </section>
    </section>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
    <!--
    $( document ).ready(function() {
        $('#tooltip').tooltip();
    });
    -->
    // Pesan Login
    //            angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
            $(document).ready(function(){setTimeout(function(){$(".notiflogin").fadeIn('slow');}, 500);});
    //            angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
            setTimeout(function(){$(".notiflogin").fadeOut('slow');}, 3000);
    </script>

</body>
</html>