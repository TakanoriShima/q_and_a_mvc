<?php
    // 外部ファイルの読み込み
    require_once'QuestionDAO.php';

    // 変数の初期化
    // 入力された名前を保存する変数
    $name = "";
    // 入力された質問内容を保存する変数
    $content = "";
    
    // 投稿ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // 入力された値を取得
        $name = $_POST['name'];
        $content = $_POST['content'];
        
        // 例外処理
        try {
            
            // 入力された情報をもとに、新しいquestionインスタンスの生成
            $question = new Question($name, $content);
            
            // 新しいquestionインスタンスをデータベースに保存
            QuestionDAO::insert($question);
            
            // 画面遷移
            header('Location: index.php');
            exit;
            
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    }
