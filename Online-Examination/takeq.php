<html>

<head>
    <title>
        Online Examination System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
// require_once 'sql.php';
global $score;
$score = 0;
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>
<script>
                    var seconds = $time;
                    function secondPassed() {
                    var minutes = Math.round(( seconds - 30)/60);
                    var remainingSeconds = seconds % 60;
                    if (remainingSeconds < 10) {
                        remainingSeconds = '0' + remainingSeconds; 
                    }
                    document.getElementById('countdown').innerHTML = minutes + ':' +    remainingSeconds;
                    if (seconds == 0) {
                        clearInterval(countdownTimer);
                        document.getElementById('countdown').innerHTML = 'Buzz Buzz';
                    } else {    
                        seconds--;
                    }
                    }
                var countdownTimer = setInterval('secondPassed()', 1000);
                </script>

<style>
    li {
        margin: 1.5vw;
    }

    ul {
        list-style: none;
        width: auto !important;
    }

    .navbar {
        background-image: url("./images/header.png") !important;
        background-color: #222;
        font-size: 1.5vw !important;
        display: inline-flex;
        width: 100%;
        color:#ddd;
        position:fixed;
        z-index:100;
        
    }

    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor: pointer;
    }

    /* .navbar>ul>li>a:hover {
        color: #042A387;
        text-decoration: underline;
        font-weight: bold !important;
    } */

    a {
        text-decoration: none;
        color: #042A38;
    }
    .prof,#score{
        top: 3vw;
        position: fixed;
            width: 50vw !important;
            margin-left: 25vw !important;
            margin-right: 25vw !important;
            background-color: #fff !important;
            display: none !important;
            border-radius: 10px;
            margin-top: 2vw;
            z-index: 1;
            padding: 1vw;
            padding-left: 2vw;
            color: #042A38;
        }
        input{
            margin:1vw;
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
    #btn{
        height: 3vw;
        width: 10vw;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bolder;
        border-radius: 10px;
        border: 2px solid #ddd;
        background-color: #222;
        color:#ddd;
    }
    #btn:hover{
        background-color: #ddd;
        color:#222;
        border:2px solid #222;
    }
    table{
        width: 90vw;
        margin-left: 5vw;
        margin-right: 5vw;
        align-content: center;
        border: 1px solid black;
    }
    thead{
        font-weight:900;
        font-size: 1.5vw;
    }
    td{
        width: auto;
        border: 1px solid black;
        text-align: center;
        height: 4vw;
        font-weight: bold;
   }
    #tq{
        text-decoration: underline;
    }
    #sc{
        width: 100% !important;
        margin: 0%;
        color: #042A38;
            }

    .div1{
                background-color:#2d2d2d;
                opacity:90%;
                z-index:10;
                font-size: 1.5vw;
        }
    label:hover{
        cursor:pointer;
        color:#656565;
    }
    input[type='radio']#Black{
        cursor:pointer;
        accent-color:#222;
    }

</style>

<body style="color: #fff !important;font-weight:bolder;margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;">
    <div  style="background-image: url(images/dark.png);height: auto;">
        <div  class="navbar">
            <section style="margin: 1.5vw;">ONLINE EXAMINATION SYSTEM</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <!-- <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Score</li>
                <li onclick="leader()">Leaderboard</li> -->
                <!-- <li onclick="lo()">Sign Out</li> -->
            </ul>
        </div><br><br>
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
        <section style="margin-top: 4vw;width:80vw;margin-left:10vw;margin-right:10vw"> 
        <?php 
        if(isset($_GET["qid"])){
        $qid=$_GET["qid"];
            $sql ="select * from questions where quizid='{$qid}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if(mysqli_num_rows($res)==0)
                {
                    echo "No questions found under this quiz please come later";
                }else{
                    $time = $row['timer'];
                    $_SESSION['seconds'] = $time;
                    // echo "<input readOnly id='countdown' type='number' class='timer' value='seconds'/>
                    // ";
                $i=1;
                $j=0;
                // global $score;
                echo "<form method=\"POST\">";
                    echo "<div class='div1'>";
                while ($row = mysqli_fetch_assoc($res)) {
                        // $j = 0;
                        echo "<hr>";
                            echo $i . ". " . $row["qs"] . "<br><hr>";
                            echo "<label><input id='Black' type=\"radio\" value=\"option1\" name=\"ans".$i.$j."\">" . $row["op1"] . "</label><br>";
                            echo "<label><input id='Black' type=\"radio\" value=\"option2\"  name=\"ans".$i.$j."\">" . $row["op2"] . "</label><br>";
                            echo "<label><input id='Black' type=\"radio\" value=\"option3\" name=\"ans".$i.$j."\">" . $row["op3"] . "</label><br>";
                            // echo "<input type=\"radio\"value=\"".($j+3)."\" name=\"ans".$i.$j."\">".$row["answer"]."<br><br>";  
        
                            // if ((isset($_POST["ans" . $i . $j]) == $row["answer"])||(isset($_POST["ans".$i.($j+1)])==$row["answer"])||(isset($_POST["ans".$i.($j+2)])==$row["answer"])) {
                            //     $score++;
                            // }
                        // $score = 0;
                        if ($_POST["ans" . $i . $j] === $row["answer"]) {
                            $score++;}
                        // if ($_POST["ans" . $i . 0] == $row["answer"]) {
                        //     $score++;
                        // }
                        // if ($_POST["ans" . $i . 1] == $row["answer"]) {
                        //     $score++;
                        // }
                        // if ($_POST["ans" . $i . 2] == $row["answer"]){
                        //         $score++;
                        // }
                       
                         
                $i++;

                        }
                    echo "<hr></div>";           
                }
                echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"submit\"><br><br><br>";
                echo "</form><br><br>";
            }
            }
            else
            {
                echo "error".mysqli_error($conn).".";
            }
            if(isset($_POST["submit"])){

          

                // global $score;
                // for($i=1;$i<=$count;$i++)
                // {
                     
                //         $qid=$_GET["qid"];
                //         $sql ="select * from questions where quizid='{$qid}'";
                //         $res=mysqli_query($conn,$sql);
                //         while ($row = mysqli_fetch_assoc($res)) {
                //             if (isset($_POST["ans" . $i . $j]) == $row["answer"]) {
                //                 $score++;
                //             }
                //         }
                //     }
                
                echo "<script>alert(\"u scored ".$score." out of ".$count."\");</script>";
            $quer = $conn->query("select mail,quizid from score where mail='$username1' and quizid='$qid'");
            if ($quer->num_rows == 0) {
                $sql = "insert into score(score,mail,quizid,totalscore) values('$score','$dbmail','$qid','$count');";
            }
            else{
                $sql = "update score set score='$score', totalscore='$count' where mail='$dbmail' and quizid='$qid';";
            }
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    echo '<script>history.pushState({}, "", "");</script>';
                    echo "<script>window.location.replace(\"homestud.php\");</script>";
                } else {
                    echo "<script>alert(\"error occured updating score in database" . mysqli_error($conn) . "\");</script>";
                }
        }
    //  } ?>
        </section>
        <!-- <section class="prof" id="prof" style="display: none;color:#042A38;">
                <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
                <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
                <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
                <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
                <p><b>USN&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
                <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
                <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
                <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </section> -->
        <!-- <section id="score" style="display:none;">
        <?php 
            $sql ="select * from score,quiz where score.mail='{$username1}' and score.quizid=quiz.quizid";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<h1>Scoreboard</h1>";
                echo "<table id=\"sc\"><thead><tr><td>Quiz Title</td><td>Score Obtained</td><td>Total Score</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td></tr>"; 
                }
                echo "</table>";
            }
            else{
                echo " ".mysqli_error($conn);
            }
            ?>
            </section> -->
            </section>
    </div>
</body>

</html>