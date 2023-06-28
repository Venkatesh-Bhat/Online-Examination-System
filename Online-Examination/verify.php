<html>
<?php session_start();
$name1=$_SESSION["name1"];


$mail1=$_SESSION["mail1"];
$phno1=$_SESSION["phone1"];
$dob1=$_SESSION["dob1"];
$gender1=$_SESSION["gen1"];
$password1=$_SESSION["pw1"];
$dept1=$_SESSION["dept"];
$otp=$_SESSION["otp"];
?>
<head>
    <title>Online Examination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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
        padding-left: 2vw;
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
        background-color: #042A38 !important;
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
        border-radius: 40px;
        display: block;
        border:2px solid black;
    }

    .ip{
        height: 3vw;
        width: 10vw;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bolder;
        font-size: 1.3vw;
        border-radius: 10px;
        border: 2px solid black;
        background-color:#222;
        color:#ddd;
    }

    .ip:hover{
        background-color:#ddd;
        color:#222;
    }

    a{
        color:#222;
    }
    a:hover{
        color:#ddd;
    }

</style>
<body style="background-image: url(./images/dark.png);">
<div class="bg" style="font-weight: bolder;padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: 100%;">
        <center>
            <h1 class="w3-container" style=" background-image: url(./images/header.png);background-repeat: repeat-x;text-transform: uppercase;width: auto;padding: 1vw;color:#fff;margin:0">ONLINE Examination System</h1>
    </center>
        <center>
            <div class="login">
                <div id="subcode">
                    <form method="post">
                        <label for="otp" style="text-transform: uppercase;font-size:22px;">Enter the Code</label><br><br>
                        <input type="number" name="otp1" placeholder="code" class="inp" required><br><br>
                        <input name="submit1" class="sub ip" type="submit" value="Verify">
                        <br><br>
                    </form>
                </div>
                <a href="signup.php">CANCEL</a>

            </div>
    </div>
    </center>
    </div>

</body>

<?php
if (isset($_POST['submit1'])) {
    // require_once 'sql.php';
    $conn = mysqli_connect("localhost","root","","online_examination");
            if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
            }
        else{
        if (isset($_POST['submit1'])) {
                $usercode1 = $_POST['otp1'];
            if ($usercode1 == $otp) {
                    echo '<script>alert("User Verified!!");</script>';
                if (isset($_SESSION["usn1"])) {
                    $usn1=$_SESSION["usn1"];
                    $sql = "insert into student (usn,name,mail,phno,dept,gender,DOB,pw) values('$usn1','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$password1')";
                }
                else{
                    $usn2 = $_SESSION["usn2"];
                    $sql = "insert into staff (staffid,name,mail,phno,dept,gender,DOB,pw) values('$usn2','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$password1')";
                }
                    $res=mysqli_query($conn,$sql);
                if($res===true){
                    session_unset();
                                    // session_destroy();
                                    // header("location:index.php");
                    echo "<script>
                    window.location.replace(\"index.php\");
                    </script>";
                                    
                                }
                                else{
                                    echo "<script>alert('Security code error');</script>";
                                }
                            }else{
                                echo '<script>alert("security code doesn\'t match");</script>';
                            }
                        } else {
                            echo '<script>alert("Please enter the Code");</script>';

                        }
                    }
}
?>



</html>