<?php session_start(); ?>
<?php
	require_once ('dbhelp.php');

	$u = $p = '';
	if (!empty($_POST)){

        if (isset($_POST['username'])){
			$u = $_POST['username'];
		}
	
		if (isset($_POST['password'])){
			$p = $_POST['password'];
		}

		$p = md5($p);

		$sql = "select * from user where Username = '$u' and Password = '$p'";
		$userList = executeResult($sql);
		if ($userList == NULL){
			echo '<script type="text/javascript">alert("username hoặc password không đúng");',
            'window.location = "signin.php";',
            '</script>';
		}
		else{
			$_SESSION['id'] = "1";
			$_SESSION['user'] = $u;
			$_SESSION['pass'] = $p;
			header('Location: homepage.php');
			die();
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="./css/signin.css">
    </head>
    <body>
        <div class="body-form">
            <div class="left-colum">
                <img class="logo" src="./images/Logo_HCMUT.png" alt="Logo">
            </div>
            <div class="right-colum">
                <h1>Đăng nhập</h1>
                <form method="post">
                    <label class="label-input" for="username">Tên đăng nhập</label>
                    <input type="text" class="text-input" name="username" id="username" required="true">
                    <br>
                    <label class="label-input" for="password">Mật khẩu</label>
                    <input type="password" class="text-input" name="password" id="password" required="true">
                    <br>
                    <div class="forget-password"><a href="#">Quên mật khẩu?</a></div>
                    <br>
                    <input type="submit" class="signin-btn" value="Đăng nhập">
                </form>
                <br>
                <span class="text">Bạn chưa có tài khoản?</span>
                <a href="signup.php" class="sign-up">Đăng ký ngay</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <footer>
            <div class="footer-list">
                <a href="#">Sản phẩm</a>
                <a href="#">Dịch vụ và điều khoản</a>
                <a href="#">Hỗ trợ</a>
                <a href="#">Về chúng tôi</a>
            </div>
        </footer>
    </body>
</html>