<?php
    
    // 外部ファイルの読み込み
    require_once 'AnswerDAO.php';
    
    // モデル
    class Question{
        // プロパティ
        public $id;
        public $name;
        public $content;
        public $created_at;
        
        // コンストラクタ
        public function __construct($name="", $content=""){
            $this->name = $name;
            $this->content = $content;
        }
        
        // 自分の質問に答えてくれた回答一覧を取得するメソッド
        public function get_answers(){
            $answers = AnswerDAO::get_answers_by_question_id($this->id);
            return $answers;
        }
    }