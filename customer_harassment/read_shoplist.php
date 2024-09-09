<?php
//DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gsachademy_unit1;charset=utf8;host=mysql57.gsachademy.sakura.ne.jp','','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

//データ登録SQL作成
$sql = "SELECT * FROM shop_an_table";
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
<title>店舗リスト</title>
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
        
        <h1>店舗リスト</h1>

        <div id="addition_container">
          <form action="write_shop.php" method="post">
            <h3>新規登録</h3>
            <label>店舗名：</label>
            <input id="name_of_shop" type="text" name="name_of_shop" placeholder="〇〇店" required>
            <label>都道府県：</label>
            <select name="prefecture" id="prefecture" required>
                <option value="" disabled="" selected="">選択してください</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
            </select>
            <label>店舗代表者名：</label>
            <input id="name_of_delegate" type="text" name="name_of_delegate" required>
            <label>メールアドレス：</label>
            <input id="mail" type="text" name="mail" placeholder="customer@harassment.com" required>
            <label>電話番号：</label>
            <input id="phone" type="text" name="phone" placeholder="〇〇〇-〇〇〇〇-〇〇〇〇" required>


            <button id="submit">追加</button>
          </form>

        </div>

        <!-- ここに記録していく -->
        <table class="output_table">
              <h3>リスト</h3>
              <tr>
                <th>店舗番号</th>
                <th>店舗名</th>
                <th>都道府県</th>
                <th>店舗代表者名</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
            </tr>

            <?php foreach($values as $v){ ?>
                <tr>
                    <td class="shop_id"><?=$v["shop_id"]?></td>
                    <td class="name_of_shop"><?=$v["name_of_shop"]?></td>
                    <td class="prefecture"><?=$v["prefecture"]?></td>
                    <td class="name_of_delegate"><?=$v["name_of_delegate"]?></td>
                    <td class="mail"><?=$v["mail"]?></td>
                    <td class="phone"><?=$v["phone"]?></td>
                </tr>
            <?php } ?>

        </table>
    </div>

</main>
</html>