<!-- page help student -->
<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-ユーザーアカウント設定</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>ヘルプ（生徒用）<span>helps for students</span></h1>

<h3>myappは何をするアプリ？</h3>
<div>
教科書とノート、宿題とプリントなど<br>
学校で行うことをWeb上でできるアプリです。<br>
主に紙を減らしたいという目的で作られました。
</div>
<h3>アカウントについて</h3>
<div>
ログインにはuserIDとpasswordを使いますので<br>
忘れないようにお願いします。<br>
アカウント情報は「あなたのユーザーアカウント」内で<br>
確認することができます。
</div>
<h3>クラスについて（生徒用）</h3>
<div>
生徒は「クラスに参加」することができます。<br>
現状1つしかクラス参加できません。<br>
生徒は先生のクラスIDを用いて、先生のクラスに<br>
参加することができます。<br>
この機能を使うことで、宿題やプリントを<br>
クラスの先生から配布・先生に提出することができます。
</div>
<h3>教科について</h3>
<div>
現状は5教科の対応となっています。
</div>
<h3>教科書について（生徒用）</h3>
<div>
生徒は先生が登録した教科書を使います。
</div>
<h3>ノートについて（生徒用）</h3>
<div>
生徒はノートを書くことができます。<br>
</div>
<h3>宿題・プリントについて（生徒用）</h3>
<div>
生徒は宿題・プリントを提出することができます。<br>
</div>
<br><button class="registration" onclick="location.href='./pageuser_class_settings.php'">戻る<br>Back to previous page</button><br><br>
<br>

</div>
<?php include './footer.php' ?>

</body>

</html>