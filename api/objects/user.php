<?php
// include 'base.php';
class User extends Base {
  // private $dbconn = null;
  private $dbtable = 'users';

  public function read() {
    $sql = 'select * from users';
    $exec = $this->dbconn->prepare($sql);
    $exec->execute();
    return $exec;
  }
}