<?php
    // データベース接続情報
    $dsn = 'mysql:host=localhost;dbname=q_and_a';
    $username = 'root';
    $password = '';
    
    // 変数の初期化
    // 質問一覧を保存する配列を定義
    $questions = array();

    // 例外処理
    try {
        
        // 接続オプション
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   //デフォルトのフェッチモードは連想配列
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
        ); 
        
        // データベースに接続  
        $pdo = new PDO($dsn, $username, $password, $options);
       
        // SELECT文を実行して、questionsテーブルの全データ取得する
        $stmt = $pdo->query('SELECT * FROM questions');
        
        // 連想配列の配列として全データを抜き出す
        $questions = $stmt->fetchAll();
    
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

        <title>Q&Aサイト</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class=" col-sm-12 text-center">質問一覧</h1>
            </div>
            <div class="row mt-2">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>ユーザ名</th>
                        <th>内容</th>
                        <th>投稿時間</th>
                    </tr>
                    </tr>
                <?php foreach($questions as $question){ ?>
                    <tr>
                        <td><a href="show.php?id=<?php print $question['id']; ?>"><?php print $question['id']; ?></a></td>
                        <td><?php print $question['name']; ?></td>
                        <td><?php print $question['content']; ?></td>
                        <td><?php print $question['created_at']; ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <div class="row mt-5">
                <a href="new.php" class="btn btn-primary">新規質問投稿</a>
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
