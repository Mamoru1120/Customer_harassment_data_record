<?php
//必ずsession_startは最初に記述
session_start();
include("funcs.php");
sschk();

//エラー表示
ini_set("display_errors", 1);

$shop_id    = $_POST["shop_id"];
$name_of_shop = $_POST["name_of_shop"];
$prefecture = $_POST["prefecture"];
$name_of_delegate = $_POST["name_of_delegate"];
$mail = $_POST["mail"];
$phone = $_POST["phone"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化

//DB接続
$pdo = db_conn();

//データ登録SQL作成

$sql = "UPDATE shop_an_table SET name_of_shop=:name_of_shop,prefecture=:prefecture,name_of_delegate=:name_of_delegate,mail=:mail,phone=:phone, lid=:lid, lpw=:lpw WHERE shop_id=:shop_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':shop_id',    $shop_id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name_of_shop', $name_of_shop, PDO::PARAM_STR);  
$stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR); 
$stmt->bindValue(':name_of_delegate', $name_of_delegate, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    redirect("read_shoplist.php");
  }

?>