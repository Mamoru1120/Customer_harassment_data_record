<?php

//エラー表示
ini_set("display_errors", 1);

$customer_id    = $_POST["customer_id"];
$img = $_POST["img"];
$sex = $_POST["sex"];
$age = $_POST["age"];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成

$sql = "UPDATE customer_an_table SET img=:img,sex=:sex,age=:age WHERE customer_id=:customer_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':customer_id',    $customer_id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', $img, PDO::PARAM_STR);  
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR); 
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    redirect("read_customerlist.php");
  }

?>