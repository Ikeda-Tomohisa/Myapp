<!-- page handout math student -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-プリント</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>数学-プリント<span>mathematics-handout</span></h1>

<a href="./pagegethandoutmath.php">プリントをもらう</a><br><br>
<a href="./pagesubmithandoutmath.php">プリントを提出</a><br><br>
<a href="./pagehandoutmathconfirmstudent.php">自分のプリントを確認する</a><br><br>
<button class="registration" onclick="location.href='./pagesubjectmath.php'">戻る<br>Back to previous page</button><br>

</div>
<?php include './footer.php' ?>
</body>
</html>