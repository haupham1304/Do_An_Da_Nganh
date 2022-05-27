<?php session_start(); ?>
<?php
    require_once ('dbhelp.php');
    if (isset($_SESSION)) {
        $s_user = $_SESSION['user'];   
        $sql = "select * from user where Username = '$s_user'";
        $userList = executeResult($sql);
        $std = $userList[0];
        $ss_id = $std['ID'];
        $ss_name = $std['Name'];
        $ss_bday = $std['Birthday'];
        $ss_pnumber = $std['Phonenumber'];
        $ss_email = $std['Email'];
        $ss_user = $std['Username'];
    }

	$s_name = $s_bday = $s_pnumber = $s_email = $s_user = '';
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

    	$sql = "select * from user where Username = '$s_user'";
    	$userList = executeResult($sql);
        $std = $userList[0];
        $id = $std['ID'];
    	if (strcasecmp($ss_id, $id) != 0){
        	$error['username'] = "Username này đã được sử dụng";
        	echo '<script type="text/javascript">alert("Username này đã được sử dụng")</script>;',
            'window.location = "signup.php";',
            '</script>';
    	}

		$s_name    = str_replace('\'', '\\\'', $s_name);
        $s_bday    = str_replace('\'', '\\\'', $s_bday);
        $s_pnumber = str_replace('\'', '\\\'', $s_pnumber);
		$s_email   = str_replace('\'', '\\\'', $s_email);
		$s_user    = str_replace('\'', '\\\'', $s_user);

		if (empty($error)) {
			$s_newpass = md5($s_newpass);
			$sql = "update user set Name = '$s_name', Birthday = '$s_bday', Phonenumber = '$s_pnumber', Email = '$s_email', Username = '$s_user' where ID = '$ss_id'";
			execute($sql);
			echo '<script type="text/javascript">alert("Chỉnh sửa thông tin thành công");',
				 'window.location = "profile.php";',
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
                        <h1>Thông tin cá nhân</h1>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <form method="post">
                            <label class="label-input" for="name">Họ và tên</label>
                            <input type="text" class="text-input" name="name" id="name" value="<?=$ss_name?>" required="true">
                            <br>
                            <label class="label-input" for="birthday">Ngày sinh</label>
                            <input type="text" class="text-input" name="birthday" id="birthday" value="<?=$ss_bday?>">
                            <br>
                            <label class="label-input" for="phonenumber">Số điện thoại</label>
                            <input type="text" class="text-input" name="phonenumber" id="phonenumber" value="<?=$ss_pnumber?>" required="true">
                            <br>
                            <label class="label-input" for="email">Email</label>
                            <input type="text" class="text-input" name="email" id="email" value="<?=$ss_email?>" required="true">
                            <br>
                            <label class="label-input" for="username">Tên đăng nhập</label>
                            <input type="text" class="text-input" name="username" id="username" value="<?=$ss_user?>" required="true">
                            <br>
                            <input type="submit" class="signup-btn" value="Lưu thông tin">
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