<?php
//必ずsession_startは最初に記述
session_start();

//DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//データ登録SQL作成
$sql1 = "SELECT * FROM shop_an_table";
$sql2 = "SELECT * FROM customer_an_table";
$stmt1 = $pdo->prepare($sql1);
$stmt2 = $pdo->prepare($sql2);
$status1 = $stmt1->execute();
$status2 = $stmt2->execute();


//データ表示
$values1 = "";
if($status1==false) {
	sql_error($stmt1);
}
$values2 = "";
if($status2==false) {
	sql_error($stmt2);
}

//全データ取得
$values1 =  $stmt1->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json1 = json_encode($values1,JSON_UNESCAPED_UNICODE);

//全データ取得
$values2 =  $stmt2->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json2 = json_encode($values2,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>報告フォーム</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" href="css/sample.css">
</head>

<header>
	
	<div id="title">Analysis on customer harassment</div>
	
	<div id="navi_container">
		<a href="request_for_register_list.php">登録申請リスト</a>
		<a href="read.php">クレームデータ</a>
		<a href="read_customerlist.php">顧客リスト</a>
		<a href="read_shoplist.php">店舗リスト</a>
	</div>

	<div>
		<a href="logout.php">ログアウト</a>
	</div>

	</div>

</header>

<main>
    
</main>



</html>