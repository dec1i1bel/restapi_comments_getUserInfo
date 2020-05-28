<?php
$arrUpd = array(
  'comment_id' => $_POST['comment_id'],
  'strStatus_id' => $_POST['strStatus_id'],
  'strStatus' => $_POST['strStatus']
);
$arrUpd = json_encode($arrUpd);

include '../api/load-config.php';
include '../api/comments/update.php';
include '../api/comments/read.php';

$arrComments = json_decode($arrComments);

if($arrComments['status_id'] == 'published') {
  $buttonText = 'отменить публикацию';
} else {
  $buttonText = 'опубликовать';
}

echo $arrComments['status'] + '|' + $buttonText

?>