<?php
    // 外部ファイルの読み込み
    require_once'AnswerDAO.php';

    // 変数の初期化
    // 注目している質問の番号を保存する変数
    $id = "";
    // 入力された回答の名前を保存する変数
    $name = "";
    // 入力された回答内容を保存する変数
    $content = "";
    // answerインスタンス
    $answer = "";
    
    // 投稿ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        var_dump($_POST);
        // 入力された値を取得
        $question_id = $_POST['question_id'];
        $name = $_POST['name'];
        $content = $_POST['content'];
        
        // 例外処理
        try {
            
            // 入力された情報をもとに、新しいquestionインスタンスの生成
            $answer = new Answer($question_id, $name, $content);
            
            // 新しいquestionインスタンスをデータベースに保存
            AnswerDAO::insert($answer);
            
            // 画面遷移
            header('Location: show.php?id=' . $question_id);
            exit;
            
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    }
