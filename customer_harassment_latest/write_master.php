<?php

//エラー表示
ini_set("display_errors", 1);

$mlid = $_POST["mlid"];
$mlpw = $_POST["mlpw"];
$mlpw = password_hash($mlpw, PASSWORD_DEFAULT);   //パスワードハッシュ化

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成

$sql = "INSERT INTO master_an_table(mlid,mlpw)VALUES(:mlid,:mlpw)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mlid', $mlid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mlpw', $mlpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    redirect("login_for_master.php");
  }

?>