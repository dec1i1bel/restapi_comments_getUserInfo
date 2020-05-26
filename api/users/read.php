<?php
header('Content-Type: application/json; charset=UTF-8');

include '../api/objects/user.php';

$dbUsers = new Db();
$dbUsersConn = $dbUsers->getConnection();

$user = new User($dbUsersConn);
$users = $user->read();
// $users_count = $user->count();
$users_count = 1;

if($users_count>0) {
  $arrUsers = array();
  while($row = $users->fetch()) {
    extract($row);
    $userSingle = array(
      'user_id' => $id,
      'user_name' => $name,
      'user_birthdate' => $birthdate,
      'user_city' => $city,
      'user_phone' => $phone,
      'user_photo' => $photo
    );
    array_push($arrUsers, $userSingle);
  }
  http_response_code(200);
  $arrUsers = json_encode($arrUsers);
} else {
  http_response_code(404);
  echo json_encode(array('message' => 'В базе нет пользователей'));
}