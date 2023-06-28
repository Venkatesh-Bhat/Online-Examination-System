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
    .prof,#score{
        top: 3vw;
        position: fixed;
            width: 50vw !important;
            margin-left: 25vw !important;
            margin-right: 25vw !important;
            /* background-color: #ffffffab !important; */
            background-image: url("./images/header.png");
            display: none !important;
            border-radius: 10px;
            margin-top: 2vw;
            z-index: 1;
            padding: 1vw;
            padding-left: 2vw;
            color: #ddd;
            border:1px solid white;
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
            }
            #le{
                margin-bottom: 2vw;
            }
  
</style>

<body style="color: #fff !important;font-weight:bolder;margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;background-image: url(images/dark.png);">
    
        <div  class="navbar">
            <section style="margin: 1.5vw;">ONLINE EXAMINATION SYSTEM</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <!-- <li onclick="dash()">Dashbord</li> -->
                <li onclick="prof()">profile</li>
                <li onclick="score()">Score</li>
                <li onclick="leader()">Leaderboard</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div> 
        <br>
        <br>
        <?php
        $type1 = $_SESSION["type"];
        $username1 = $_SESSION["username"];
        $sql = "select * from " . $type1 . " where mail='{$username1}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbmail = $row['mail'];
                $dbname = $row['name'];
                $dbusn = $row['usn'];
                $dbphno = $row['phno'];
                $dbgender = $row['gender'];
                $dbdob = $row['DOB'];
                $dbdept = $row['dept'];
            }
        }
        ?>
        <center><section style="width:100vw;margin:0vw;margin-top:5vw;font-size:3vw;">Welcome&nbsp;<?php echo $dbname ?></section></center>
        <section style="color:#fff !important"><br><br><br>
        <?php 
            $sql ="select * from quiz";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size:2vw;\">Take any Quiz</h1></center>";
                echo "<center><table><thead><tr><td>Quiz Title</td><td>Created on</td><td>Created By</td><td>  </td></tr></thead>";
            while ($row = mysqli_fetch_assoc($res)) {

                echo "<style>
                        a{
                            color:#ddd;

                        }
                        a:hover{
                            color:#222;
                        }
                </style>
                    ";
                $quiz = $row["quizid"];
                $sql1 = $conn->query("select mail,quizid from score where mail='$username1' and quizid='$quiz'");
                if ($sql1->num_rows==0) {

                    echo "<tr><td>" . $row["quizname"] . "</td><td>" . $row["date_created"] . "</td><td>" . $row["mail"] . "</td><td><a id=\"tq\" href='takeq.php?qid=" . $row['quizid'] . "'>Take Quiz</tr>";
                }
                else{
                    echo "<tr><td>" . $row["quizname"] . "</td><td>" . $row["date_created"] . "</td><td>" . $row["mail"] . "</td><td><a id=\"tq\" href='takeq.php?qid=" . $row['quizid'] . "'>Restart</tr>";
                }
            }
                echo "</table></center>";
            }
        ?>
        

</body>

<script>
function leader(){
        window.location.replace("leaderboard.php");
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


</html>