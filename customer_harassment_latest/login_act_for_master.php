<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$mlid = $_POST["mlid"]; //lid
$mlpw = $_POST["mlpw"]; //lpw

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM master_an_table WHERE mlid=:mlid"); 
$stmt->bindValue(':mlid', $mlid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()


//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($mlpw, $val["mlpw"]); //$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();//SESSION_IDを取得
  //Login成功時（input.phpへ）
  redirect("request_for_register_list.php");

}else{
  //Login失敗時(login.phpへ)
  redirect("login_for_master.php");

}

exit();


