<?php
//必ずsession_startは最初に記述
session_start();

//DB接続します
$shop_id = $_GET["shop_id"];

include("funcs.php");
sschk();
$pdo = db_conn();

//データ登録SQL作成
$sql = "UPDATE shop_an_table SET status='承認' WHERE shop_id=:shop_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':shop_id',    $shop_id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
  }else{
    redirect("request_for_register_list.php");
  }

?>
