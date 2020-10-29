<?php
    // データベース接続情報
    $dsn = 'mysql:host=localhost;dbname=q_and_a';
    $username = 'root';
    $password = '';
    
    // 変数の初期化
    $name = "";
    $content = "";
    $flash_message = "";
    
    // 投稿ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // 入力された値を取得
        $name = $_POST['name'];
        $content = $_POST['content'];
        
        // 例外処理
        try {
            
            // 接続オプション
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // デフォルトのフェッチモードは連想配列
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   // MySQL サーバーへの接続時の文字コード設定
            ); 
            
            // データベースに接続                
            $pdo = new PDO($dsn, $username, $password, $options);

            // プリペアドステートメント
            $stmt = $pdo -> prepare("INSERT INTO questions (name, content) VALUES (:name, :content)");
            
            // バインド処理
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            
            // INSERT文　実行
            $stmt->execute();
            
            // 表示メッセージの用意
            $flash_message = "質問投稿が成功しました。";
            
    
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    
    }

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <title>質問投稿</title>
        <style>
            h2{
                color: red;
                background-color: pink;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12">質問投稿</h1>
            </div>
            <div class="row mt-2">
                <h2 class="text-center col-sm-12"><?php print $flash_message; ?></h1>
            </div>
            <div class="row mt-2">
                <form class="col-sm-12" action="new.php" method="POST">
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">名前</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" required placeholder="名前を入力してください。">
                        </div>
                    </div>
                
                    
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">内容</label>
                        <div class="col-10">
                            <textarea name="content" class="form-control" required placeholder="質問内容を入力してください。"></textarea>
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <div class="offset-2 col-10">
                            <button type="submit" class="btn btn-primary">投稿</button>
                        </div>
                    </div>
                </form>
            </div>
             <div class="row mt-5">
                <a href="index.php" class="btn btn-primary">投稿一覧</a>
            </div>
        </div>
        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>