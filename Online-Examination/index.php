<?php 
session_start(); 
// $error="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Examination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" SameSite=Strict>
         <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" SameSite=Strict>
</head>
<?php
        if (isset($_POST['login'])) {
            if (isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['pass'])) {
                //  require_once('sql.php');
                // $host=$_POST['host'];
                $user=$_POST["username"];
                // $project=$_POST["project"];
                $ps=$_POST["pass"];
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
                    echo "<script>alert(\"Database error retry after some time !\")</script>";
                }
                $type = mysqli_real_escape_string($conn, $_POST["usertype"]);
                $username = mysqli_real_escape_string($conn, $_POST["username"]);
                $password = mysqli_real_escape_string($conn, $_POST["pass"]);
                $password = crypt($password, 'a3e7i11o23u79');
                $sql = "select * from " . $type . " where mail='{$username}'";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    global $dbmail, $dbpw;
                    while ($row = mysqli_fetch_array($res)) {
                        $dbpw = $row['pw'];
                        $dbmail = $row['mail'];
                        $_SESSION["name"] = $row['name'];
                        $_SESSION["type"] = $type;
                        $_SESSION["username"] = $dbmail;
                    }
                    if ($dbpw === $password) {
                        if ($type === 'student') {
                            header("location:homestud.php");
                        } elseif ($type === 'staff') {
                            header("Location: homestaff.php");
                        }
                    } elseif ($dbpw !== $password && $dbmail === $username) {
                        echo "<script>alert('password is wrong');</script>";
                    } elseif ($dbpw !== $password && $dbmail !== $username) {
                        echo "<script>alert('username name not found sing up');</script>";
                    }
                }
            }
        }
        ?>
<style>
    @media screen and (max-width: 620px) {
        input {
            height: 6vw !important;
        }
        .seluser {
            display: grid;
        }

        .sub {
            width: 20vw !important;
        }
    }
    .inp {
        box-sizing: content-box !important;
        width: 30vw;
        height: 3vw;
        border-radius: 10px;
        border: 2px solid black;
        padding-left: 2.3vw;
        font-weight: bolder;
        outline: none;
    }
    ::placeholder {
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
    }

    label {
        font-weight: bolder;
        cursor:pointer;
        font-size: 1.5vw;
        margin-left: 2vw;
        margin-right: 2vw;
        color:#222;
    }
    label:hover{
        color:#ddd;
    }

    form {
        font-size: 1.5vw;
        margin: 0;
    }

    button:hover {
        background-color: #fff !important;
    }

    .bg {
        background-size: 100%;
    }

    a {
        color: #222;
        margin-left: 2vw;
        margin-right: 2vw;
    }
    a:hover{
        color:#ddd;
    }
    .login{
			max-height: 70vh;
		}

    .input-icons i {
        position: absolute;
    }

    .input-icons {
        width: 100%;
        margin-bottom: 10px;
    }

    .icon {
        padding: 10px 12px 0px 0px;
        color: #222;
        min-width: 50px;
        text-align: center;
    }

    .login{
        height: 3vw;
        width: 10vw;
        font-family:'Courier New', Courier, monospace;
        font-weight: bolder;
        border-radius: 10px;
        border: 2px solid black;
        background-color:#222; 
        color:#ddd;
    }

    .login:hover{
        background-color: #ddd;
        color:#222;
    }
    input[type='radio']#Black{
        accent-color:#222;
    }

</style>

<body style="margin:0;height: 100%;ouline:none;background-image: url(./images/dark.png);color: #042A38f !important;padding-botton:5vw;">
    <div class="bg" style="font-weight: bolder;padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: auto;">
        <center>
            <h1 class="w3-container" style=" background-image: url(./images/header.png);background-repeat: repeat-x;text-transform: uppercase;width: auto;padding: 1vw;color:#fff;margin:0;">ONLINE Examination System</h1>
        </center>
        <center>
            <div class="w3-card" class="login" style="width: 40vw;background-color: #ffffffab;border: 2px solid black;padding: 2vw;font-weight: bolder;margin-top: 10vh;border-radius: 40px;">
                <form action="index.php" method="POST">

                <i class="material-icons w3-jumbo" style="color: #222;">person</i>
                <hr>
                    <div class="seluser">
                        
                        <label><input id='Black' type="radio" name="usertype" value="student" required>STUDENT</label>
                        <label><input id='Black' type="radio" name="usertype" value="staff" required>STAFF</label>
                    </div><br>
                    <div class="signin">

                    <div class="input-icons">
                        <i class="material-icons icon" style='color: #222;'>mail</i>
                        <input type="email" name="username" placeholder="Email" class="inp" required>
                    </div>
                        <br>

                        <div class="input-icons">
                        <i class="material-icons icon" style='color: #222;'>lock</i>
                        <input type="password" name="pass" placeholder="Password" class="inp" required>
                        </div>
                        <br>

                        <input name="login" class="sub login" type="submit" value="Login"><br>

                </form><br>
                <a href="reset.php">Forgot password?</a> &nbsp;
                <a href="signup.php">SIGN UP</a>
            </div>
    </div>
    </center>
    </div>
    
</body>

</html>