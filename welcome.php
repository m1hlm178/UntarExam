<?php  
session_start();  
  
if(!$_SESSION['username'])  
{  
  
    header("Location: index.php");//redirect to login page to secure the welcome page without login access.  
}  
  
?>  
  
<html>  
<head>  
  
    <title>  
        Registration  
    </title>  
</head>  
  
<body>  
<h1>Welcome</h1><br>  
<?php  
echo $_SESSION['username'];  
?>  
  
  
<h1><a href="logout.php">Logout here</a> </h1>  
  
  
</body>  
  
</html>  