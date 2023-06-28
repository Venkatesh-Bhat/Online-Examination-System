

<html>

<head>
    <title>
        Onine examination System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    }

    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor:pointer;

    }
    table{
        width: 90vw;
        margin-left: 5vw;
        margin-right: 5vw;
        align-content: center;
        border: 1px solid white;
        margin-top:5vw;
    }
    thead{
        font-weight:900;
        font-size: 1.5vw;
    }
    td{
        width: auto;
        border: 1px solid #ddd;
        text-align: center;
        height: 4vw;
        font-weight: bold;
        background-image:url("./images/header.png");
   }


</style>

<body style="margin: 0 !important;font-weight: bolder !important;
background-image:url(./images/dark.png);font-family: 'Courier New', Courier, monospace;height:auto;color:#fff">
    <div id="main" style="height: auto;color:#fff !important">
        <div class="navbar" style="display: inline-flex;width: 100%;color:#ddd;position:fixed;">
            <section style="margin: 1.5vw;">LIST OF QUIZ'S ADDED</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="lead()">Leaderboard</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br> 




<section id="score">
    <br>
            <?php 
            $sql ="select * from quiz where mail='{$username1}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                
                echo "<table id=\"sc\"><thead><tr><td>Quiz id</td>&nbsp;<td>Quiz Title</td><td>Created on</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizid"]."</td><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td></tr>"; 
                }
                echo "</table>";
            }
            ?>
        </section>
    </body>
<script>
    function dash(){
        window.location.replace('homestaff.php');
    }
    function prof(){
        window.location.replace('stprofile.php');
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