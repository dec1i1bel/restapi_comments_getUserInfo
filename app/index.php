<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>restapi_project</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="assets/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  include '../api/load-config.php';
  include '../api/comments/read.php';
  include '../api/users/read.php';

  $arrComments = json_decode($arrComments);
  $arrUsers = json_decode($arrUsers);

  $user = $arrUsers[0];
  ?>
  <div class="container">
    <div id="user-account-userdata" class="w-100">
      <h1>Аккаунт пользователя</h1>
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?php echo $user->user_photo; ?>" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">ФИО</h5>
              <p class="card-text"><?php echo $user->user_name ?></p>
              <h5 class="card-title">Дата рождения</h5>
              <p class="card-text"><?php echo $user->user_birthdate ?></p>
              <h5 class="card-title">Город</h5>
              <p class="card-text"><?php echo $user->user_city ?></p>
              <h5 class="card-title">Номер телефона</h5>
              <p class="card-text"><?php echo $user->user_phone ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="user-account-comments">
      <h2>Сообщения</h2>
      <div id="user-comments-container">
      <?php
      foreach($arrComments as $comment) {
        ?>
        <div id='user-account_comment-<?php echo $comment->id ?>' class="card mb-3">
          <div class="card-header bg-transparent">
            <span id='user-comment_status-<?php echo $comment->id ?>' class="card-text"><?php echo $comment->status ?></span>

            <button id='comment-<?php echo $comment->id ?>_button' name ='comment-<?php echo $comment->id ?>_button' type="button" class="btn-change-status btn btn-primary"><span id='comment-<?php echo $comment->id ?>_status-button-text'>
              <?php
                if($comment->status_id == 'published') {
                  echo 'отменить публикацию';
                } else {
                  echo 'опубликовать';
                }
              ?>
            </span>
            </button>
            <button class="btn btn-outline-primary" type="button" id='comment-<?php echo $comment->id ?>_button-remove_comment' name ='comment-<?php echo $comment->id ?>_button-remove_comment'>Удалить</button>
            </div>
          <div class="card-body">
          <p class="card-text"><?php echo $comment->message ?></p>
          </div>
          <div class="card-footer bg-transparent">
            Дата публикации:
            <span id='comment-<?php echo $comment->id ?>_publication-date'>
            <?php
            if($comment->status_id == 'published') {
              echo $comment->publicationDate;
            } else {
              echo 'нет';
            }
            ?>
            </span>
          </div>
          <script>
              $(document).ready(function() {                
                function req_update() {
                  $.ajax({
                    url: 'change-status.php',
                    method: 'post',
                    data: 'comment_id=<?php echo $comment->id ?>&status_id=<?php echo $comment->status_id; ?>&status=<?php echo $comment->status ?>',
                    cache: false,
                    success: function(strAnswer) {
                      let arrAnswer = strAnswer.split('|');
                      
                      $('#user-comment_status-<?php echo $comment->id ?>').text(arrAnswer[0]);
                      $('#comment-<?php echo $comment->id ?>_status-button-text').text(arrAnswer[1]);
                      $('#comment-<?php echo $comment->id ?>_publication-date').text(arrAnswer[2]);
                    }
                  });
                }

                function req_delete() {
                  $.ajax({
                    url: 'remove-post.php',
                    method: 'post',
                    data: 'comment_id=<?php echo $comment->id ?>',
                    cache: false,
                    success: function() {
                      $('#user-account_comment-<?php echo $comment->id ?>').remove();
                    }
                  })
                }

                $('#comment-<?php echo $comment->id ?>_button').on('click', function() {
                  req_update();
                })

                $('#comment-<?php echo $comment->id ?>_button-remove_comment').on('click', function() {
                  req_delete();
                })
                
              })
            </script>
        </div>
        <?php
      }
      ?>
      </div>
      </div>
      </div>
    </div>
    
  </div>
</body>
</html>