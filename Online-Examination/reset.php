<?php
  /*Import PHPMailer classes into the global namespace
                   // These must be at the top of your script, not inside a function
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\SMTP;
                    use PHPMailer\PHPMailer\Exception;*/
 session_start(); ?>
<html>
<head>
    <title>ONLINE EXAMINATION SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
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
        width: 30vw;
        height: 3vw;
        border-radius: 10px;
        border: 2px solid black;
        padding-left: 2.4vw;
        font-weight: bolder;
        outline: none;
    }

    ::placeholder {
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
    }

    label {
        font-weight: bolder;
    }

    button:hover {
        background-color:#fff !important;
    }

    .bg {
        background-size: 100%;
    }

    .login {
        width: 40vw;
        background-color:#ffffffab;
        padding: 2vw;
        font-weight: bolder;
        margin-top: 6vh;
        border-radius: 10px;
        display: block;
    }

    .lab{
        color:#222;
        font-size:1.5vw;
        padding:1vw 3vw 1vw 2vw;
    }
    .lab:hover{
        color:#ddd;
    }

    .input-icons i {
        position: absolute;
    }

    .input-icons {
        width: 100%;
        margin-bottom: 10px;
    }

    .icon {
        padding: 7px 12px 0px 0px;
        color: #222;
        min-width: 50px;
        text-align: center;
    }

    .ip{
        height: 3vw;
        width: 10vw;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bolder;
        border-radius: 10px;
        border: 2px solid black;
        background-color: #222;
        color:#ddd;
    }
    .ip:hover{
        background-color:#ddd;
        color:#222;
    }

    a {
        color: #222;
        margin-left: 2vw;
        margin-right: 2vw;
        font-size: 17px;
    }
    a:hover{
        color:#ddd;
    }
</style>
<?php global $message;?>
<body style="margin:0;height: 100%;ouline:none;color: #042A38f !important;padding-botton:5vw;">
    <div class="bg" style="font-weight: bolder;background-image: url(./images/dark.png);padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: auto;">
        <center>
        <h1 class="w3-container" style=" background-image: url(./images/header.png);background-repeat: repeat-x;text-transform: uppercase;width: auto;padding: 1vw;color:#fff;margin:0;">ONLINE Examination System</h1>
        </center>
        <center>
            <div class="login">
                <div id="getcode" style="display: initial">
                    <form method="POST">
                        <h1>Reset Password</h1>
                        <hr>
                        <div class="seluser">
                           <label class="lab">
                             <input type="radio" name="usertype" value="student" required>STUDENT
                           </label>
                           <label class="lab">
                            <input type="radio" name="usertype" value="staff" required>STAFF
                           </label>
                        </div><br>
                        <input name="code" id="usercode1" value="" style="display:none;">
                        <div class="signin">

                            <div class="input-icons">
                                <i class="material-icons icon" style='color: #222;'>mail</i>
                                <input type="email" name="email1" placeholder="Email" class="inp" required>
                            </div>
                            <br>

                            <div class="input-icons">
                                <i class="material-icons icon" style='color: #222;'>lock</i>
                                <input type="password" name="pass1" placeholder="New Password" class="inp" required>
                            </div>
                            <br>

                            <div class="input-icons">
                                <i class="material-icons icon" style='color: #222;'>lock</i>
                                <input type="password" name="cpass1" placeholder="Confirm Password" class="inp" required>
                            </div>
                            <br>

                            <input name="submit" class="sub ip" type="submit" value="Get the Code">
                    </form><br><br>
                </div>
                <a href="signup.php">SIGN UP</a> &nbsp;&nbsp; <a href="index.php">Cancel</a>

            </div>
    </div>
    </center>
    </div>
</body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php'; 
require 'phpmailer/src/PHPMailer.php'; 
require 'phpmailer/src/SMTP.php'; 
if (isset($_POST['submit'])) {
    if (isset($_POST['email1']) && isset($_POST['pass1']) && isset($_POST['cpass1'])) {
        // require_once 'sql.php';
        $conn = mysqli_connect("localhost","root","","online_examination");
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $username = mysqli_real_escape_string($conn, $_POST['email1']);
        $password = mysqli_real_escape_string($conn, $_POST['pass1']);
        $password = crypt($password,"a3e7i11o23u79");
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass1']);
        $cpassword = crypt($cpassword,"a3e7i11o23u79");
        if ($password === $cpassword) {
            $sql = "select * from " . $type . " where mail='{$username}'";
            $res =   mysqli_query($conn, $sql);
            if ($res == true) {
                global $dbmail, $dbpw;
                while ($row = mysqli_fetch_array($res)) {
                    $dbmail = $row['mail'];
                    $dbname = $row['name'];
                }
                if ($dbmail === $username) {
                    $otp = mt_rand(100000, 999999);
                    // require 'PHPMailer.php'; 
                    $mail = new PHPMailer;
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    // $mail->Username = $_POST["email1"];
                    $mail->Username='your-gmail-id';
                    // $mail->Password = $_POST["pass1"];                        // SMTP password
                    $mail->Password = 'app-password-key of your gmail id';
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                    $mail->setFrom('your-gmail-id');
                    $mail->addAddress($dbmail);
                    // $mail->addReplyTo('osesvit2021@gmail.com');
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset your Online Examination system password';
                    $mail->Body = '<center><div style="width:100%;background-color:#042A38;color: #fff;height:auto; "><h1>Hello ' . $dbname . '<br></h1><br>here is your security code to reset the password <h1>' . $otp . '</h1><br>  don\'t share security code with any one. <br><br><br>Thank You<br>Online Examination System<br><br><a href="mailto:venkatesh.20cs102@sode-edu.in">Contact Us</a></div></center>';
                    if ($mail->send()) {
                        $_SESSION["otp"]=$otp;
                        $_SESSION["username"]=$dbmail;
                        $_SESSION["pw"]=$password;
                        $_SESSION["type"]=$type;
                        // header("location: updatepw.php");
                        echo "<script>
                        window.location.href='updatepw.php'
                        </script>";
                    } else {
                       // $mail->ErrorInfo;
                       echo "<script>alert('Error')</script>";
                    }
                } else {
                    echo "<script>alert('not a user ,Please Sign up');</script>";
                }
            }
        } else {
            echo "<script>alert('Both password should be same');</script>";
        }
    }
}
?>
</html>