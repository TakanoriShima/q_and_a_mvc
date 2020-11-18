<?php
    
    // 外部ファイルの読み込み
    require_once 'QuestionDAO.php';
    
    // 削除ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // id値が飛んできているならば、id値を取得
        if(isset($_GET['id']) === true){
            $id = $_GET['id'];
        }else{ 
            // 画面遷移
            header('Location: index.php');
        } 
        
        // 例外処理
        try {
        
            //　注目している question IDのデータを削除
            QuestionDAO::delete($id); 
        
            // 画面遷移
            header('Location: index.php');
            exit;
            
    
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    
    }

?>