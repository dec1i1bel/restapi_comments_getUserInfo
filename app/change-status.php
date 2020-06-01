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

$status = $arrStatus->status;
$status_id = $arrStatus->status_id;

if($status_id == 'published') {
  $buttonText = 'отменить публикацию';
  $pubDate = $arrStatus->publicationDate;
} else {
  $buttonText = 'опубликовать';
  $pubDate = 'нет';
};

echo $status.'|'.$buttonText.'|'.$pubDate.'|'.$status_id;
?>