<!-- page your account -->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$userid = $_SESSION["userID"];

$attention = "";
$attentionEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT * FROM users WHERE userid = :userid');
    $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userid = $row['userid'];
    $username = $row['username'];
    $usertype = $row['usertype'];
    $classid = $row['classid'];
    $studentid = $row['studentid'];
    $studentname = $row['studentname'];
    
    $stmt2 = $dbh->prepare('SELECT * FROM class WHERE classid = :classid');
    $stmt2->bindValue(':classid', $classid, PDO::PARAM_STR);
    $stmt2->execute();
    
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    //var_dump($row2);
    if ($row2 == False) {
        $classname = "";
    } else {
        $classname = $row2['classname'];
    }
    
    if ($usertype == "t") {
        $yourusertype = "教師/teacher";
    } else if ($usertype == "s"){
        $yourusertype = "生徒/student";
    }
    if ($studentid == 0) {
        $studentid = "class-teacher";
    }
    if (is_null($classid)) {
        $classid = "";
        $classname = "";
        $teachername = "";
        $studentid = "";
        $studentname = "";
        $attention = "クラスに参加していません。";
        $attentionEnglish = "NOT participate in the class.";
    } else {
        $studentid_teacher = 0;
        $stmt3 = $dbh->prepare('SELECT * FROM user WHERE classid = :classid AND studentid = :studentid_teacher');
        $stmt3->bindValue(':classid', $classid, PDO::PARAM_STR);
        $stmt3->bindValue(':studentid_teacher', $studentid_teacher, PDO::PARAM_INT);
        $stmt3->execute();
        
        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        $teachername = $row3['username'];
    }
    
    $dbh = null;
} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    //$e->getMessage();
    //echo $e->getMessage();
}

?>


<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-あなたのユーザーアカウント</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>あなたのユーザーアカウント<span>Your user account</span></h1>
<?php echo "userID:",$userid ?><br><br>
<?php echo "username:",$username ?><br><br>
<?php echo "usertype:",$yourusertype ?><br><br>
<?php echo "password:",$_SESSION["passWORD"] ?><br><br>
<div>--------------------</div><br>
<div class="red"><?php echo htmlspecialchars($attention, ENT_QUOTES); ?></div>
<div class="red"><?php echo htmlspecialchars($attentionEnglish, ENT_QUOTES); ?></div>
<?php echo "classID:",$classid ?><br><br>
<?php echo "classname:",$classname ?><br><br>
<?php echo "teachername:",$teachername ?><br><br>
<?php echo "studentid:",$studentid ?><br><br>
<?php echo "studentname:",$studentname ?><br><br>

<button class="registration" onclick="location.href='./pageuser_class_settings.php'">戻る<br>Back to previous page</button><br><br>
<button class="registration" onclick="location.href='./pagelogout.php'">ログアウト<br>to logout</button>

</div>
<?php include './footer.php' ?>

</body>

</html>