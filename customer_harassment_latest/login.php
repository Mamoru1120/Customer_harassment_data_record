<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン画面</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" href="css/sample.css">
</head>


<header id="header_login">
	
	<div id="title_login">Analysis on customer harassment</div>

</header>

<main>

    <div id="output_container">

        <h1>ログイン画面</h1>

        <div id="addition_container">
            <form name="login" action="login_act.php" method="post">
                <label>ID:</label>    
                <input type="text" name="lid">
                <label>PW:</label>  
                <input type="password" name="lpw">
                <input type="submit" value="ログイン">
            </form>

            <!-- 新規登録 -->
            <a id="register_link" href="register.php">新規登録申請</a><br>

            <!-- 管理者用ログインへ -->
            <a id="master_login_link" href="login_for_master.php">管理者用ログイン</a><br>

        </div>

</main>
</html>