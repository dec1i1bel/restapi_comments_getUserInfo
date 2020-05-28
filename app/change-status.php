<?php
$arrUpd = array(
  'comment_id' => $_POST['comment_id'],
  'status_id' => $_POST['status_id'],
  'status' => $_POST['status']
);
$arrUpd = json_encode($arrUpd);

include '../api/load-config.php';
include '../api/comments/update.php';

$arrStatus = json_decode($arrStatus);

if($arrStatus->status_id == 'published') {
  $buttonText = 'отменить публикацию';
  $pubDate = $arrStatus->publicationDate;
} else {
  $buttonText = 'опубликовать';
  $pubDate = 'нет';
};

echo $arrStatus->status.'|'.$buttonText.'|'.$pubDate;
?>