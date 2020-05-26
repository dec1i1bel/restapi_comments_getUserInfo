<?php
include '../api/config/db.php';
include '../api/config/base.php';
include '../api/comments/read.php';
include '../api/users/read.php';

$arrComments = json_decode($arrComments);
$arrUsers = json_decode($arrUsers);

print_r($arrComments);
print_r($arrUsers);
