<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>新規登録申請</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" href="css/sample.css">
</head>

<main>

    <div id="output_container">
        
        <h1>新規登録申請</h1>

        <div id="addition_container">
          <form action="write_shop.php" method="post">
            <label>店舗名：</label>
            <input id="name_of_shop" type="text" name="name_of_shop" placeholder="〇〇店" required>
            <label>都道府県：</label>
            <select name="prefecture" id="prefecture" required>
                <option value="" disabled="" selected="">選択してください</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
            </select>
            <label>店舗代表者名：</label>
            <input id="name_of_delegate" type="text" name="name_of_delegate" required>
            <label>メールアドレス：</label>
            <input id="mail" type="text" name="mail" placeholder="customer@harassment.com" required>
            <label>電話番号：</label>
            <input id="phone" type="text" name="phone" placeholder="〇〇〇-〇〇〇〇-〇〇〇〇" required>
            <label>Login ID：</label>
            <input id="lid" type="text" name="lid" required>
            <label>Login Passward：</label>
            <input id="lpw" type="text" name="lpw" required>
            <input id="user_type" type="hidden" name="user_type" value="一般">
            <input id="status" type="hidden" name="status" value="未承認">
            <button id="submit">申請</button>
          </form>
          
          <a href="login.php">戻る</a>
          
        </div>

       
    </div>

</main>
</html>