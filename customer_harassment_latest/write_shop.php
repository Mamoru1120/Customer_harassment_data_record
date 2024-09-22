<?php

//エラー表示
ini_set("display_errors", 1);

$name_of_shop = $_POST["name_of_shop"];
$prefecture = $_POST["prefecture"];
$name_of_delegate = $_POST["name_of_delegate"];
$mail = $_POST["mail"];
$phone = $_POST["phone"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
$user_type = $_POST["user_type"];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成

$sql = "INSERT INTO shop_an_table(name_of_shop,prefecture,name_of_delegate,mail,phone,lid,lpw,user_type,recorded_date)VALUES(:name_of_shop,:prefecture,:name_of_delegate,:mail,:phone,:lid,:lpw,:user_type,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name_of_shop', $name_of_shop, PDO::PARAM_STR);  
$stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR); 
$stmt->bindValue(':name_of_delegate', $name_of_delegate, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_type', $user_type, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    redirect("complete.php");
  }

?>