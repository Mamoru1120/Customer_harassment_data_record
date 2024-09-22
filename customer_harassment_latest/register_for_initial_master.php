<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>マスター初期登録</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" href="css/sample.css">
</head>

<header>
	
	<div id="title">Analysis on customer harassment</div>

</header>

<main>

    <div id="output_container">

        <h1>マスター初期登録</h1>

        <div id="addition_container">
          <form action="write_master.php" method="post">
            <label>ID:</label>    
            <input type="text" name="mlid">
            <label>PW:</label>  
            <input type="password" name="mlpw">
            <input type="submit" value="登録">
            
          </form>

        </div>

    </div>

</main>
</html>