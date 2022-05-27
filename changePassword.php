<?php session_start(); ?>
<?php
    require_once ('dbhelp.php');
	$s_user = $s_pass = $s_newpass = $s_repass = '';
	if (!empty($_POST)){

        if (isset($_SESSION)){
            $s_user = $_SESSION['user'];   
        }    
		$error = array();
	
		if (isset($_POST['password'])){
			$s_pass = $_POST['password'];
		}

        if (isset($_POST['new-password'])){
			$s_newpass = $_POST['new-password'];
		}
		
        if (isset($_POST['confirm-password'])){
			$s_repass = $_POST['confirm-password'];
		}

        $s_newpass    = str_replace('\'', '\\\'', $s_newpass);
        $s_pass       = str_replace('\'', '\\\'', $s_pass);

        $s_pass = md5($s_pass);
    	$sql = "select * from user where Username = '$s_user'";
    	$userList = executeResult($sql);
        $std = $userList[0];
        $pass = $std['Password'];
    	if (strcasecmp($s_pass, $pass) != 0){
        	$error['password'] = "Password bạn nhập không đúng";
        	echo '<script type="text/javascript">alert("Password bạn nhập không đúng");',
            'window.location = "changePassword.php";',
            '</script>';
    	}

        if (strlen($s_newpass) < 6){
            $error['passwordlen'] = "Password mới có chiều dài nhỏ hơn 6 ký tự";
        	echo '<script type="text/javascript">alert("Pasword mới có chiều dài nhỏ hơn 6 ký tự")</script>;',
            'window.location = "changePassword.php";',
            '</script>';
        }

		if (strcasecmp($s_newpass, $s_repass) != 0){
			$error['password'] = "Confirm password không đúng";
            echo '<script type="text/javascript">alert("Confirm password không đúng");',
            'window.location = "changePassword.php";',
            '</script>';
		}

		if (empty($error)){
			$s_newpass = md5($s_newpass);
			$sql = "update user set Password = '$s_newpass' where Username = '$s_user'";
			execute($sql);
            session_destroy();
			echo '<script type="text/javascript">alert("Đổi mật khẩu thành công");',
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
    <title>Hồ sơ cá nhân</title>
    <link rel="stylesheet" href="./css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/homepage.css">
    <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
    <div class="container">
        <div class="content-body">
            <!-- menu bar bên trái -->
            <div class="menu-bar">
                <h1 class="menu-title">
                    Menu
                </h1>
                <div>
                    <i class="ti-user"></i>
                    <a href="profile.php">
                        <div class="menu-btn">Hồ sơ</div>
                    </a>
                </div>
                <div>
                    <i class="ti-unlock"></i>
                    <a href="changePassword.php">
                        <div class="menu-btn">Đổi mật khẩu</div>
                    </a>
                </div>
                <div>
                    <i class="ti-trash"></i>
                    <a href="deleteAccount.php">
                        <div class="menu-bt">Xóa tài khoản</div>
                    </a>
                </div>
            </div>

            <!-- phần chính bên phải -->
            <div class="main-content">
                <!-- thanh header bên trên -->
                <div class="header-bar">
                    <div class="search-bar">
                        <input type="text" placeholder="Search..">
                    </div>
                    <a href="homepage.php">
                        <div class="header-btn">Trang chủ</div>
                    </a>
                    <a href="#">
                        <div class="header-btn">Về chúng tôi</div>
                    </a>
                    <a href="#">
                        <div class="header-btn">Hỗ trợ</div>
                    </a>
                    <div class="account-btn">
                        <i class="ti-user"></i>
                        <?php
                            require_once ('dbhelp.php');
                            if (isset($_SESSION)){
                                $u = $_SESSION['user'];
                                $p = $_SESSION['pass'];   
                                $sql = "select * from user where Username = '$u' and Password = '$p'";
                                $userList = executeResult($sql);
                                $std = $userList[0];
                                echo '<div class="account-name">'.$std['Name'].'</div>';
                            }
                        ?>
                        <i class="ti-angle-down" onclick="openUserMenu()"></i>
                        <i class="ti-angle-up" onclick="closeUserMenu()"></i>
                    </div>

                    <!-- user menu -->
                    <div class="user-dropdown-menu">
                        <a href="profile.php" class="user-info">Tài khoản của tôi</a>
                        <form method="post" action="logout.php">
                            <button class="logout">Đăng Xuất</button>
                        </form>
                    </div>
                    <!-- <div class="user-menu">
                        <div class="user-btn" id="profile-btn" onclick="window.location = 'profile.php';">
                            Hồ sơ
                        </div>
                        <div class="user-btn" id="logout-btn">
                            Đăng xuất
                        </div>
                    </div> -->
                </div>

                <!-- Phần nội dung và thông báo -->
                <div class="info-and-noti">
                    <div class="info">
                        <h1>Đổi mật khẩu</h1>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <form method="post">
                            <label class="label-input" for="password">Nhập mật khẩu hiện tại</label>
                            <input type="password" class="text-input" name="password" id="password" required="true">
                            <br>
                            <label class="label-input" for="new-password">Nhập mật khẩu mới</label>
                            <input type="password" class="text-input" name="new-password" id="new-password" required="true">
                            <br>
                            <label class="label-input" for="confirm-password">Nhập lại mật khẩu mới</label>
                            <input type="password" class="text-input" name="confirm-password" id="confirm-password" required="true">
                            <br>
                            <input class="accept-btn" onclick="window.location = 'profile.php';"
                                style="font-size: 16px; margin-top: 50px; text-align: center; margin-right: 100px;"
                                value="Hủy">
                            <input type="submit" class="decline-btn" style="font-size: 16px;" value="Xác nhận">
                        </form>
                    </div>

                    <!-- Thông báo -->
                    <div class="noti">
                        <div class="date-time" id="curr-date-time">
                            <h2 id="curr-time">7:00 AM</h2>
                            <h2 id="curr-date">29/04/2022</h2>
                        </div>
                        <div class="noti-card">
                            <div class="noti-description">
                                <div class="noti-title">
                                    Kiểm tra hệ thống
                                </div>
                                <div class="noti-time">
                                    08:00 PM, 12/03/2022
                                </div>
                            </div>
                            <div class="noti-close-btn">X</div>
                        </div>
                        <div class="noti-card">
                            <div class="noti-description">
                                <div class="noti-title">
                                    Đã hoàn thành điều chỉnh nhiệt độ
                                </div>
                                <div class="noti-time">
                                    08:20 PM, 12/03/2022
                                </div>
                            </div>
                            <div class="noti-close-btn">X</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer bên dưới -->
        <div class="footer">
            <a href="#">Sản phẩm</a>
            <a href="#">Dịch vụ và điều khoản</a>
            <a href="#">Hỗ trợ</a>
            <a href="#">Về chúng tôi</a>
        </div>
    </div>
    <script src="./js/userMenu.js"></script>
</body>

</html>