<?php require('conn.php');?>
<?php

session_start();
  
      $user = $_POST["username"];
      $pass = $_POST["password"];
      
      $login = $mysqli->query("SELECT * FROM login WHERE username = '$user' AND password='$pass'");
      $res = mysqli_fetch_assoc($login);
     
      if ($_SESSION['MM_Username'] || $_COOKIE["user"])
     {
         header("Location:autologin.php");
         exit;
     }
     /*autologin end*/ 
      if(isset($_POST["submit"]))
     {
 
            if($res)
            {
                if(!empty($_POST["remember"]))
                {
                    setcookie ("user", $user, time() + (86400 * 30 * 30), "/");
                    setcookie ("pass", $pass, time() + (86400 * 30 * 30), "/");
                }
                else
                {
                    if(isset($_COOKIE["user"]))
                    {
                        setcookie ("user", "");
                    }
                    if(isset($_COOKIE["pass"]))
                    {
                        setcookie ("pass", "");
                    }
                }
            }
            else
            {
                $msg = "Invalid Username or Password";
            }
        
            if($res["role"] == "administrator")
            {
                $_SESSION['MM_Username'] = $res['username'];
                $_SESSION['role'] = $res["role"];
                $_SESSION['password'] = $res["password"];
                header('Location:dashboard.php');
            }
            else if($res["role"] == "regional admin")
            {
            $_SESSION['MM_Username'] = $res['username'];
            $_SESSION['role'] = $res["role"];
            $_SESSION['password'] = $res["password"];
            header('Location:adminAFM/regional_admin.php');
            }
            else if($res["role"] == "rider")
            {
            $_SESSION['MM_Username'] = $res['username'];
            $_SESSION['role'] = $res["role"];
            $_SESSION['password'] = $res["password"];
            header('Location:riderAFM/profileRider.php');
            }
            else if($res["role"] == "ss")
            {
            $_SESSION['MM_Username'] = $res['username'];
            $_SESSION['role'] = $res["role"];
            $_SESSION['password'] = $res["password"];
            header('Location:supervisorAFM/index.php');
            }
            else if($res["role"] == "Senior Courier")
            {
            $_SESSION['MM_Username'] = $res['username'];
            $_SESSION['role'] = $res["role"];
            $_SESSION['password'] = $res["password"];
            header('Location:supervisorAFM/index.php');
            }
            else if($res["role"] == "dump")
            {
            $_SESSION['MM_Username'] = $res['username'];
            $_SESSION['role'] = $res["role"];
            $_SESSION['password'] = $res["password"];
            header('Location:fetchUser.php');
            }
            else if($res["role"] != "administrator" && $res["role"] != "ss" && $res["role"] != "rider" && $res["role"] != "dump")
            {
            header('Location:index.php?message=fail');
            }
                   
     }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Icon Offshore</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/img/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginFile/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginFile/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginFile/css/util.css">
	<link rel="stylesheet" type="text/css" href="loginFile/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('loginFile/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					<img src="assets/img/apple-icon.png" class="img-thumbnail img-fluid">
					Account Login
				</span>
				<form action="<?php echo $loginFormAction; ?>" role="form" method="POST" name="prosesLogin" class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="row">
			          <div class="col-8">
			            <div class="icheck-primary">
			              <input type="checkbox" id="remember">
			              <label for="remember">
			                Remember Me
			              </label>
			            </div>
			         </div>

					<div class="container-login100-form-btn m-t-32">
						<input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Log In">
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="loginFile/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="loginFile/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="loginFile/vendor/bootstrap/js/popper.js"></script>
	<script src="loginFile/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="loginFile/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="loginFile/vendor/daterangepicker/moment.min.js"></script>
	<script src="loginFile/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="loginFile/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>