<?php

//エラー表示
ini_set("display_errors", 1);

$name_of_shop = $_POST["name_of_shop"];
$name_of_staff = $_POST["name_of_staff"];
$sex = $_POST["sex"];
$age = $_POST["age"];
$date = $_POST["date"];
$time = $_POST["time"];
$required_time = $_POST["required_time"];
$clame_content = $_POST["clame_content"];
$response_content = $_POST["response_content"];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成

$sql = "INSERT INTO record_an_table(name_of_shop,name_of_staff,sex,age,date,time,required_time,clame_content,response_content, recorded_date)VALUES(:name_of_shop,:name_of_staff,:sex,:age,:date,:time,:required_time,:clame_content,:response_content,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name_of_shop', $name_of_shop, PDO::PARAM_STR);  
$stmt->bindValue(':name_of_staff', $name_of_staff, PDO::PARAM_STR); 
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':time', $time, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':required_time', $required_time, PDO::PARAM_STR);
$stmt->bindValue(':clame_content', $clame_content, PDO::PARAM_STR);
$stmt->bindValue(':response_content', $response_content, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
  sql_error($stmt);
  }else{
    redirect("input.php");
  }

?>