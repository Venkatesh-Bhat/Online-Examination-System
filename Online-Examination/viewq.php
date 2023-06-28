<html>

<head>
    <title>
        Online examination System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
// require_once 'sql.php';
                $conn = mysqli_connect("localhost","root","","online_examination");
                if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
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
        /* background-color:#fff !important; */
        background-image:url("./images/header.png") !important;
        font-size: 1.5vw;
    }

    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor:pointer;

    }

    .navbar>ul>li>a:hover {
        color: #042A38;
        text-decoration: underline;
        font-weight: bold !important;
    }

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
            margin: 1vw;
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
        border: 2px solid white;
        background-color: #222;
        color:#ddd;
    }
    #btn:hover{
        border-color:black;
        color:#222;
        background-color:#ddd;
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

            .ip1{
        height: auto;
        width: auto;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bolder;
        border-radius: 10px;
        border: 2px solid black;
        background-color: #ddd;
        color:#222;
        padding:0.7vw;
        /* margin-left:5vw; */
        
    }

    /* .ip1:hover{
        background-color: #222;
        color:#ddd;
        border:2px solid #ddd;
    }   */
</style>

<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;height:auto;color:#fff;background-image:url(./images/dark.png);">
    <div id="main" style="height: auto;color:#fff !important">
        <div class="navbar" style="display: inline-flex;width: 100%;color:#ddd;position:fixed;">
            <section style="margin: 1.5vw;">ONLINE EXAMINATION SYSTEM</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
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
                    echo "<form method=\"POST\">";
                echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Add Questions\"><br><br><br>";

                }else{
                $i=1;
                $j=0;
                echo "<form method=\"POST\">";
                echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Add Questions\"><br><br><br>";
                echo "</form><br><br>";

                while ($row = mysqli_fetch_assoc($res)) { 
                    echo $i.". ".$row["qs"]."<br>";
                    echo "<input type=\"radio\" value=\"ans".$i.$j."\" name=\"ans".$i.$j."\">".$row["op1"]."<br>";
                    echo "<input type=\"radio\" value=\"ans".$i.($j+1)."\" name=\"ans".$i.$j."\">".$row["op2"]."<br>";               
                    echo "<input type=\"radio\" value=\"ans".$i.($j+2)."\"name=\"ans".$i.$j."\">".$row["op3"]."<br>";               
                    echo "Answer:<p class='ip1'>".$row['answer']."</p><br><br>";  
                    $i++;                            
                }
                echo "</form><br><br>";
            }
            }
            else
            {
                echo "error".mysqli_error($conn).".";
            }
            if(isset($_POST["submit"])){
                echo "<script>window.location.replace(\"addq.php?qid=".$qid."\")</script>";
            }
     } ?>
        </section>
        <section class="prof" id="prof" style="display: none;color:#042A38;">
                <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
                <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
                <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
                <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
                <p><b>USN&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
                <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
                <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
                <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </section>
        <section id="score" style="display:none;">
        <?php 
            $sql ="select * from quiz where mail='{$username1}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<h1>List of Quiz added by U</h1>";
                echo "<table id=\"sc\"><thead><tr><td>Quiz id</td>&nbsp;<td>Quiz Title</td><td>Created on</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizid"]."</td><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td></tr>"; 
                }
                echo "</table>";
            }
            ?>
            </section>
            </section>
    </div>

</body>
<?php
echo '<script>'.
"function prof(){".
// "document.getElementById(\"prof\").style=\"display: block !important;\";".
// "document.getElementById(\"score\").style=\"display: none !important;\";".
"window.location.replace('stprofile.php')" .
"}".
"function score(){".
// "document.getElementById(\"prof\").style=\"display: none !important;\";".
// "document.getElementById(\"score\").style=\"display: block !important;\";".
"window.location.replace('quizz.php')" .
"}".
"function dash(){".
    // "document.getElementById(\"prof\").style=\"display: none !important;\";".
    // "document.getElementById(\"score\").style=\"display: none !important;\";".
    "window.location.replace('homestaff.php')" .
    "}".
"function lo(){".
"alert(\"Thank You for Using our Online Examination System\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");".
"}</script>";
?>
</html>