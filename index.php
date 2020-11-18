<?php
    // 外部ファイルの読み込み
    require_once 'QuestionDAO.php';
    
    // 変数の初期化
    // 質問一覧を保存する配列を定義
    $questions = array();

    // 例外処理
    try {
        
        // 全questionデータ取得
        $questions = QuestionDAO::get_all_questions();
        
        // viewを表示
        include_once 'index_view.php';
        
    } catch (PDOException $e) {
        echo 'PDO exception: ' . $e->getMessage();
        exit;
    }

