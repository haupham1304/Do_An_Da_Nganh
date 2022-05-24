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
        <title>Trang chủ</title>
        <!-- <script src="./js/showLoading.js"></script>
        <script src="./js/jquery/jquery-1.11.3.min.js"></script> -->
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
                        <i class="ti-user"></i>
                        <a href="profile.php">
                            <div class="menu-btn">Tài khoản</div>
                        </a>
                    </div>
                    <div>
                        <i class="ti-settings"></i>
                        <a href="setting.php">
                            <div class="menu-btn">Cài đặt</div>
                        </a>
                    </div>
                    <div>
                        <i class="ti-notepad"></i>
                        <a href="record.php">
                            <div class="menu-btn">Hồ sơ hệ thống</div>
                        </a>
                    </div>
                    <div>
                        <i class="ti-support"></i>
                        <a href="guide.php">
                            <div class="menu-bt">Hướng dẫn sử dụng</div>
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
                        <a href="homepage.php"><div class="header-btn">Trang
                                chủ</div></a>
                        <a href="#"><div class="header-btn">Về chúng tôi</div></a>
                        <a href="#"><div class="header-btn">Hỗ trợ</div></a>
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
                            <div class="user-btn" id="profile-btn"
                                onclick="window.location= 'profile.php';">
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
                                <div class="sensor-temp">
                                    Nhiệt độ: <span id="temp">{{tempNow}} &deg;C</span>
                                </div>
                                <div class="sensor-humidity">
                                    Độ ẩm là: <span id="humidity">{{hummidNow}}
                                        %</span>
                                </div>
                                <div class="last-update">Đã cập nhật lúc <span
                                        class="datetime">{{lastTime}}</span></div>
                            </div>

                            <div class="info-btns">
                                <a href="" ng-click="check()"><div
                                        class="check-btn">Kiểm tra ngay</div></a>
                                <a href="changeTemperature.php"><div
                                        class="modify-btn">Điều chỉnh ngay</div></a>
                            </div>
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
                                        style="font-size:22px; padding-bottom: 10px;">
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
                        $scope.tempNow="";
                        $scope.hummidNow="";
                        $scope.lastTime="";
                        $scope.check=function(){
                            $http.get('http://127.0.0.1:5000/check').
                         success(function(data, status, headers, config) {
                             getData();
                             takeTime();
                        }).
                        error(function(data, status, headers, config) {
                        });
                        }
                        function getData(){
                            $http.get('http://127.0.0.1:5000/check1').
                         success(function(data, status, headers, config) {
                            
                            $scope.listTemp=JSON.parse(data["temp"]);
                            $scope.listHummid=JSON.parse(data["hummid"]);
                            var date= new Date($scope.listTemp[0].created_at);
                            var s=checkTime(date.getSeconds());
                            var m=checkTime(date.getMinutes());
                            var h=checkTime(date.getHours());
                            var d=checkTime(date.getDate());
                            var M= checkTime((date.getMonth() + 1));
                            var y=date.getFullYear();
                            var timeN= d+ "/" + M + "/" + y +"   "+h+ ":" + m+":"+s;
                            $scope.listTemp[0].value=Math.round($scope.listTemp[0].value * 100) / 100 ;
                            $scope.listHummid[0].value=Math.round($scope.listHummid[0].value * 100) / 100 ;
                            $scope.lastTime=timeN;
                            $scope.tempNow=$scope.listTemp[0].value;
                            $scope.hummidNow=$scope.listHummid[0].value;
                        }).
                        error(function(data, status, headers, config) {
                        });
                        }
                        getData();
                    });
            </script>
        </div>
        <script src="./js/userMenu.js"></script>
    </body>
</html>
