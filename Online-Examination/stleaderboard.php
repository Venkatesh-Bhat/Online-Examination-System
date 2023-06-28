<html>

<head>
    <title>
        Online examination System
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
}
?>
<style>

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
        background-image: url(./images/header.png);
   }
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
</style>

<body style="margin: 0 !important;font-weight: bolder !important;background-image:url(./images/dark.png);font-family: 'Courier New', Courier, monospace;height:auto;color:#fff">
    <div id="main" style="height: auto;color:#fff !important">
        <div class="navbar" style="display: inline-flex;width: 100%;color:#ddd;position:fixed;">
            <section style="margin: 1.5vw;">LEADERBOARD</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashboard</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br> 

    <section style="color:#fff !important">
            <?php
            $sql="select quizname,s.name,score,totalscore from student s,staff st,score sc,quiz q where q.quizid=sc.quizid and s.mail=sc.mail and q.mail=st.mail and q.mail='{$username1}' ORDER BY score DESC";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size: 3vw\">Leaderboard</h1></center>";
                echo "<table id=\"le\"><thead><tr><td>Quiz Title</td>&nbsp;<td>Student name</td><td>score obtained</td><td>Max Score</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["name"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td></tr>"; 
                }
                echo "</table><br><br>";
            }
            else{
                echo mysqli_error($conn);
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
    function score(){
        window.location.replace('quizz.php');
    }
    function lo(){
        alert("Thank You for Using our Online Examination System");
    //session_unset();
//session_destroy();
    window.location.replace("index.php");
    }
</script>
</html>