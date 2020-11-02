<?php

    // データベース接続情報
    $dsn = 'mysql:host=localhost;dbname=q_and_a';
    $username = 'root';
    $password = '';
    
    // 変数の初期化
    $questions = array();
    $id = "";
    $question = "";
    
    // id値を取得
    if(isset($_GET['id']) === true){
        $id = $_GET['id'];
    }else{ 
        header('Location: index.php');
    }   

    // 例外処理
    try {
        
        // 接続オプション
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   //デフォルトのフェッチモードはクラス
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
        ); 
        
        // データベースに接続  
        $pdo = new PDO($dsn, $username, $password, $options);
       
        // SELECT文を実行して、questionsのデータを取得
        $stmt = $pdo->prepare('SELECT * FROM questions WHERE id=:id');
        // バインド    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // 実行
        $stmt->execute();
        
        $question = $stmt->fetch();
    
    } catch (PDOException $e) {
        echo 'PDO exception: ' . $e->getMessage();
        exit;
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
        
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="favicon.ico">
        <title>投稿詳細</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12 mt-2">id: <?php print $id; ?> の質問詳細</h1>
            </div>
            <div class="row mt-3">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center">投稿者</th>
                        <td class="text-center"><?php print $question["name"]; ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">投稿日時</th>
                        <td class="text-center"><?php print $question["created_at"]; ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">質問内容</th>
                        <td class="text-center"><?php print $question["content"]; ?></td>
                    </tr>
                </table>
            </div>
            <div class="row">

                <div class="col-sm-6">
                        <a href="edit.php?id=<?php print $id; ?>" class="col-sm-12 btn btn-primary">編集</a>
                </div>
                <div class="col-sm-6">
                        <a href="delete.php?id=<?php print $id; ?>" class="col-sm-12 btn btn-danger">削除</a>
                </div>
            </div>

            <div class="row mt-5">
                <a href="index.php" class="btn btn-primary">投稿一覧へ</a>
            </div>
            
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="script.js"></script>
    </body>
</html>