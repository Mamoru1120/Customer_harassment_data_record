<?php
//1. POSTデータ取得
$customer_id = $_GET["customer_id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM customer_an_table WHERE customer_id=:customer_id");
$stmt->bindValue('customer_id', $customer_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("read_customerlist.php");
}