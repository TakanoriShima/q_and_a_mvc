<?php
     // データベース接続情報
    $dsn = 'mysql:host=localhost;dbname=q_and_a';
    $username = 'root';
    $password = '';
    
    // 削除ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // id値を取得
        if(isset($_GET['id']) === true){
            $id = $_GET['id'];
        }else{ 
            // 画面遷移
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

            // DELETE文を実行して、questionsテーブルのデータを削除する準備
            $stmt = $pdo->prepare('DELETE FROM questions WHERE id=:id');
            // バインド処理
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // DELETE文　実行
            $stmt->execute();
            
            // 画面遷移
            header('Location: index.php');
            exit;
            
    
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    
    }

?>