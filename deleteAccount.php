<?php session_start(); ?>
<?php
    require_once('dbhelp.php');
    if(!empty($_POST)){
        $error = array();
        if (isset($_SESSION)){
            $s_user = $_SESSION['user'];   
        }
    	$sql = "select * from user where Username = '$s_user'";
    	$userList = executeResult($sql);
        $std = $userList[0];
        $id = $std['ID'];
        $pass = $std['Password'];
        $s_pass = '';
        if (isset($_POST["confirm-delete"])){
            $s_pass = $_POST['confirm-delete'];
        }
        $s_pass = md5($s_pass);
    	if (strcasecmp($s_pass, $pass) != 0){
        	$error['password'] = "Password bạn nhập không đúng";
        	echo '<script type="text/javascript">alert("Password bạn nhập không đúng");',
            'window.location = "deleteAccount.php";',
            '</script>';
    	}
        if (empty($error)){
            $sql = "delete from user where ID = '$id'";
            execute($sql);
            session_destroy();
			echo '<script type="text/javascript">alert("Xóa tài khoản thành công");',
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
    <link rel="stylesheet" href="./css/delete.css">
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
                        <h3>Bạn có chắc chắn muốn xóa tài khoản?</h3>
                        <br>
                        <h3>Việc này sẽ không thể khôi phục dữ liệu của bạn.</h3>
                        <hr style="width:100%;text-align:left;margin-left:1px; margin-top:40px;">
                        <form method="post">
                            <label class="label-input" for="confirm-delete">Nhập mật khẩu để hoàn tất xóa tài khoản</label>
                            <input type="password" class="text-input" name="confirm-delete" id="confirm-delete" required="true">
                            <br>
                            <div class="modify-form-btn">
                                <a class="decline-btns" href="profile.php" style="margin-right: 50px;">Hủy</a>
                                <input type="submit" class="accept-btns" href="signin.php" style="margin-left: 50px; text-align: center; font-size: 16px;" value="Xác nhận">
                            </div>
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