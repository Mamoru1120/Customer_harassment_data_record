<?php
//DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gsachademy_unit1;charset=utf8;host=mysql57.gsachademy.sakura.ne.jp','','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

//データ登録SQL作成
$sql = "SELECT * FROM record_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$values = "";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

//XSSを防ぐことができる
include("funcs.php");
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
	
	<div id="title">Analysis on customer harassment</div>
	
	<div id="navi_container">
    <a href="input.php">報告フォーム</a>
		<a href="read.php">クレームデータ</a>
		<a href="read_customerlist.php">顧客リスト</a>
		<a href="read_shoplist.php">店舗リスト</a>
	</div>

</header>

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
            </tr>

            <?php foreach($values as $v){ ?>
                <tr>
                    <td class="name_of_shop"><?=$v["name_of_shop"]?></td>
                    <td class="name_of_staff"><?=$v["name_of_staff"]?></td>
                    <td class="sex"><?=$v["sex"]?></td>
                    <td class="age"><?=$v["age"]?></td>
                    <td class="date"><?=$v["date"]?></td>
                    <td class="time"><?=$v["time"]?></td>
                    <td class="required_time"><?=$v["required_time"]?>分</td>
                    <td class="clame_content"><?=$v["clame_content"]?></td>
                    <td class="response_content"><?=$v["response_content"]?></td>
                </tr>
            <?php } ?>

        </table>
      </div>

</main>
</html>