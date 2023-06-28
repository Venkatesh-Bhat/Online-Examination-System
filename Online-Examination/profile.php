<?php
session_start();
// require_once 'homestud.php';
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}

$type1 = $_SESSION["type"];
$username1 = $_SESSION["username"];
$sql = "select * from " . $type1 . " where mail='{$username1}'";
$res =   mysqli_query($conn, $sql);
if ($res == true) {
    global $dbmail, $dbpw;
    while ($row = mysqli_fetch_array($res)) {
        $dbmail = $row['mail'];
        $dbname = $row['name'];
        if ($type1 == 'student') {
            $dbusn = $row['usn'];
        }
        else{
            $dbusn = $row['staffid'];
        }
        $dbphno = $row['phno'];
        $dbgender = $row['gender'];
        $dbdob = $row['DOB'];
        $dbdept = $row['dept'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Examination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
         <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<style>

li {
        margin: 1.5vw;
        font-size: 1.5vw !important;
        color:#bbb;
    }

    ul {
        list-style: none;
        width: auto !important;
        font-weight: 2vw !important;
    }

    .navbar {
        background-image: url("./images/header.png") !important;
        font-size: 1.5vw !important;
        display: inline-flex;
        width: 100%;
        color:#ddd;
        position:fixed;
        
    }
    /* .navbar>ul{
        display: inline-flex;
        background-color:#222;
        width:100vw;
        position:fixed;
    } */
    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor: pointer;
    }
    /* .navbar>ul>li>a:hover {
        color: #042A38;
        text-decoration: underline;
        font-weight: bold !important;
    } */

     
    .prof,#score{
        top: 3vw;
        position: fixed;
            width: 50vw !important;
            margin-left: 25vw !important;
            margin-right: 25vw !important;
            /* background-color: #ffffffab !important; */
            background-image: url("./images/header.png");
            border-radius: 50px;
            margin-top: 10vw;
            z-index: 1;
            padding: 1vw;
            padding-left: 2vw;
            color: #ddd;
            border:1px solid white;
        }
    @media screen and (max-width: 450px) {
        .navbar {
            display: initial !important;

        }

        .navbar>ul {
            display: initial !important;
            left: 25vw !important;
            text-align: center;
            right: 25vw !important;
        }

        .navbar>ul>li {
            background-color: orange !important;
        }

        section {
            text-align: center;
            margin-top: 0 !important;
            background-color: orange !important;
            width: 100vw;
            margin: 0 !important;
        }
        p{
            color:#042A38 !important;
        }
        
    }

  
</style>

<body style="color: #fff !important;font-weight:bolder;margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;background-image: url(images/dark.png);height: 100%;">
    
        <div  class="navbar">
            <section style="margin: 1.5vw;font-weight:bold;"><?php echo $dbname ?></section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <!-- <li onclick="prof()">profile</li> -->
                <li onclick="score()">Score</li>
                <li onclick="leader()">Leaderboard</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div>
 
        <section class="prof" id="prof">
                <center>
                <i class="material-icons w3-xxxlarge" style="color: #fff;">person</i>
                <hr>
                <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
                <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
                <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
                <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
               <p><b>USN&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
                <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
                <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
                <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
    </center>
        </section>

        <script>
            // if($type1=="student"){

            
    function dash(){
        window.location.replace("homestud.php");
    }
    function leader(){
        window.location.replace("leaderboard.php");
    }
    function score(){
        window.location.replace("score.php");
    }

    // else{
    //     function dash(){
    //         window.location.replace("homestaff.php");
    //     }
    // }
    function lo(){
        alert('Thank You for Using our Online Examination System');
        // session_unset();
        // session_destroy();
        window.location.replace('index.php');
    }

</script>
</html>