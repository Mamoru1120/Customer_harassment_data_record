<?php
//DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gsachademy_unit1;charset=utf8;host=mysql57.gsachademy.sakura.ne.jp','','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

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
  $error1 = $stmt1->errorInfo();
  exit("SQLError:".$error1[2]);
}
$values2 = "";
if($status2==false) {
  $error2 = $stmt2->errorInfo();
  exit("SQLError:".$error2[2]);
}

//全データ取得
$values1 =  $stmt1->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json1 = json_encode($values1,JSON_UNESCAPED_UNICODE);

//全データ取得
$values2 =  $stmt2->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json2 = json_encode($values2,JSON_UNESCAPED_UNICODE);


//XSSを防ぐことができる
include("funcs.php");
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
		<a href="input.php">報告フォーム</a>
		<a href="read.php">クレームデータ</a>
		<a href="read_customerlist.php">顧客リスト</a>
		<a href="read_shoplist.php">店舗リスト</a>
	</div>
	</div>

</header>



<main>
	<div id="input_form_container">
		<h1>報告フォーム</h1>

		<form action="write.php" method="post">
			
			<h2>クレーム対応者情報</h2>

			<label>店舗名：</label>
			<select name="name_of_shop" id="name_of_shop" required>
				<option value disabled selected>選択してください</option>
				<?php foreach($values1 as $v1){ ?>
                	<option><?=$v1["name_of_shop"]?></option>
           		 <?php } ?>
			</select>
			

			<label>クレーム対応者：</label>
			<input id="name_of_staff" type="text" name="name_of_staff" required>

			<h2>顧客情報</h2>

			<label>クレーマーの性別：</label>
			<select id="sex" name="sex" required>
				<option value disabled selected>選択してください</option>
				<option value="男性">男性</option>
				<option value="女性">女性</option>
			</select>
				
			<label>クレーマーの年代：</label>
			<select id="age" name="age" required>
				<option value disabled selected>選択してください</option>
				<option value="10代">10代</option>
				<option value="20代">20代</option>
				<option value="30代">30代</option>
				<option value="40代">40代</option>
				<option value="50代">50代</option>
				<option value="60代">60代</option>
				<option value="70代">70代</option>
				<option value="80代">80代</option>
				<option value="90代">90代</option>
				<option value="100代">100代</option>
			</select>

			<h2>クレーム詳細</h2>

			<label>発生日：</label>
			<input id="date" type="date" max="2999-12-31" name="date" required>

			<label>発生時刻：</label>
			<select id="time" name="time" required>
				<option value disabled selected>選択してください</option>
				<option value="0時頃">0時頃</option>
				<option value="1時頃">1時頃</option>
				<option value="2時頃">2時頃</option>
				<option value="3時頃">3時頃</option>
				<option value="4時頃">4時頃</option>
				<option value="5時頃">5時頃</option>
				<option value="6時頃">6時頃</option>
				<option value="7時頃">7時頃</option>
				<option value="8時頃">8時頃</option>
				<option value="9時頃">9時頃</option>
				<option value="10時頃">10時頃</option>
				<option value="11時頃">11時頃</option>
				<option value="12時頃">12時頃</option>
				<option value="13時頃">13時頃</option>
				<option value="14時頃">14時頃</option>
				<option value="15時頃">15時頃</option>
				<option value="16時頃">16時頃</option>
				<option value="17時頃">17時頃</option>
				<option value="18時頃">18時頃</option>
				<option value="19時頃">19時頃</option>
				<option value="20時頃">20時頃</option>
				<option value="21時頃">21時頃</option>
				<option value="22時頃">22時頃</option>
				<option value="23時頃">23時頃</option>
			</select>

			<label>対応に要した時間：</label>
			<input id="required_time" type="number" min="0", max="9999999" step="10" name="required_time" placeholder="〇分" required>
			
			<label>クレームの内容：</label>
			<textarea id="clame_content" name="clame_content" required></textarea>

			<label>対応方法：</label>
			<textarea id="response_content" name="response_content" required></textarea>		

			<button id="submit">送信</button>
		</form>
	</div>

</main>

</html>