<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

include 'config/connectDb.php';
include 'objects/message.php';

$connectDb = new ConnectDb();
$dbConn = $connectDb->getConnection();

$message = new Message($dbConn);
$messages = $message->read();
$mess_num = $message->rowCount();

if($mess_num>0) {
  $arrMessages = array();
  $arrMessages['records'] = $messages->fetchAll();
} else {
  http_response_code(404);
  echo json_encode(array('message' => 'Товары не найдены'))
}