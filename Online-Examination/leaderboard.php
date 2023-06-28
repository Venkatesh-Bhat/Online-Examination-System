<?php
session_start();
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>

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
        background-color: #222;
        font-size: 1.5vw !important;
        display: inline-flex;
        width: 100%;
        color:#ddd;
        position:fixed;
        
    }

    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor: pointer;
    }

    a {
        text-decoration: none;
        color: #fff;
    }
    
    table{
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

   #le{
                margin-bottom: 2vw;
            }
  
</style>

<body style="color: #fff !important;background-image: url(images/dark.png);font-weight:bolder;margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;">
   
        <div  class="navbar">
            <section style="margin: 1.5vw;">LEADERBOARD</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Score</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div>
        <br><br><br><br><br>
<?php 
$sql="call leaderboard;";
$res=mysqli_query($conn,$sql);
if($res)
{
    
    echo "<table id=\"le\"><thead><tr><td>Quiz Title</td><td>Score</td><td>Total Score</td><td>Student name</td><td>Student Mail ID</td></tr></thead>";
    while ($row = mysqli_fetch_assoc($res)) {                
        echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td><td>".$row["name"]."</td><td>".$row["mail"]."</td></tr>"; 
    }
    echo "</table><br><br><br>";
}
else{
    echo mysqli_error($conn);
}
?>
<script>
    function dash(){
        window.location.replace("homestud.php");
    }
    function prof(){
        window.location.replace("profile.php");
    }
    function score(){
        window.location.replace("score.php");
    }
    function lo(){
        alert('Thank You for Using our Online Examination System');
        // session_unset();
        // session_destroy();
        window.location.replace('index.php');
    }
</script>