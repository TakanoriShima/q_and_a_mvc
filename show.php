<?php

    // 外部ファイルの読み込み
    require_once 'QuestionDAO.php';
    
    // 変数の初期化
    // 注目している質問番号を保存する変数
    $id = "";
    // 注目している質問を保存する変数
    $question = "";

    // GET通信ならば
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // id値が飛んできているならば、id値を取得
        if(isset($_GET['id']) === true){
            $id = $_GET['id'];
        }else{ 
            // 画面遷移
            header('Location: index.php');
        } 
        
        // 例外処理
        try{
            // question IDからデータを抜き出す
            $question = QuestionDAO::get_question_by_id($id);
        
            // viewを表示
            include_once 'show_view.php';
        
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    }
?>
