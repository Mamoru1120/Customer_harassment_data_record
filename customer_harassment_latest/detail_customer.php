<?php
//DB接続します
$customer_id = $_GET["customer_id"];

include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成
$sql = "SELECT * FROM customer_an_table WHERE customer_id=:customer_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':customer_id',    $customer_id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$v =  $stmt->fetch(); //1レコードのみ取得

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>顧客情報更新</title>
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

        <div id="addition_container">
          <form action="update_customer.php" method="post">
            <h1>顧客情報更新</h1>
            <label>顧客画像：</label>
           <input id="img" type="file" name="img" accept="image/jpeg, image/png" value="<?=$v["img"]?>">
            <label>クレーマーの性別：</label>
			    <select id="sex" name="sex" required>
				    <option><?=$v["sex"]?></option>
				    <option value="男性">男性</option>
				    <option value="女性">女性</option>
			    </select>
				
			    <label>クレーマーの年代：</label>
			    <select id="age" name="age" required>
				    <option><?=$v["age"]?></option>
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

            <button id="submit">変更</button>
            <input type="hidden" name="customer_id" value="<?=$v["customer_id"]?>">
          </form>

        </div>
    </div>

</main>
</html>