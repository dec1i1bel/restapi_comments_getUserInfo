<?php
include '../api/objects/comment.php';
$dbComments = new Db();
$dbCommentsConn = $dbComments->getConnection();

$comment = new Comment($dbCommentsConn);
$updateCommStatus = $comment->update();
?>