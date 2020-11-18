<?php
// 外部ファイルの読み込み
require_once 'Const.php';
require_once 'Question.php';
require_once 'Answer.php';

// データベースとやり取りを行う便利なクラス
class AnswerDAO{
    
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
    
    // 全question IDを指定してanswersの全情報を取得するメソッド
    public static function get_answers_by_question_id($question_id){
        $pdo = self::get_connection();
        $stmt = $pdo->prepare('SELECT * FROM answers WHERE question_id=:id ORDER BY id DESC');
        // バインド処理
        $stmt->bindParam(':id', $question_id, PDO::PARAM_INT);
        // SELECT文本番実行
        $stmt->execute();
        // フェッチの結果を、answerクラスのインスタンスにマッピングする
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Answer');
        $answers = $stmt->fetchAll();
        self::close_connection($pdo, $stmp);
        // answerインスタンスの配列を返す
        return $answers;
    }
    
    // answerデータを1件登録するメソッド
    public static function insert($answer){
        $pdo = self::get_connection();
        // INSERT文の実行準備
        $stmt = $pdo -> prepare("INSERT INTO answers (question_id, name, content) VALUES (:question_id, :name, :content)");
        // バインド処理
        $stmt->bindParam(':question_id', $answer->question_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $answer->name, PDO::PARAM_STR);
        $stmt->bindParam(':content', $answer->content, PDO::PARAM_STR);
        // INSERT文本番実行
        $stmt->execute();
        self::close_connection($pdo, $stmp);
    }
    
    
    // questionデータを更新するメソッド
    public static function update($question){
        $pdo = self::get_connection();
        // UPDATE文の実行準備
        $stmt = $pdo->prepare('UPDATE questions SET name=:name, content=:content WHERE id=:id');
        // バインド処理                
        $stmt->bindParam(':name', $question->name, PDO::PARAM_STR);
        $stmt->bindParam(':content', $question->content, PDO::PARAM_STR);
        $stmt->bindParam(':id', $question->id, PDO::PARAM_INT);
        
        // UPDATE文本番実行
        $stmt->execute();
        self::close_connection($pdo, $stmp);
    
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
