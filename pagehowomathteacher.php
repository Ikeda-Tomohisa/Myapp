<!-- page homework math teacher -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-宿題</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>数学-宿題<span>mathematics-homework</span></h1>

<a href="./pagegivehowomath.php">宿題を出す</a><br><br>
<a href="./pagehowomathconfirmteacher.php">出した宿題を確認する</a><br><br>
<a href="./pagehowomathconfirm.php">生徒の宿題を確認する</a><br><br>
<button class="registration" onclick="location.href='./pagesubjectmath.php'">戻る<br>Back to previous page</button><br>

</div>
<?php include './footer.php' ?>
</body>
</html>