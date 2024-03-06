<?php
    $host = "161.246.127.24";
    $user = "rootShabu";
    $password = "zR4wiSWmMAa8rV9yhXgQ9ytd";
    $database = "shabu";
    $port = "9060";

    $connect = mysqli_connect($host,$user,$password,$database, $port) or die (mysqli_error($connect));

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($_POST['login-dashboard']) && $username && $password){
        $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connect, $query);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);

            $name = $row['name'];
            $surename = $row['surename'];
            $profile = $row['profile_picture'];

            $_SESSION['admin_name'] = $name;
            $_SESSION['admin_surename'] = $surename;
            $_SESSION['admin_profile'] = $profile;
            Header('Location:dashboard.php');

        }else
            echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง')</script>";
            Header('Refresh:0; url=login.html');
        
    }else{

        Header("Location:login.html");
    }
?>
