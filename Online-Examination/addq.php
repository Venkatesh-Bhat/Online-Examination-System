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
    $sql = "select * from " . $type1 . " where mail='{$username1}'";
    $res = mysqli_query($conn, $sql);
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

    $qid = $_GET["qid"];
    if (isset($_POST['submit'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        if($ans!="Answer") {
            $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                echo '<script>history.pushState({}, "", "");</script>';
            } elseif ($res != true) {
                echo '<script>alert("Question already exsits");</script>';
            }
        }
        else{
            echo '<script>alert("Choose a valid answer!");</script>';
        }
    }
    if (isset($_POST['submit1'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        if ($ans!="Answer") {
            $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                header("Location: homestaff.php");
            } elseif ($res != true) {
                echo '<script>alert("Question already exsits");</script>';
            }
        } else {
            echo '<script>alert("Choose a valid answer!");</script>';
        }
    }
}
?>
<style>

    li {
        margin: 1.5vw;
        color:#ddd;
    }

    ul {
        list-style: none;
        width: auto !important;
    }

    .navbar {
        /* background-color: #fff!important; */
        background-image: url("./images/header.png") !important;
        font-size: 1.5vw;
    }

    .navbar>ul>li:hover {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        cursor:pointer;

    }

    .navbar>ul>li>a:hover {
        color: black;
        text-decoration: underline;
        font-weight: bold !important;
    }

    a {
        text-decoration: none;
        color: #042A38;
    }

    .prof,
    #score {
        top: 3vw;
        position: fixed;
        width: 50vw !important;
        margin-left: 25vw !important;
        margin-right: 25vw !important;
        background-color: #fff!important;
        display: none !important;
        border-radius: 10px;
        margin-top: 2vw;
        z-index: 1;
        padding: 1vw;
        padding-left: 2vw;
        color: #042A38;
    }

    button {
        height: 5vh;
        width: 10vw;
        background-color: lightgoldenrodyellow;
        color: black;
        outline: none;
        border: none;
        border-radius: 10px;
        margin: 5vw;
    }

    input {
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
        background-color: blueviolet !important;
    }

    .bg {
        background-size: 100%;
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

        p {
            color: #042A38 !important;
        }

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
            #le{
                width: 90vw;
                margin: 0;
                color: #fff;
            }
    .ip1{
            height: 3vw;width: auto;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid white;background-color: #222;
            color:#ddd;
            padding:1vw;
        }
    .ip1:hover{
            border: 2px solid black;background-color: #ddd;
            color:#222;
    }
    select{
        width: 30vw;
        height: 3vw;
        border-radius: 10px;
        border: 2px solid black;
        padding-left: 2vw;
        font-weight: bolder;
        outline: none;
    }
</style>

<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;background-image:url(./images/dark.png);color:#fff !important">
    <!-- <div style="background-color: #042A38;height: 100%;"> -->
        <div class="navbar" style="display: inline-flex;width: 100%;color:#042A38;position:fixed;">
            <section style="margin: 1.5vw;color:#ddd;">ONLINE EXAMINATION SYSTEM</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br>
        <section class="dash" style="margin-top:3vw">
            <section id="ans">
                <center>
                    <form style="margin: 0vw;width: 100vw" method="post">

                        <label for="quizname">Add Questions</label><br><br>
                        <div id="QS">
                            <!-- <label for="qs">Question</label> -->
                            <input type="text" name="qs" placeholder="enter question " required><br><br>
                            <!-- <label for="op1">Option 1</label> -->
                            <input type="text" name="op1" placeholder="option1" required><br><br>
                            <!-- <label for="op2">Option 2</label> -->
                            <input type="text" name="op2" placeholder="option2" required><br><br>
                            <!-- <label for="op3">Option 3</label> -->
                            <input type="text" name="op3" placeholder="option3" required><br><br>
                            <!-- <label for="ans">Answer &nbsp;</label> -->
                            <!-- <input type="text" name="ans" placeholder="answer" required><br><br> -->
                            <select name="ans" aria-placeholder="answer" required>
                                <option value="Answer">answer</option>
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select><br><br>
                        </div>
                        
                        <input class="ip1" type="submit" name="submit" value="add 1 more question">
                        <input class="ip1" type="submit" name="submit1" value="Done">
                    </form>
                </center>
            </section>
        </section>
        
    <!-- </div> -->

</body>
<?php
echo '<script>' .
    "function prof(){" .
    // "document.getElementById(\"prof\").style=\"display: block !important;\";" .
    // "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "window.location.replace('stprofile.php')" .
    "}" .
    "function score(){" .
    // "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    // "document.getElementById(\"score\").style=\"display: block !important;\";" .
    "window.location.replace('quizz.php')" .
    "}" .
    "function dash(){" .
    // "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    // "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "window.location.replace('homestaff.php')" .
    "}" .
    "function lo(){" .
    "alert(\"Thank You for Using our Online Examination System\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");" .
    "}" .
    "function addquiz(){" .
    "document.getElementById(\"addq\").style=\"display: initial;\";" .
    "}" .

    "</script>";
?>

</html>