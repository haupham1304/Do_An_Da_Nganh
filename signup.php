<?php
    require_once ('dbhelp.php');
	$s_name = $s_bday = $s_pnumber = $s_email = $s_user = $s_pass = $s_repass = '';

	if (!empty($_POST)){

		$error = array();

        if (isset($_POST['name'])){
			$s_name = $_POST['name'];
		}

        if (isset($_POST['birthday'])){
			$s_bday = $_POST['birthday'];
		}

        if (isset($_POST['phonenumber'])){
			$s_pnumber = $_POST['phonenumber'];
		}
	
		if (isset($_POST['email'])){
			$s_email = $_POST['email'];
		}
	
		if (isset($_POST['username'])){
			$s_user = $_POST['username'];
		}
	
		if (isset($_POST['password'])){
			$s_pass = $_POST['password'];
		}
		
        if (isset($_POST['confirm-password'])){
			$s_repass = $_POST['confirm-password'];
		}

        $s_name    = str_replace('\'', '\\\'', $s_name);
        $s_bday    = str_replace('\'', '\\\'', $s_bday);
        $s_pnumber = str_replace('\'', '\\\'', $s_pnumber);
		$s_email   = str_replace('\'', '\\\'', $s_email);
		$s_user    = str_replace('\'', '\\\'', $s_user);
		$s_pass    = str_replace('\'', '\\\'', $s_pass);

        if (strlen($s_user) < 6){
            $error['usernamelen'] = "Username này có chiều dài nhỏ hơn 6 ký tự";
        	echo '<script type="text/javascript">alert("Username này có chiều dài nhỏ hơn 6 ký tự")</script>;</script>';
        }

        $sql = "select * from user where Username = '$s_user'";
    	$userList = executeResult($sql);
    	if ($userList != NULL){
        	$error['username'] = "Username này đã được sử dụng";
        	echo '<script type="text/javascript">alert("Username này đã được sử dụng")</script>;</script>';
    	}

        if (strlen($s_pass) < 6){
            $error['passwordlen'] = "Password này có chiều dài nhỏ hơn 6 ký tự";
        	echo '<script type="text/javascript">alert("Pasword này có chiều dài nhỏ hơn 6 ký tự")</script>;</script>';
        }

		if (strcasecmp($s_pass, $s_repass) != 0){
			$error['password'] = "Confirm password không đúng";
            echo '<script type="text/javascript">alert("Confirm password không đúng")</script>;</script>';
		}

		if (empty($error)){
			$s_pass = md5($s_pass);
			$sql = "insert into user(ID, Name, Birthday, Phonenumber, Email, Username, Password) value('', '$s_name', '$s_bday', '$s_pnumber', '$s_email', '$s_user', '$s_pass')";
			execute($sql);
			echo '<script type="text/javascript">alert("Đăng ký tài khoản thành công");',
				 'window.location = "signin.php";',
				 '</script>';
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
        <title>Đăng ký</title>
        <link rel="stylesheet" href="./css/signup.css">
    </head>
    <body>
        <div class="body-form">
            <h1>Đăng ký</h1>
            <form method="post">
                <label class="label-input" for="name">Họ và tên</label>
                <input type="text" class="text-input" name="name" id="name" required="true">
                <br>
                <label class="label-input" for="birthday">Ngày sinh</label>
                <input type="text" class="text-input" name="birthday" id="birthday">
                <br>
                <label class="label-input" for="phonenumber">Số điện thoại</label>
                <input type="text" class="text-input" name="phonenumber" id="phonenumber">
                <br>
                <label class="label-input" for="email">Email</label>
                <input type="email" class="text-input" name="email" id="email">
                <br>
                <label class="label-input" for="username">Tên đăng nhập</label>
                <input type="text" class="text-input" name="username" id="username" required="true">
                <br>
                <label class="label-input" for="password">Mật khẩu</label>
                <input type="password" class="text-input" name="password" id="password" required="true">
                <br>
                <label class="label-input" for="confirm-password">Nhập lại mật khẩu</label>
                <input type="password" class="text-input" name="confirm-password" id="confirm-password">
                <br>
                <input type="submit" class="signup-btn" value="Đăng ký">
            </form>
            <br>
            <span class="text">Bạn đã có tài khoản?</span>
            <a href="signin.php" class="sign-in">Đăng nhập</a>
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