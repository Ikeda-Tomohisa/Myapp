<!-- page class join confirm -->

<?php
session_start();

/* csrf対策ができない？
if (!isset($_SESSION['token']) ||
    !isset($_POST['token']) ||
    $_POST['token'] !== $_SESSION['token']){
    var_dump($_POST['token']);
    var_dump($_SESSION['token']);
	echo "不正アクセスの可能性あり";
	exit();
}
*/

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

$errorMessage = "";

if(isset($_POST["classjoinconfirmed"])) {
    if (!empty($_SESSION["classid"]) && !empty($_SESSION["studentid"]) && !empty($_SESSION["studentname"])) {
        //teacherのstudentidは0とする。
        $classid = $_SESSION["classid"];
        $studentid = $_SESSION["studentid"];
        $studentname = $_SESSION["studentname"];
        $userid = $_SESSION["userID"];
        
        try{
            
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $stmt = $dbh->prepare("UPDATE users SET classid = :classid, studentid = :studentid, studentname = :studentname WHERE userid = :userid");
            $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
            $stmt->bindValue(':studentid', $studentid, PDO::PARAM_INT);
            $stmt->bindValue(':studentname', $studentname, PDO::PARAM_STR);
            $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
            $stmt->execute();
            
            header("Location: ./pagenewclasscompleted.php");
            exit();
            
            $dbh = null;
        }catch(Exception $e){
            $errorMessage = 'データベースエラー';
            //echo $e->getMessage();
            die();
        }
    }
}else if(isset($_POST["back"])) {
    header("Location: ./pageclassjoin.php");
    exit();
}
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス参加-確認</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス参加-確認<span>Confirm class participation</span></h1>
		<div>こちらの情報で間違いありませんか。<br>
		     Is this information correct?
		</div><br>
		<?php echo "Classname:",$_SESSION["classname"] ?><br>
		<?php echo "ClassID:",$_SESSION["classid"] ?><br>
		<?php echo "Teacher name:",$_SESSION["teachername"] ?><br><br>
		
		<?php echo "StudentID:",$_SESSION["studentid"] ?><br>
		<?php echo "Student name:",$_SESSION["studentname"] ?><br><br>
	<form action="" method="post">
		<button type="submit" class="registration" name="back">戻る<br>Back to previous page</button>
		<button type="submit" class="registration" name="classjoinconfirmed">登録！<br>Register this information!</button>
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
