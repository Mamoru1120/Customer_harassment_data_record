<?php
//必ずsession_startは最初に記述
session_start();

//DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//データ登録SQL作成
$sql = "SELECT * FROM shop_an_table";
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
<title>店舗リスト</title>
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
        
        <h1>店舗リスト</h1>
          
        <!-- ここに記録していく -->
        <table class="output_table">
              <tr>
                <th>店舗番号</th>
                <th>店舗名</th>
                <th>都道府県</th>
                <th>店舗代表者名</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>編集</th>
                <th>削除</th>
            </tr>

            <?php foreach($values as $v){ ?>
              <?php if(h($v["status"])=="承認"){ ?>
                <tr>
                    <td class="shop_id"><?=h($v["shop_id"])?></td>
                    <td class="name_of_shop"><?=h($v["name_of_shop"])?></td>
                    <td class="prefecture"><?=h($v["prefecture"])?></td>
                    <td class="name_of_delegate"><?=h($v["name_of_delegate"])?></td>
                    <td class="mail"><?=h($v["mail"])?></td>
                    <td class="phone"><?=h($v["phone"])?></td>
                    <td>
                      <?php if($_SESSION["user_type"]=="管理者" || $_SESSION["name_of_shop"]==$v["name_of_shop"]){ ?>
                        <a href="detail_shop.php?shop_id=<?=h($v["shop_id"])?>">📝</a>
    	                <?php } ?>
                    </td>
                    <td>
                      <?php if($_SESSION["user_type"]=="管理者" || $_SESSION["name_of_shop"]==$v["name_of_shop"]){ ?>
                        <a href="delete_shop.php?shop_id=<?=h($v["shop_id"])?>">🚮</a>
    	                <?php } ?>
                    </td>
                </tr>
              <?php } ?>
            <?php } ?>

        </table>
    </div>

</main>
</html>