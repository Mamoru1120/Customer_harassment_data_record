<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>管理者用ログイン画面</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" href="css/sample.css">
</head>


<header>
	
	<div id="title">Analysis on customer harassment</div>

</header>

<main>

    <div id="output_container">

        <h1>管理者用ログイン画面</h1>

        <div id="addition_container">
            <form name="login" action="login_act_for_master.php" method="post">
                <label>ID:</label>    
                <input type="text" name="mlid">
                <label>PW:</label>  
                <input type="password" name="mlpw">
                <input type="submit" value="ログイン">
            </form>

            <!-- 一般用ログインへ -->
            <a id="login_link" href="login.php">一般用ログイン</a><br>

        </div>

</main>
</html>