<?php
// header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

include '../api/config/connectDb.php';
include '../api/objects/message.php';

$connectDb = new ConnectDb();
$dbConn = $connectDb->getConnection();

$message = new Message($dbConn);
$messages = $message->read();
// $mess_num = $message->rowCount();
$mess_num = 1;

if($mess_num>0) {
  $arrMessages = array();
  // $arrMessages['records'] = array();
  while($row = $messages->fetch()) {
    // echo '<p>'.print_r($row).'</p>';
    extract($row);
    $message_item = array(
      'c_message' => $c_message,
      'c_publicationDate' => $c_publicationDate,
      'c_status' => $c_status,
      'c_userId' => $c_userId
    );
    array_push($arrMessages, $message_item);
  }
  http_response_code(200);
  echo json_encode($arrMessages);
} else {
  http_response_code(404);
  echo json_encode(array('message' => 'У пользователя нет сообщений'));
}