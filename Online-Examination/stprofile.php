<html>

<head>
    <title>
        Onine examination System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
         <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<?php
session_start();
// require_once 'sql.php';
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $type1 = $_SESSION["type"];
    $username1 = $_SESSION["username"];
    $sql = "select * from " . $type1 . " where mail='{$username1}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbmail, $dbpw, $dbusn;
        while ($row = mysqli_fetch_array($res)) {
            $dbmail = $row['mail'];
            $dbname = $row['name'];
            $dbusn = $row['staffid'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
        }
    }
}
?>
<style>
 li {
        margin: 1.5vw;
        font-size:1.5vw;
        color:#bbb;
    }

    ul {
        list-style: none;
        width: auto !important;
    }

    .navbar {
        /* background-color: #fff!important; */
        background-image: url(./images/header.png) !important;
        font-size: 1.5vw;
        display: inline-flex;
        width: 100%;
        color:#ddd;
        position:fixed;
    }

    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor:pointer;

    }
    .prof{
        top: 3vw;
        position: fixed;
        width: 50vw !important;
        margin-left: 25vw !important;
        margin-right: 25vw !important;
        /* background-color: #fff!important; */
        background-image: url("./images/header.png");
        /* display: none !important; */
        border-radius: 10px;
        margin-top: 10vw;
        z-index: 1;
        padding: 1vw;
        padding-left: 2vw;
        color: #ddd;
        border:1px solid white;
        
    }

</style>

<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;height:auto;background-image:url('./images/dark.png');">
    <!-- <div id="main" style="background-image:url('./images/dark.png');height: auto;color:#fff !important"> -->

        <div class="navbar">
            <section style="margin: 1.5vw;height:2vw"><?php echo $dbname?></section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="lead()">Leaderboard</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div>
<br><br>

<center>
<section class="prof" id="prof" >
<i class="material-icons w3-xxxlarge" style="color: #fff;">person</i>
                <hr>
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>STAFF ID.&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
            <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
            <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
            <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </section>
</center>


<script>
    function dash(){
        window.location.replace('homestaff.php');
    }
    function score(){
        window.location.replace('quizz.php');
    }
    function lead(){
        window.location.replace('stleaderboard.php');
    }
    function lo(){
    alert("Thank You for Using our Online Examination System");
    //session_unset();
//session_destroy();
    window.location.replace("index.php");
    }
    </script>

</html>