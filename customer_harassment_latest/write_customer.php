<?php
//必ずsession_startは最初に記述
session_start();
include("funcs.php");
sschk();

//エラー表示
ini_set("display_errors", 1);

$img = $_POST["img"];
$sex = $_POST["sex"];
$age = $_POST["age"];

//DB接続
$pdo = db_conn();

//データ登録SQL作成

$sql = "INSERT INTO customer_an_table(img,sex,age,recorded_date)VALUES(:img,:sex,:age,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);  
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR); 
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    //input.phpへリダイレクト
    redirect("read_customerlist.php");
  }

?>