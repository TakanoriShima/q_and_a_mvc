<?php
    // データベース接続情報
    $dsn = 'mysql:host=localhost;dbname=q_and_a';
    $username = 'root';
    $password = '';
    
    // 変数の初期化
    $id = "";
    $name = "";
    $content = "";
    
    // GET通信ならば
    if($_SERVER["REQUEST_METHOD"] === 'GET'){
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
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // デフォルトのフェッチモードは連想配列
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   // MySQL サーバーへの接続時の文字コード設定
            ); 
            
            // データベースに接続                
            $pdo = new PDO($dsn, $username, $password, $options);

            // SELECT文を実行して、questionsテーブルのデータ取得
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
        
    }
 
    // 更新ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // id値を取得
        if(isset($_POST['id']) === true){
            $id = $_POST['id'];
        }else{ 
            header('Location: index.php');
        } 
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

            // UPDATE文を 実行して、questionsテーブルのデータを更新
            $stmt = $pdo->prepare('UPDATE questions SET name=:name, content=:content WHERE id=:id');
            // バインド    
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // 実行
            $stmt->execute();
            
            header('Location: show.php?id=' . $id);
            exit;
            
    
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
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12 mt-2">id: <?php print $id; ?> の質問編集</h1>
            </div>
            <div class="row mt-2">
                <form class="col-sm-12" action="edit.php?id=<?php print $id; ?>" method="POST">
                    <input type="hidden" name="id" value="<?php print $id; ?>"> 
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">名前</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" value="<?php print $question['name']; ?>" required >
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">質問内容</label>
                        <div class="col-10">
                            <textarea name="content" class="form-control" required><?php print $question['content']; ?></textarea>
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <div class="offset-2 col-10">
                            <button type="submit" class="btn btn-primary">更新</button>
                        </div>
                    </div>
                </form>
            </div>
             <div class="row mt-5">
                <a href="show.php?id=<?php print $id; ?>" class="btn btn-primary">投稿詳細へ</a>
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