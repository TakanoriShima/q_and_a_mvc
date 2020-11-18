<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="favicon.ico">
        <title>投稿詳細</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12 mt-2">質問番号: <?= $question->id ?> の詳細</h1>
            </div>
            <div class="row mt-3">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center">投稿者</th>
                        <td class="text-center"><?= $question->name ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">投稿日時</th>
                        <td class="text-center"><?= $question->created_at ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">質問内容</th>
                        <td class="text-center"><?= $question->content ?></td>
                    </tr>
                </table>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <a href="edit.php?id=<?= $question->id ?>" class="col-sm-12 btn btn-primary">編集</a>
                </div>
                <div class="col-sm-6">
                    <a href="delete.php?id=<?= $question->id ?>" class="col-sm-12 btn btn-danger">削除</a>
                </div>
            </div>
            
            <div class="row mt-5">
                <h1 class="text-center col-sm-12">回答投稿</h1>
            </div>
            <div class="row mt-2">
                <form class="offset-sm-2 col-sm-8" action="answer_create.php" method="POST">
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">名前</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" required placeholder="名前を入力してください。">
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">回答内容</label>
                        <div class="col-10">
                            <textarea name="content" class="form-control" required placeholder="回答内容を入力してください。"></textarea>
                        </div>
                    </div>
                
                    <input type="hidden" name="question_id" value="<?= $question->id ?>">
                    <!-- 1行 -->
                    <div class="form-group row">
                        <div class="offset-2 col-10">
                            <button type="submit" class="btn btn-primary">投稿</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="row mt-5">
                <h1 class=" col-sm-12 text-center">回答一覧</h1>
            </div>
            <div class="row mt-2">
            <?php if(count($answers) !== 0){ ?>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>回答番号</th>
                        <th>ユーザ名</th>
                        <th>内容</th>
                        <th>投稿時間</th>
                    </tr>
                    </tr>
                    <!--質問データの埋め込み-->
                <?php foreach($answers as $answer){ ?>
                    <tr>
                        <td><?= $answer->id ?></td>
                        <td><?= $answer->name ?></td>
                        <td><?= $answer->content; ?></td>
                        <td><?= $answer->created_at ?></td>
                    </tr>
            <?php } ?>
                </table>
            <?php }else{ ?>
                <h3 class="offset-sm-3 col-sm-6 text-center">回答はまだありません。</h3>
            <?php } ?>
            </div>
            
            <div class="row mt-5">
                <a href="index.php" class="btn btn-primary">投稿一覧へ</a>
            </div>
            
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="script.js"></script>
    </body>
</html>