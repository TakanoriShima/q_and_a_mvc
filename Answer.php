<?php
    // モデル
    class Answer{
        // プロパティ
        public $id;
        public $question_id;
        public $name;
        public $content;
        public $created_at;
        
        // コンストラクタ
        public function __construct($question_id="", $name="", $content=""){
            $this->question_id = $question_id;
            $this->name = $name;
            $this->content = $content;
        }
    }