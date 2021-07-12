<!-- page give handout math-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$userid = $_SESSION["userID"];

$errorMessage = "";
$errorMessageEnglish = "";
$fileuploadMessage = "";
$fileuploadMessageEnglish = "";

if(isset($_POST["givehandout"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    //print_r($_FILES);
    if($_FILES['image']['size'] === 0) {
        $errorMessage = "ファイルが選択されていません。";
        $errorMessageEnglish = "No file selected.";
    //} else if ($_FILES['image']['type'] !== "image/png") {
    //    $errorMessage = "png画像を選んでください。";
    //    $errorMessageEnglish = "Please select a png image.";
    } else {
        try {
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $stmt = $dbh->prepare('SELECT * FROM users WHERE userid = :userid');
            $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $classid = $row['classid'];
            
            if (is_null($classid)) {
                $errorMessage = "クラスに参加していません。クラス未参加だとこの機能は使えません。";
                $errorMessageEnglish = "NOT participate in the class.This function cannot be used if you don't participate in the class.";
            } else if ($errorMessage == "") {
                date_default_timezone_set('Asia/Tokyo');
                $directory_path = "./handoutmath"."_".$classid;
                $directory_path2 = "./handoutmath"."_".$classid."/".date("Y_m_d");
                
                if(!file_exists($directory_path)){
                    mkdir($directory_path);
                }
                if(!file_exists($directory_path2)){
                    mkdir($directory_path2);
                }
                $save = $directory_path2."/".basename($_FILES['image']['name']);
                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $save)){
                    $fileuploadMessage = "アップロード成功！";
                    $fileuploadMessageEnglish = "Upload successful";
                }else{
                    $fileuploadMessage = "アップロード失敗！";
                    $fileuploadMessageEnglish = "Upload failure";
                }
            }
            $dbh = null;
        } catch (PDOException $e) {
            $errorMessage = "データベースエラー";
            $errorMessageEnglish = "Database Error";
            //$e->getMessage();
            //echo $e->getMessage();
        }
    }
} else if (isset($_POST["back"])) {
    header("Location: ./pagehowomathteacher.php");
    exit();
}

?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-プリントを出す</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
    <h1>数学-プリントを出す<span>give mathematics-handout</span></h1>
    <div class="red">
    同じ名前のファイルがある場合は上書きされます。<br>
    If there is a file with the same name,it will be overwritten.
    </div><br>
    <div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
    <div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
    <div class="bigbold"><?php echo htmlspecialchars($fileuploadMessage, ENT_QUOTES); ?></div>
    <div class="bold"><?php echo htmlspecialchars($fileuploadMessageEnglish, ENT_QUOTES); ?></div>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image"><br><br>
        
        <button type="submit" class="registration" name="givehandout">ファイルに送信する<br>Send this file</button><br><br>
        <button class="registration" name="back">戻る<br>Back to previous page</button><br>
    </form>
</div>
<?php include './footer.php' ?>
</body>
</html>