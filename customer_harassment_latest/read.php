<?php
//必ずsession_startは最初に記述
session_start();

//DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//データ登録SQL作成
$sql = "SELECT * FROM record_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>クレームデータ</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" href="css/sample.css">

</head>


<header>
	
	<div id="title_login">Analysis on customer harassment</div>
	
	<div id="navi_container">
    	<?php if($_SESSION["user_type"]=="管理者"){ ?>
      		<a href="request_for_register_list.php">登録申請リスト</a>
    	<?php } ?>
    	<?php if($_SESSION["user_type"]=="一般"){ ?>
      	<a href="input.php">報告フォーム</a>
    	<?php } ?>
		<a href="read.php">クレームデータ</a>
		<a href="read_customerlist.php">顧客リスト</a>
		<a href="read_shoplist.php">店舗リスト</a>
	</div>

  <div id="logout">
		<a href="logout.php">ログアウト</a>
	</div>

</header>

<div id="login_shop">
  <?php if($_SESSION["user_type"]=="管理者"){ ?>
    管理者さん、ようこそ
  <?php } else if($_SESSION["user_type"]=="一般"){ ?>
    <?=$_SESSION["name_of_shop"]?>さん、ようこそ
  <?php } ?>
</div>

<main>

      <div id="output_container">
        <h1>クレームデータ</h1>

        <!-- ここに記録していく -->

        <table class="output_table">
            <tr>
                <th>店舗名</th>
                <th>クレーム対応者</th>
                <th>クレーマーの性別</th>
                <th>クレーマーの年代</th>
                <th>発生日</th>
                <th>発生時刻</th>
                <th>対応に要した時間</th>
                <th>クレームの内容</th>
                <th>対応方法</th>
                <th>編集</th>
                <th>削除</th>
            </tr>

            <?php foreach($values as $v){ ?>
                <tr>
                    <td class="name_of_shop"><?=h($v["name_of_shop"])?></td>
                    <td class="name_of_staff"><?=h($v["name_of_staff"])?></td>
                    <td class="sex"><?=h($v["sex"])?></td>
                    <td class="age"><?=h($v["age"])?></td>
                    <td class="date"><?=h($v["date"])?></td>
                    <td class="time"><?=h($v["time"])?></td>
                    <td class="required_time"><?=h($v["required_time"])?>分</td>
                    <td class="clame_content"><?=h($v["clame_content"])?></td>
                    <td class="response_content"><?=h($v["response_content"])?></td>
                    <td>
                      <?php if($_SESSION["user_type"]=="管理者" || $_SESSION["name_of_shop"]==$v["name_of_shop"]){ ?>
                        <a href="detail.php?id=<?=h($v["id"])?>">📝</a>
    	                <?php } ?>
                    </td>
                    <td>
                      <?php if($_SESSION["user_type"]=="管理者" || $_SESSION["name_of_shop"]==$v["name_of_shop"]){ ?>
                        <a href="delete.php?id=<?=h($v["id"])?>">🚮</a>
    	                <?php } ?>
                    </td>
                </tr>
            <?php } ?>

        </table>
      </div>

</main>
</html>