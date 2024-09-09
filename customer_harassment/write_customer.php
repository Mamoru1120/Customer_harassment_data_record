<?php

//エラー表示
ini_set("display_errors", 1);

$img = $_POST["img"];
$sex = $_POST["sex"];
$age = $_POST["age"];

//DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gsachademy_unit1;charset=utf8;host=mysql57.gsachademy.sakura.ne.jp','','');
    //さくらインターネットを使うときは、さくらインターネットのIDとPW
  } catch (PDOException $e) {
    exit('DBError:'.$e->getMessage());//エラーが分かるようにするメッセージ
  }

//データ登録SQL作成

$sql = "INSERT INTO customer_an_table(img,sex,age,recorded_date)VALUES(:img,:sex,:age,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);  
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR); 
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
  }else{
    //input.phpへリダイレクト
    header("Location: read_customerlist.php");
    exit();
  
  }

?>