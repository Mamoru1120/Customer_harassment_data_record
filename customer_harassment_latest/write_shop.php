<?php

//エラー表示
ini_set("display_errors", 1);

$name_of_shop = $_POST["name_of_shop"];
$prefecture = $_POST["prefecture"];
$name_of_delegate = $_POST["name_of_delegate"];
$mail = $_POST["mail"];
$phone = $_POST["phone"];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成

$sql = "INSERT INTO shop_an_table(name_of_shop,prefecture,name_of_delegate,mail,phone,recorded_date)VALUES(:name_of_shop,:prefecture,:name_of_delegate,:mail,:phone,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name_of_shop', $name_of_shop, PDO::PARAM_STR);  
$stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR); 
$stmt->bindValue(':name_of_delegate', $name_of_delegate, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    redirect("read_shoplist.php");
  }

?>