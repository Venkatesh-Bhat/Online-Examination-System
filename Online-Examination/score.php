<?php
session_start();
// require_once 'homestud.php';
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
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
        top:0vw;
        background-image: url("./images/header.png") !important;
        background-color: #222;
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

    a {
        text-decoration: none;
        color: #fff;
    }
    #score{
        top: 8vw;
        /* position:fixed; */
            width: 100% !important;
            /* margin-left: 25vw !important; */
            margin-right: 25vw !important;
            /* background-color: #ffffffab !important; */
            background-image: url("./images/header.png");
            /* display: none !important; */
            border-radius: 20px;
            margin-top: 5vw;
            z-index: 1;
            padding: 1vw;
            /* padding-left: 2vw; */
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
    table{
        padding:5vw;
        width: 90vw;
        margin-left: 5vw;
        margin-right: 5vw;
        align-content: center;
        border: 1px solid white;
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

    #tq{
        text-decoration: underline;
        border: 3px solid #ddd;
        padding: 0.5vw;
        border-radius: 10px;
        background-color:#222;
    }

    #tq:hover{
        border:3px solid #222;
        background-color: #ddd;
    }
    #sc{
        width: 100% !important;
        margin: 0%;
        color: #ddd;
        position:center;
            }
#le{
                margin-bottom: 2vw;
            }
  
</style>

<body style="color: #fff !important;font-weight:bolder;margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;background-image: url(images/dark.png)">
        <div  class="navbar">
            <section style="margin: 1.5vw;">PERSONAL SCORE</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <!-- <li onclick="score()">Score</li> -->
                <li onclick="leader()">Leaderboard</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div>

    <section id="score">
        <?php 
            $username1 = $_SESSION["username"];
            $sql ="select * from score,quiz where score.mail='{$username1}' and score.quizid=quiz.quizid";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<table id=\"sc\"><thead><tr><td>Quiz Title</td><td>Score Obtained</td><td>Total Score</td><td>Remarks</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {   
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td><td>".$row["remark"]."</tr>"; 
                }
                echo "</table>";
            }
            else{
                echo " ".mysqli_error($conn);
            }
            ?><br><br><br>
    </section>
    <script>
    function dash(){
        window.location.replace("homestud.php");
    }
    function leader(){
        window.location.replace("leaderboard.php");
    }
    function prof(){
        window.location.replace("profile.php");
    }
    function lo(){
        alert('Thank You for Using our Online Examination System');
        // session_unset();
        // session_destroy();
        window.location.replace('index.php');
    }
</script>
</html>