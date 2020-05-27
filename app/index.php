<?php
include '../api/load-config.php';
include '../api/comments/read.php';
include '../api/users/read.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="assets/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  $arrComments = json_decode($arrComments);
  $arrUsers = json_decode($arrUsers);

  $user = $arrUsers[0];
  ?>
  <div class="container">
    <div class="w-100">
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
      <h2>Сообщения</h2>
      <div id="user-comments-container">
      <?php
      foreach($arrComments as $k => $comment) {
        $k++;
        ?>
        <div id='user-account_comment-<?php echo strval($k) ?>' class="card border-primary mb-3">
          <div class="card-header bg-transparent border-primary">

            <span id='user-comment_status-<?php echo $k ?>' class="card-text"><?php echo $comment->status ?>
            </span>

            <input id='comment-<?php echo $k ?>_button' name ='comment-<?php echo $k ?>_button' type="button" class="btn-change-status btn btn-primary" value='<?php
                if($comment->status_id == 'published') {
                  echo 'отменить публикацию';
                } else {
                  echo 'опубликовать';
                }
            ?>'>
            <script>
              $('#comment-<?php echo $k ?>_button').on('click', function() {
                $.ajax({
                  url: 'change-status.php',
                  method: 'post',
                  data: 'comment_id=<?php echo $k ?>',
                  cache: false,
                  success: function(arrText, comment_id) {
                    $('#user-comment_status-'+comment_id).text(arrText[0]);
                    $('#comment-'+comment_id+'_status-button-text').text(arrText[1]);
                  }
                });
              })
            </script>

          <div class="card-body">
          <p class="card-text"><?php echo $comment->message ?></p>
          </div>
          <div class="card-footer bg-transparent border-success">
            Дата публикации:
            <?php
            if($comment->status_id == 'published') {
              echo $comment->publicationDate;
            } else {
              echo 'нет';
            }
            ?>
          </div>
        </div>
        <?php
      }
      ?>
      </div>
      <!-- <?php
      echo '<pre>';
      print_r($arrComments);
      echo '</pre>';
      ?> -->
    </div>
  </div>
  <!-- <script src="assets/src.js"></script> -->
</body>
</html>