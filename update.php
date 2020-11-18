<?php

    // 外部ファイルの読み込み
    require_once 'QuestionDAO.php';
    
    // 変数の初期化
    // 変更するquestionのID
    $id = "";
    // 入力された名前を保存する変数
    $name = "";
    // 入力された質問内容を保存する変数
    $content = "";

    // 更新ボタンが押されたならば
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // id値が飛んできているならば、id値を取得
        if(isset($_POST['id']) === true){
            $id = $_POST['id'];
        }else{ 
            // 画面遷移
            header('Location: index.php');
        } 
        // 入力された値を取得
        $name = $_POST['name'];
        $content = $_POST['content'];
        
        // 例外処理
        try {
            
            // 入力された値をもとに、questionインスタンスを再現
            $question = QuestionDAO::get_question_by_id($id);
            
            // 入力さえた値をもとに、内部プロパティを書き換え
            $question->name = $name;
            $question->content = $content;
            
            // 更新作業
            QuestionDAO::update($question);
            
            // 画面遷移
            header('Location: index.php');
            exit;
            
        } catch (PDOException $e) {
            echo 'PDO exception: ' . $e->getMessage();
            exit;
        }
    
    }
