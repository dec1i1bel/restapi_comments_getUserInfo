<?php
$arrRemove = array(
  'comment_id' => $_POST['comment_id']
);
$arrRemove = json_encode($arrRemove);

include '../api/load-config.php';
include '../api/comments/delete.php';

?>