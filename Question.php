<?php
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
    }