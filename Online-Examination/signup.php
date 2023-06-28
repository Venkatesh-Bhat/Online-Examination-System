<html>

<head>
    <title>Online Examination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<?php
require 'phpmailer/src/Exception.php'; 
require 'phpmailer/src/PHPMailer.php'; 
require 'phpmailer/src/SMTP.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['studsu'])) {
    session_start();
    if (isset($_POST['name1']) && isset($_POST['usn1']) && isset($_POST['mail1']) && isset($_POST['phno1']) && isset($_POST['dept1']) && isset($_POST['dob1']) && isset($_POST['gender1']) && isset($_POST['password1']) && isset($_POST['cpassword1'])) {
        // require_once 'sql.php';
        $conn = mysqli_connect("localhost","root","","online_examination");
               if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name1 = mysqli_real_escape_string($conn, $_POST['name1']);
        $usn1 = mysqli_real_escape_string($conn, $_POST['usn1']);
        $mail1 = mysqli_real_escape_string($conn, $_POST['mail1']);
        $phno1 = mysqli_real_escape_string($conn, $_POST['phno1']);
        $dept1 = mysqli_real_escape_string($conn, $_POST['dept1']);
        $dob1 = mysqli_real_escape_string($conn, $_POST['dob1']);
        $gender1 = mysqli_real_escape_string($conn, $_POST['gender1']);
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $cpassword1 = mysqli_real_escape_string($conn, $_POST['cpassword1']);
        $password1 = crypt($password1,"a3e7i11o23u79");
        $cpassword1 = crypt( $cpassword1,"a3e7i11o23u79");
        if ($password1 == $cpassword1) {

            $sql=$conn->query("select mail, usn from student where mail='$mail1' or usn='$usn1'");
            if ($sql->num_rows==0) {
            // $sql = "insert into student (usn,name,mail,phno,dept,gender,DOB,pw) values('$usn1','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$password1')";
            $otp = mt_rand(100000, 999999);

            $_SESSION["otp"] = $otp;

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
            $mail->addAddress($mail1);
            // $mail->addReplyTo('osesvit2021@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'VERIFICATION';
            $mail->Body = '<center>
            <div style="width:100%;background-color:#222;color: #fff;height:auto; ">
            <div style="background-color:#000;width:100%;color:#fff;height:auto;">
            <hr>
            <h1>Hello ' . $name1 . '<br></h1>
            <hr></div>
            <br>
            <p style="color:#fff;">
            Here is your verification code</p> <h1>' . $otp . '</h1>
            <br>
            <p style="color:#fff;">Do not share this verification code with anyone. 
            <br><br><br>Thank You<br>
            <hr>
            Online Examination System
            <br><br>
            <a href="mailto:mailproject75@gmail.com">Contact Us</a></p></div></center>';
            if ($mail->send()) {
                $_SESSION["name1"] = $name1;
                $_SESSION["usn1"] = $usn1;
                $_SESSION["mail1"] = $mail1;
                $_SESSION["phone1"] = $phno1;
                $_SESSION["dob1"] = $dob1;
                $_SESSION["gen1"] = $gender1;
                $_SESSION["pw1"] = $password1;
                $_SESSION["dept"] = $dept1;
                echo "<script>
                alert(\"OTP has been sent to your gmail\");
            window.location.replace(\"verify.php\");</script>";
            }
        }
        //     if (mysqli_query($conn, $sql)) {
        //         echo "<script>
        //         alert('successful!');
        //         window.location.replace(\"index.php\");</script>";
        //         session_destroy();
             else {
                echo "<script>
                alert('Data entered by you already exists in Database please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert(' Password should be same');
                window.location.replace(\"signup.php\");</script>";
            session_destroy();
        }
    }
}

if (isset($_POST['staffsu'])) {
    session_start();
    if (isset($_POST['name2']) && isset($_POST['staffid']) && isset($_POST['mail2']) && isset($_POST['phno2']) && isset($_POST['dept2']) && isset($_POST['dob2']) && isset($_POST['gender2']) && isset($_POST['password2']) && isset($_POST['cpassword2'])) {

        $conn = mysqli_connect("localhost", "root", "", "online_examination");
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name2 = mysqli_real_escape_string($conn, $_POST['name2']);
        $usn2 = mysqli_real_escape_string($conn, $_POST['staffid']);
        $mail2 = mysqli_real_escape_string($conn, $_POST['mail2']);
        $phno2 = mysqli_real_escape_string($conn, $_POST['phno2']);
        $dept2 = mysqli_real_escape_string($conn, $_POST['dept2']);
        $dob2 = mysqli_real_escape_string($conn, $_POST['dob2']);
        $gender2 = mysqli_real_escape_string($conn, $_POST['gender2']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $cpassword2 = mysqli_real_escape_string($conn, $_POST['cpassword2']);
        $password2 = crypt($password2, "a3e7i11o23u79");
        $cpassword2 = crypt($cpassword2, "a3e7i11o23u79");
        if ($password2 == $cpassword2) {
            $sql = $conn->query("select mail, staffid from staff where mail='$mail2' or staffid='$usn2'");
            if ($sql->num_rows == 0) {
                // $sql = "insert into student (usn,name,mail,phno,dept,gender,DOB,pw) values('$usn1','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$password1')";
                $otp = mt_rand(100000, 999999);

                $_SESSION["otp"] = $otp;

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                // $mail->Username = $_POST["email1"];
                $mail->Username = 'mailproject75@gmail.com';
                // $mail->Password = $_POST["pass1"];
                $mail->Password = 'inuomzynloofihvu';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('mailproject75@gmail.com');
                $mail->addAddress($mail2);
                // $mail->addReplyTo('osesvit2021@gmail.com');
                $mail->isHTML(true);
                $mail->Subject = 'VERIFICATION';
                $mail->Body = '<center>
                <div style="width:100%;background-color:#222;color: #fff;height:auto; ">
                <div style="background-color:#000;width:100%;color:#fff;height:auto;">
                <hr>
                <h1>Hello ' . $name2 . '<br></h1>
                <hr></div>
                <br>
                <p style="color:#fff;">
                Here is your verification code</p> <h1>' . $otp . '</h1>
                <br>
                <p style="color:#fff;">Do not share this verification code with anyone. 
                <br><br><br>Thank You<br>
                <hr>
                Online Examination System
                <br><br>
                <a href="mailto:mailproject75@gmail.com">Contact Us</a></p></div></center>';
                if ($mail->send()) {
                    $_SESSION["name1"] = $name2;
                    $_SESSION["usn2"] = $usn2;
                    $_SESSION["mail1"] = $mail2;
                    $_SESSION["phone1"] = $phno2;
                    $_SESSION["dob1"] = $dob2;
                    $_SESSION["gen1"] = $gender2;
                    $_SESSION["pw1"] = $password2;
                    $_SESSION["dept"] = $dept2;
                    echo "<script>
                    alert(\"OTP has been sent to your gmail\");
                window.location.replace(\"verify.php\");</script>";
                }
            }
            // $sql = "insert into staff (staffid,name,mail,phno,dept,gender,DOB,pw) values('$usn2','$name2','$mail2','$phno2','$dept2','$gender2','$dob2','$password2')";
            // if (mysqli_query($conn, $sql)) {
            //     echo "<script>
            //     alert('successful!');
            //     window.location.replace(\"index.php\");</script>";
            //     session_destroy();
            // } else {
            //         echo "<script>
            //         alert('Data enter by you alreay exist in Database please Sign In');
            //         window.location.replace(\"index.php\");</script>";
            //         session_destroy();
            //     }
            // }
            else {
                echo "<script>
                alert('Data entered by you already exists in Database please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
            }else {
                echo "<script>
                alert(' Password should be same');
                window.location.replace(\"signup.php\");</script>";
                session_destroy();
            }
        }
    }
?>

<style>
    button {
        height: 4vw;
        width: 30vw;
        margin: 0px;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bolder;
        outline: none;
        background-color: #bbb;
        color: #ff4545;
        border: 1px solid #fff;
        cursor:pointer;
    }

    button:active {
        background-color: #bbb;
        color: #222;
    }

    button:hover,button:focus {
        background-color: #ff4545;
        color:#ddd;
    }

    .stud,
    .staff {
        display: none;
    }

    label {
        color:#222;
        float: left;
        margin-left: 15vw;
        font-weight: bolder;
        font-family: 'Times New Roman', Times, serif;
    }

    .l {
        font-weight: bolder;
        font-size: 1vw;
        margin-left: 15vw;
        margin-right: auto;
        color:#222;
        padding:2px 1px 2px 1px;
        cursor:pointer;
    }
    .l:hover{
        color:#ddd;
    }

    input,
    .selc {
        width: 30vw !important;
        outline: none;
        height: 3vw;
        border: 2px solid black;
        border-radius: 10px;
        padding: 1vw;
    }

    .gen {
        width: 2vw !important;
    }
    .bg {
        background-size: 100%;
    }
    form>button {
        width: 20vw;
        height: 2vw;
    }
    a{
        color: #042A38;
        margin: 2vw;
    }
    .su {
        width: 15vw !important;
        background-color: #222;
        margin-bottom: 1vw;
        color:#fff;
        border-color: #000;
        padding: 2px 0px 2px 0px;
    }

    .su:hover{
        background-color:#fff;
        color:#222;
    }

    .formname {
        text-shadow: 2px 0px black;
        font-weight: bolder;
        color:#222;
    }

    @media screen and (max-width: 620px) {

        input,
        .selc {
            height: 5vw !important;
        }
    }
    input[type="radio"]#Black{
        accent-color:#000;
    }
</style>

<body style="margin: 0;padding: 0;outline: none;background-image: url(images/dark.png);">
    <!-- <div style="font-family: 'Courier New', Courier, monospace;margin: 0;padding: 0;background-color: #fff;height: 100%;width: 100%;padding-bottom: 5vw;height: auto !important;background-repeat: no-repeat;background-size:cover;"> -->
        <center>
            <h1 class="w3-container" style=" background-image: url(./images/header.png);background-repeat: repeat-x;text-transform: uppercase;width: auto;padding: 1vw;color:#fff;margin:0;">ONLINE Examination System</h1>
        </center>
        <div class="seluser">
            <center> <button onclick="stud()">STUDENT</button><button onclick="staff()">STAFF</button>
        </center>
        </div>
        <div class="stud" id="stud">
            <center>

                <form name="student" method="POST" style="width: 60vw;background-color:#ffffffab;"><br>
                    <h1 class="formname">Sign-Up as Student</h1><br><br>
                    <label for="name1">Name</label><br>
                    <input type="text" name="name1" required><br><br>
                    <label for="usn">USN</label><br>
                    <input type="text" name="usn1" required><br><Br>
                    <label for="mail1">Email</label><br>
                    <input type="email" name="mail1" required><br><Br>
                    <label for="phno1">Ph No.</label><br>
                    <input type="tel" name="phno1" required><br><Br>
                    <label for="dept1">Department</label><br>
                    <select name="dept1" class="selc" required>
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="MEC">MEC</option>
                        <option value="CIV">CIV</option>
                    </select><br><br>
                    <label for="dob1">DOB</label><br>
                    <input type="date" name="dob1" required><br><Br>
                    <label for="gender1">Gender</label><br>
                    <label class="l"><input id="Black" type="radio" name="gender1" value="M" class="gen" required style="height: 1vw !important;">MALE</label>
                    <label class="l"><input id="Black" type="radio" name="gender1" value="F" class="gen" required style="height: 1vw !important;">FEMALE</label><br><Br>
                    <label for="password1">Password</label><br>
                    <input type="password" name="password1" required><br><Br>
                    <label for="cpassword1">Confirm Password</label><br>
                    <input type="password" name="cpassword1" required><br><Br>
                     <input type="submit" class="su" name="studsu" value="Sign-Up as Student">
                </form>

            </center>
        </div>
        <div class="staff" id="staff">
            <center>

                <form name="staffSIGNUP" method="POST" style="width: 60vw;background-color:#ffffffab;"><br>

                    <h1 class="formname">Sign-Up as Staff</h1><br><br><label for="name">Name</label><br>
                    <input type="text" name="name2" required><br><br>
                    <label for="staffid">Staff Id</label><br>
                    <input type="text" name="staffid" required><br><Br>
                    <label for="mail2">Email</label><br>
                    <input type="email" name="mail2" required><br><Br>
                    <label for="phno2">Ph No.</label><br>
                    <input type="tel" name="phno2" required><br><Br>
                    <label for="dept2">Department</label><br>
                    <select name="dept2" class="selc" required>
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="MEC">MEC</option>
                        <option value="CIV">CIV</option>
                    </select><br><br> <label for="dob2">DOB</label><br>
                    <input type="date" name="dob2" required><br><Br>
                    <label for="gender2">Gender</label><br>
                    <label class="l">
                        <input id="Black" type="radio" name="gender2" value="M" class="gen" required style="height: 1vw !important;">MALE
                    </label>
                    <label class="l">
                        <input id="Black" type="radio" name="gender2" value="F" class="gen" required style="height: 1vw !important;">FEMALE
                    </label><br><Br>
                    <label for="password2">Password</label><br>
                    <input type="password" name="password2" required><br><Br>
                    <label for="cpassword2">Confirm Password</label><br>
                    <input type="password" name="cpassword2" required><br><Br>
                    <input type="submit" name="staffsu" class="su" value="Sign-Up as Staff">
                </form>
            </center>
        </div>
        <center><a href="index.php" style="color:#fff !important;">Cancel</a></center>
    <!-- </div> -->
</body>
<script>
    function stud() {
        document.getElementById('stud').style = "display:initial";
        document.getElementById('staff').style = "display:hidden";
    }

    function staff() {
        document.getElementById('stud').style = "display:hidden";
        document.getElementById('staff').style = "display:initial";
    }
</script>

</html>