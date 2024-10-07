<?php
//必ずsession_startは最初に記述
session_start();

//DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//データ登録SQL作成
$sql = "SELECT * FROM customer_an_table";
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
<title>顧客リスト</title>
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

        <h1>顧客リスト</h1>

        <div id="addition_container">
          <form action="write_customer.php" method="post">
            <h3>新規登録</h3>
            <label>顧客画像：</label>
           <input id="img" type="file" name="img" accept="image/jpeg, image/png">
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

            <button id="submit">追加</button>
          </form>

        </div>



        <!-- ここに記録していく -->

        <table class="output_table">
            <h3>リスト</h3>
            <tr>
                <th>顧客番号</th>
                <th>顧客画像</th>
                <th>性別</th>
                <th>年代</th>
                <th>クレーム回数</th>
                <th>総クレーム時間</th>
                <th>編集</th>
                <th>削除</th>
            </tr>

            <?php foreach($values as $v){ ?>
                <tr>
                    <td class="customer_id"><?=h($v["customer_id"])?></td>
                    <td class="img"><?=h($v["img"])?></td>
                    <td class="sex"><?=h($v["sex"])?></td>
                    <td class="age"><?=h($v["age"])?></td>
                    <td class="num_of_harassment"><?=h($v["num_of_harassment"])?></td>
                    <td class="total_time_of_harassment"><?=h($v["total_time_of_harassment"])?></td>
                    <td><a href="detail_customer.php?customer_id=<?=h($v["customer_id"])?>">📝</a></td>
                    <td><a href="delete_customer.php?customer_id=<?=h($v["customer_id"])?>">🚮</a></td>
                </tr>
            <?php } ?>

        </table>
    </div>

</main>
</html>