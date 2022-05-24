<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.17/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Thiết bị</title>
    <link rel="stylesheet" href="./css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/homepage.css">
</head>

<body ng-app="myapp" ng-controller="recordController" id="content_body" onload="startTime(); startTime1()">
    <div class="container">
        <div class="content-body">
            <!-- menu bar bên trái -->
            <div class="menu-bar">
                <h1 class="menu-title">
                    Menu
                </h1>
                <div>
                    <i class="ti-settings"></i>
                    <a href="setting.php">
                        <div class="menu-btn">Cài đặt chung</div>
                    </a>
                </div>
                <div>
                    <i class="ti-bell"></i>
                    <a href="reminder.php">
                        <div class="menu-btn">Nhắc nhở</div>
                    </a>
                </div>
                <div>
                    <i class="ti-harddrives"></i>
                    <a href="device.php">
                        <div class="menu-bt">Thiết bị</div>
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
                        <div class="sensor-info">
                            <div class="sensor-temp_1">
                                ID
                            </div>
                            <div class="sensor-temp_2">
                                Sensor
                            </div>
                            <div class="sensor-temp_3">
                                Trạng Thái
                            </div>
                            <div class="sensor-temp_4">
                                Thời Gian
                            </div>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <div class="info-btns">
                            <div class="info_1">
                                ICD_01
                            </div>
                            <div class="info_2">
                                ICD 12C
                            </div>
                            <div class="info_3">
                                Đang kết nối
                            </div>
                            <div class="info_4">
                                21/04/22, 10:01PM
                            </div>
                            <button class="snip1457_disconnet"> Ngắt kết nối </button>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <div class="info-btns">
                            <div class="info_1">
                                BUZ_01
                            </div>
                            <div class="info_2">
                                BUZZER
                            </div>
                            <div class="info_3">
                                Không kết nối
                            </div>
                            <div class="info_4">
                                21/04/22, 10:01PM
                            </div>
                            <button class="snip1457_connet"> Kết nối </button>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <div class="info-btns">
                            <div class="info_1">
                                LED_01
                            </div>
                            <div class="info_2">
                                A 2-CL SINGLE LED
                            </div>
                            <div class="info_3">
                                Không kết nối
                            </div>
                            <div class="info_4">
                                21/04/22, 10:01PM
                            </div>
                            <button class="snip1457_connet"> Kết nối </button>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <div class="info-btns">
                            <div class="info_1">
                                DHT_01
                            </div>
                            <div class="info_2">
                                DHT11
                            </div>
                            <div class="info_3">
                                Không kết nối
                            </div>
                            <div class="info_4">
                                21/04/22, 10:01PM
                            </div>
                            <button class="snip1457_connet"> Kết nối </button>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">

                        <div class="info-btns">
                            <div class="info_1">
                                RC_01
                            </div>
                            <div class="info_2">
                                RELAY CIRCUIT
                            </div>
                            <div class="info_3">
                                Đang kết nối
                            </div>
                            <div class="info_4">
                                21/04/22, 10:01PM
                            </div>
                            <button class="snip1457_disconnet"> Ngắt kết nối </button>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">
                        <div class="info-btns">
                            <div class="info_1">
                                MP_01
                            </div>
                            <div class="info_2">
                                MINI PUMP
                            </div>
                            <div class="info_3">
                                Không kết nối
                            </div>
                            <div class="info_4">
                                21/04/22, 10:01PM
                            </div>
                            <button class="snip1457_connet"> Kết nối </button>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:1">
                    </div>

                    <!-- Thông báo -->
                    <div class="noti" style="overflow: auto;">
                        <div class="date-time" id="curr-date-time" style="margin-bottom: 20px;">
                            <h2 id="curr-time"></h2>
                            <h3 id="curr-date"></h3>
                        </div>
                        <h3 style="margin-bottom: 20px;">Thông tin kiểm tra hệ thống</h3>
                        <div ng-repeat="noti in notices">
                            <div class="noti-description">
                                <div class="noti-time"
                                    style="font-size:22px;padding-bottom: 10px;">
                                    - {{noti.created_at}}
                                </div>
                            </div>
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
        <script>
            function startTime() {
                const today = new Date();
                let h = today.getHours();
                let m = today.getMinutes();
                let s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('curr-date').innerHTML =  h + ":" + m + ":" + s;
                setTimeout(startTime, 1000);
            }
            function startTime1() {
                const today = new Date();
                let d = today.getDate();
                let m = today.getMonth()+1;
                let y = today.getFullYear();
                m = checkTime(m);
                d = checkTime(d);
                document.getElementById('curr-time').innerHTML =  d + "/" + m + "/" + y;
                setTimeout(startTime, 8640000000);
            }
            function checkTime(i) {
                if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                return i;
            }
            angular.module("myapp", [])
                .controller("recordController", function($scope,$http) {
                    $scope.userName = "Phạm Công Hậu";
                    $scope.notices=[];
                    function checkTime(i) {
                        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                        return i;
                    }   
                    function takeTime(){
                    $http.get('http://127.0.0.1:5000/time').
                     success(function(data, status, headers, config) {
                        $scope.notices=JSON.parse(data["time"]);
                        console.log($scope.notices);
                        for(var i=0;i<$scope.notices.length;i++){
                            var date= new Date($scope.notices[i].created_at);
                            var s=checkTime(date.getSeconds());
                            var m=checkTime(date.getMinutes());
                            var h=checkTime(date.getHours());
                            var d=checkTime(date.getDate());
                            var M= checkTime((date.getMonth() + 1));
                            var y=date.getFullYear();
                            var timeN= d+ "/" + M + "/" + y +"   "+h+ ":" + m+":"+s;
                            $scope.notices[i].created_at=timeN;
                        }
                    }).
                    error(function(data, status, headers, config) {
                    });
                    }
                
                    takeTime();
                    $scope.tempNow="33";
                    $scope.hummidNow="85";
                    $scope.lastTime="21/5/2022 10:28:28";
                    $scope.check=function(){
                        $http.get('http://127.0.0.1:5000/check').
                     success(function(data, status, headers, config) {
                        //  jQuery("#content-body").showLoading();
                         takeTime();
                        //  jQuery("#content-body").hideLoading();
                    }).
                    error(function(data, status, headers, config) {
                    });
                    }
                    // jQuery("#content-body").hideLoading();
                });
        </script>
    </div>
    <script src="./js/userMenu.js"></script>
</body>

</html>