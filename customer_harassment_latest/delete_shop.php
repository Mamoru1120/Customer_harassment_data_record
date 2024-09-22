<?php
//必ずsession_startは最初に記述
session_start();

//1. POSTデータ取得
$shop_id = $_GET["shop_id"];

//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM shop_an_table WHERE shop_id=:shop_id");
$stmt->bindValue('shop_id', $shop_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("read_shoplist.php");
}