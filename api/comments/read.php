<?php
// header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

include '../api/config/db.php';
include '../api/objects/comment.php';

$connectDb = new Db();
$dbConn = $connectDb->getConnection();

$message = new Comment($dbConn);
$messages = $message->read();
$mess_num = 1;

if($mess_num>0) {
  $arrMessages = array();
  while($row = $messages->fetch()) {
    extract($row);
    $message_item = array(
      'c_message' => $c_message,
      'c_publicationDate' => $c_publicationDate,
      'c_status' => $c_status,
      'user_name' => $user_name
    );
    array_push($arrMessages, $message_item);
  }
  http_response_code(200);
  $arrMessages = json_encode($arrMessages);
} else {
  http_response_code(404);
  echo json_encode(array('message' => 'У пользователя нет сообщений'));
}