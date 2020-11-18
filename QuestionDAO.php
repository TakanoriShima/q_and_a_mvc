<?php
// 外部ファイルの読み込み
require_once 'Const.php';
require_once 'Question.php';

// データベースとやり取りを行う便利なクラス
class QuestionDAO{
    
    // データベースと接続を行うメソッド
    private static function get_connection(){
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,   //デフォルトのフェッチモードはクラス
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
          );
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $options);
        return $pdo;
    }
    
    // データベースとの切断を行うメソッド
    private static function close_connection($pdo, $stmp){
        $pdo = null;
        $stmp = null;
    }
    
    // 全question情報を取得するメソッド
    public static function get_all_questions(){
        $pdo = self::get_connection();
        $stmt = $pdo->query('SELECT * FROM questions ORDER BY id DESC');
        // フェッチの結果を、questionクラスのインスタンスにマッピングする
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Question');
        $questions = $stmt->fetchAll();
        self::close_connection($pdo, $stmp);
        // questionのインスタンスの配列を返す
        return $questions;
    }
    
    // id値からデータを抜き出すメソッド
    public static function get_question_by_id($id){
        $pdo = self::get_connection();
        // SELECT文実行準備
        $stmt = $pdo->prepare('SELECT * FROM questions WHERE id = :id');
        // バインド処理
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // SELECT文本番実行
        $stmt->execute();
        // questionインスタンスとして1件データを抜き出す
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Question');
        $question = $stmt->fetch();
        self::close_connection($pdo, $stmp);
        // questionクラスのインスタンスを返す
        return $question;
    }
    
    // questionデータを1件登録するメソッド
    public static function insert($question){
        $pdo = self::get_connection();
        // INSERT文の実行準備
        $stmt = $pdo -> prepare("INSERT INTO questions (name, content) VALUES (:name, :content)");
        // バインド処理
        $stmt->bindParam(':name', $question->name, PDO::PARAM_STR);
        $stmt->bindParam(':content', $question->content, PDO::PARAM_STR);
        // INSERT文本番実行
        $stmt->execute();
        self::close_connection($pdo, $stmp);
    }
    
    
    // questionデータを更新するメソッド
    public static function update($question){
        $pdo = self::get_connection();
        // UPDATE文の実行準備
        $stmt = $pdo->prepare('UPDATE questions SET name=:name, content=:content WHERE id = :id');
        // バインド処理                
        $stmt->bindParam(':name', $question->name, PDO::PARAM_STR);
        $stmt->bindParam(':content', $question->content, PDO::PARAM_STR);
        
        // UPDATE文本番実行
        $stmt->execute();
        self::close_connection($pdo, $stmp);
        
        // 画像の物理削除
        if($image !== $message->image){
            unlink(IMAGE_DIR . $image);
        }
    }
    
    // questionデータを削除するメソッド
    public static function delete($id){
        $pdo = self::get_connection();
        // DELETE文実行準備
        $stmt = $pdo->prepare('DELETE FROM questions WHERE id = :id');
        // バインド処理
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // DELETE文本番実行
        $stmt->execute();
        self::close_connection($pdo, $stmp);
    }
}
